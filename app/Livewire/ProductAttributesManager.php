<?php
// app/Http/Livewire/ProductAttributesManager.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductAttributesManager extends Component
{
    public Product $product;
    public $holo_code;
    public $price;
    public $sale_price;
    public $wholesale_price;
    public $few;
    public $type;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->holo_code = $product->holo_code;
        $this->price = $product->price;
        $this->sale_price = $product->sale_price;
        $this->wholesale_price = $product->wholesale_price;
        $this->few = $product->few;
        $this->type = $product->type ? true : false; // Convert to boolean
    }

    public function render()
    {
        return view('livewire.product-attributes-manager');
    }

    public function save()
    {
        $this->validate([
            'holo_code' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'few' => 'nullable|numeric|min:0',
            'type' => 'boolean',
        ]);

        $this->product->holo_code = $this->holo_code;
        $this->product->price = $this->price;
        $this->product->sale_price = $this->sale_price;
        $this->product->wholesale_price = $this->wholesale_price;
        $this->product->few = $this->few;
        $this->product->type = $this->type;

        $this->product->save();

        session()->flash('message', 'اطلاعات محصول با موفقیت ذخیره شدند.');
    }
}
