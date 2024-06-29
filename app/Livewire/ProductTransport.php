<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductTransport extends Component
{
    public $product;
    public $weight;
    public $length;
    public $width;
    public $height;
    public $measurement_unit;
    public $transport_type;
    public $cost_calculation_class;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->weight = $product->weight;
        $this->length = $product->length;
        $this->width = $product->width;
        $this->height = $product->height;
        $this->measurement_unit = $product->measurement_unit;
        $this->transport_type = $product->transport_type;
        $this->cost_calculation_class = $product->cost_calculation_class;
    }

    public function save()
    {
        $this->validate([
            'weight' => 'nullable|numeric',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'measurement_unit' => 'nullable|string',
            'transport_type' => 'nullable|string',
            'cost_calculation_class' => 'nullable|string',
        ]);

        $this->product->update([
            'weight' => $this->weight,
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'measurement_unit' => $this->measurement_unit,
            'transport_type' => $this->transport_type,
            'cost_calculation_class' => $this->cost_calculation_class,
        ]);

        session()->flash('message', 'اطلاعات حمل و نقل با موفقیت ذخیره شد.');
    }

    public function render()
    {
        return view('livewire.product-transport');
    }
}
