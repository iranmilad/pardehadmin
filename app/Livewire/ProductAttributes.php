<?php
namespace App\Livewire;

use App\Models\Tag;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Facades\Log;
use App\Models\ProductAttributeProperty;
use App\Models\ProductAttributeCombination;
use Livewire\Features\SupportAttributes\AttributeCollection;

class ProductAttributes extends Component
{
    public $product;
    public $categories;
    public $tags;
    public AttributeCollection $attributes;
    public $selectedAttributes = [];
    public $combinations = [];

    public function mount($id)
    {
        $this->product = Product::with(['categories', 'tags', 'attributes', 'attributeCombinations.attributeProperties.property'])->findOrFail($id);
        $this->categories = Category::all();
        $this->tags = Tag::all();
        $this->attributes = new AttributeCollection(Attribute::where('independent', 0)->get());

        // Map selected attribute IDs for select2 dropdown
        $this->selectedAttributes = $this->product->attributes->where('independent', 0)->pluck('id')->toArray();

        // Initialize combinations with current product combinations
        $this->combinations = $this->product->attributeCombinations->where('independent', 0)->map(function ($combination) {
            return [
                'id' => $combination->id,
                'combination_number' => $combination->id,
                'holo_code' => $combination->holo_code,
                'sku' => $combination->sku,
                'price' => $combination->price,
                'sale_price' => $combination->sale_price,
                'wholesale_price' => $combination->wholesale_price,
                'stock_quantity' => $combination->stock_quantity,
                'description' => $combination->description,
                'time_per_unit' => $combination->time_per_unit,
                'attributes' => $combination->attributeProperties->pluck('property_id', 'attribute_id')->toArray()
            ];
        })->toArray();
    }


    public function updateAttributes()
    {
        // جمع‌آوری ویژگی‌های مستقل که محصول هم‌اکنون دارد
        $independentAttributes = $this->product->attributes->where('independent', 1)->pluck('id')->toArray();

        // فیلتر کردن ویژگی‌های وابسته (غیر مستقل)
        $dependentAttributes = collect($this->selectedAttributes)->filter(function($attributeId) {
            $attribute = $this->attributes->firstWhere('id', $attributeId);
            return $attribute && !$attribute->independent;
        })->toArray();

        // ترکیب ویژگی‌های مستقل و وابسته برای همگام‌سازی
        $attributesToSync = array_merge($independentAttributes, $dependentAttributes);

        // سینک کردن ویژگی‌ها
        $this->product->attributes()->sync($attributesToSync);

        session()->flash('message', 'ویژگی‌ها با موفقیت به‌روز شدند.');
    }



    public function addCombination()
    {
        $lastCombinationId = ProductAttributeCombination::latest('id')->first()->id ?? 0;

        $this->combinations[] = [
            'id' => null,
            'combination_number' => $lastCombinationId + 1,
            'holo_code' => '',
            'sku' => '',
            'price' => '',
            'sale_price' => '',
            'wholesale_price' => '',
            'stock_quantity' => '',
            'description' => '',
            'time_per_unit' => '',
            'attributes' => []
        ];

        // Emit event to notify JavaScript
        $this->dispatch('refresh');
    }




    public function updateCombination($index)
    {
        $combinationData = $this->combinations[$index];

        // Function to return null if the value is empty
        $nullifyEmpty = function ($value) {
            return empty($value) ? null : $value;
        };

        // Ensure all fields have a value or a default value, with proper type casting
        $holoCode = $nullifyEmpty($combinationData['holo_code']);
        $sku = $nullifyEmpty($combinationData['sku']);
        $price = $nullifyEmpty($combinationData['price']);
        $salePrice = $nullifyEmpty($combinationData['sale_price']);
        $wholesalePrice = $nullifyEmpty($combinationData['wholesale_price']);
        $stockQuantity = $nullifyEmpty($combinationData['stock_quantity']);
        $description = $nullifyEmpty($combinationData['description']);
        $timePerUnit = $nullifyEmpty($combinationData['time_per_unit']);

        // Update or create the combination
        $combination = ProductAttributeCombination::updateOrCreate(
            [
                'id' => $combinationData['id'] ?? null,
                'independent' => 0,
            ],
            [
                'independent' => 0,
                'product_id' => $this->product->id,
                'holo_code' => $holoCode,
                'sku' => $sku,
                'price' => $price,
                'sale_price' => $salePrice,
                'wholesale_price' => $wholesalePrice,
                'stock_quantity' => $stockQuantity,
                'description' => $description,
                'time_per_unit' => $timePerUnit,

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





    public function removeCombination($index)
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
        return view('livewire.product-attributes');
    }
}

