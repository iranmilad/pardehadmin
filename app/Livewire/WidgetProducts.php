<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class WidgetProducts extends Component
{

    public $products;
    public $type;
    public $options;
    /**
     * Create a new component instance.
     */
    public function mount($type, $options)
    {
        $this->type = $type;
        $this->options = json_decode($options, true);
        $count = $this->options['count'] ?? 4;

        if ($this->type == "new product") {
            $this->products = Product::latest()->take($count)->get();
        }
        elseif ($this->type == 'category') {
            // Get a random product from the specified cateliangory
            $category = Category::where('alias', $this->options['category'])->first();
            if ($category) {
                $this->products = $category->products()->inRandomOrder()->take($count)->get();
            }

        }
        elseif($this->type == 'discount product'){
            $this->products = Product::where(function ($query){
                return $query->where('sale_price' , '<>' , null);
            })->orderBy('id','desc')->take($count)->get();
        }
    }

    public function render()
    {
        $products=$this->products;
        return view('livewire.widget-products', compact('products'));
    }
}
