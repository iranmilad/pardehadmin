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
    public $time_per_unit;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->holo_code = $product->holo_code;
        $this->price = $product->price;
        $this->sale_price = $product->sale_price;
        $this->wholesale_price = $product->wholesale_price;
        $this->few = $product->few;
        $this->type = $product->type=='variation' ? true : false; // Convert to boolean
        $this->time_per_unit = $product->time_per_unit;
    }

    public function render()
    {
        return view('livewire.product-attributes-manager');
    }

    public function save()
    {
        $this->validate([
            'holo_code' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'few' => 'nullable|numeric|min:0',
            'type' => 'nullable|boolean',
            'time_per_unit' => 'nullable|numeric|min:0',
        ]);
    
        // تنظیم مقادیر محصول
        $this->product->holo_code = $this->holo_code ?: null;
        $this->product->price = $this->price;
        $this->product->sale_price = $this->sale_price ?: null;
        $this->product->wholesale_price = $this->wholesale_price ?: null;
        $this->product->few = $this->few ?: null;
        $this->product->type =$this->type ? 'variation': 'simple'; 
        $this->product->time_per_unit = $this->time_per_unit ?: null;
    
        $this->product->save();
    
        session()->flash('message', 'اطلاعات محصول با موفقیت ذخیره شدند.');
    }
    
}
