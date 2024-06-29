<?php
namespace App\Livewire;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductAttributeProperty;
use App\Models\ProductAttributeCombination;
use Livewire\Features\SupportAttributes\AttributeCollection;
use Illuminate\Support\Facades\Log;

class ProductIndependentAttributes extends Component
{
    public $product;
    public $categories;
    public $tags;
    public AttributeCollection $attributes;
    public $selectedIndependentAttributes = [];
    public $addIndependentAttribute;
    public $combinations = [];

    public function mount($id)
    {
        $this->product = Product::with(['categories', 'tags', 'attributes', 'attributeCombinations.attributeProperties.property'])->findOrFail($id);
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->attributes = new AttributeCollection(Attribute::where('independent', 1)->get());

        // Map selected attribute IDs for select2 dropdown
        $this->selectedIndependentAttributes = $this->product->attributes->where('independent', 1)->pluck('id')->toArray();

        // Initialize combinations with current product combinations
        $this->combinations = $this->product->attributeCombinations->where('independent', 1)->map(function ($combination) {
            return [
                'id' => $combination->id,
                'combination_number' => $combination->id,
                'holo_code' => $combination->holo_code,
                'price' => $combination->price,
                'sale_price' => $combination->sale_price,
                'wholesale_price' => $combination->wholesale_price,
                'stock_quantity' => $combination->stock_quantity,
                'description' => $combination->description,
                'attributes' => $combination->attributeProperties->pluck('property_id', 'attribute_id')->toArray()
            ];
        })->toArray();
    }

    public function updateIndependentAttributes()
    {
        // Collect current dependent attributes the product has
        $dependentAttributes = $this->product->attributes->where('independent', 0)->pluck('id')->toArray();

        // Filter selected independent attributes
        $independentAttributes = collect($this->selectedIndependentAttributes)->filter(function($attributeId) {
            $attribute = $this->attributes->firstWhere('id', $attributeId);
            return $attribute && $attribute->independent;
        })->toArray();

        // Combine independent and dependent attributes for synchronization
        $attributesToSync = array_merge($dependentAttributes, $independentAttributes);

        // Sync attributes
        $this->product->attributes()->sync($attributesToSync);

        session()->flash('message', 'ویژگی‌ها با موفقیت به‌روز شدند.');
    }

    public function addCombination()
    {
        $lastCombinationId = ProductAttributeCombination::latest('id')->first()->id ?? 0;

        // Initialize new combination with default values
        $newCombination = [
            'id' => null,
            'combination_number' => $lastCombinationId + 1,
            'holo_code' => '',
            'price' => '',
            'sale_price' => '',
            'wholesale_price' => '',
            'stock_quantity' => '',
            'description' => '',
            'attributes' => [],
        ];
        
        // Populate attributes with selected independent attribute
        if ($this->addIndependentAttribute) {
            // Find attribute by ID
            $attribute = $this->attributes->firstWhere('id', $this->addIndependentAttribute);
    
            if ($attribute) {
                // Set default property value to null or default value if available
                // Example: $newCombination['attributes'][$this->addIndependentAttribute] = $attribute->default_value ?? null;
                $newCombination['attributes'][$this->addIndependentAttribute] = $attribute->properties()->first()->id ?? null;
            }
        }
        else{
            session()->flash('message', 'ابتدا یک ویژگی انتخاب کنید');
            return;
        }
        log::info($this->addIndependentAttribute);
        // Add the new combination to the combinations array
        $this->combinations[] = $newCombination;
    
        
        
        // Emit event to notify JavaScript (if necessary)
        $this->dispatch('refresh');
    }
    

    public function updateIndependentCombination($index)
    {
        $combinationData = $this->combinations[$index];

        // Function to return null if the value is empty
        $nullifyEmpty = function ($value) {
            return empty($value) ? null : $value;
        };

        // Ensure all fields have a value or a default value, with proper type casting
        $holoCode = $nullifyEmpty($combinationData['holo_code']);
        $price = $nullifyEmpty($combinationData['price']);
        $salePrice = $nullifyEmpty($combinationData['sale_price']);
        $wholesalePrice = $nullifyEmpty($combinationData['wholesale_price']);
        $stockQuantity = $nullifyEmpty($combinationData['stock_quantity']);
        $description = $nullifyEmpty($combinationData['description']);

        // Update or create the combination
        $combination = ProductAttributeCombination::updateOrCreate(
            ['id' => $combinationData['id'] ?? null],
            [
                'product_id' => $this->product->id,
                'holo_code' => $holoCode,
                'price' => $price,
                'sale_price' => $salePrice,
                'wholesale_price' => $wholesalePrice,
                'stock_quantity' => $stockQuantity,
                'description' => $description,
                'independent' => 1,
            ]
        );

        // Update or create attribute properties for the combination
        foreach ($combinationData['attributes'] as $attributeId => $propertyId) {
            ProductAttributeProperty::updateOrCreate(
                [
                    'combination_id' => $combination->id,
                    'attribute_id' => $attributeId,
                    'product_id' => $this->product->id,
                ],
                ['property_id' => $propertyId]
            );
        }

        if ($combinationData['id']) {
            session()->flash('message', 'ترکیب با موفقیت به‌روز شد.');
        } else {
            session()->flash('message', 'ترکیب جدید با موفقیت ایجاد شد.');
        }

        // Update the ID in the combinations array if it was created
        $this->combinations[$index]['id'] = $combination->id;
    }

    public function removeIndependentCombination($index)
    {
        $combinationData = $this->combinations[$index];

        if (isset($combinationData['id'])) {
            $combination = ProductAttributeCombination::find($combinationData['id']);

            if ($combination) {
                $combination->delete();
                unset($this->combinations[$index]);
                $this->combinations = array_values($this->combinations);
                session()->flash('message', 'ترکیب با موفقیت حذف شد.');
            }
        }
    }

    public function render()
    {
        return view('livewire.product-independent-attributes');
    }
}
