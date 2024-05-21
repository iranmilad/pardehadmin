<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class WidgetProductsList extends Component
{
    use WithPagination;

    public $sortBy = null;
    public $showBy = 10;
    public $categories = null;
    public $minprice = 0;
    public $maxprice = 200000000;

    private $type= "search";
    private $products;
    private $options;
    private $slug;

    protected $paginationTheme = 'bootstrap';

    public function mount($slug=null,$type,$options)
    {
        $this->type = $type;
        $this->slug = $slug;

        $this->options = (object)json_decode($options, true);
        $this->showBy = $this->showBy ?? 10;
        $this->categories = Category::all();

        $this->loadProducts();


    }


    public function loadProducts()
    {
        $query = Product::query();

        if ($this->type == "category") {
            $category = Category::where('alias', $this->slug)->first();
            if ($category) {
                $query = $category->products();
            } else {
                $this->products = collect(); // Return empty collection if no category found
                return;
            }
        }
        elseif($this->type == "search") {
            $query = Product::latest();
        }
        elseif($this->type == "favorite") {
            $query = Product::latest();
        }

        if ($this->minprice !== null) {
            $query->where('price', '>=', $this->minprice);
        }
        if ($this->maxprice !== null) {
            $query->where('price', '<=', $this->maxprice);
        }

        if ($this->sortBy === 'newest') {
            $query->orderByDesc('created_at');
        } elseif ($this->sortBy === 'cheapest') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sortBy === 'expensive') {
            $query->orderBy('price', 'desc');
        }

        $this->products = $query->paginate($this->showBy ?? 10);
    }

    public function updatedShowBy()
    {
        $this->resetPage();
    }

    public function updatedSortBy()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (!isset($this->products)) {
            $this->loadProducts();
        }
        return view('livewire.widget-products-list', [
            'products' => $this->products,
        ]);
    }
}
