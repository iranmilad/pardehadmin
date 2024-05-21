<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Vite;


class Search extends Component
{

    public $searchResults;
    public $searchTerm = '';
    public $results = [];


    protected $rules = [
        'searchTerm' => 'required|min:2',
    ];

    public function rules()
    {
        return [
            'searchTerm' => 'required|min:3',
        ];
    }


    public function updatedSearchTerm()
    {

        if (strlen($this->searchTerm) < 3) {
            $this->results = [];
        }

        $validated = $this->validate();

        if ($validated) {


            // Search products
            $products = Product::where('title', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                ->get();

            // Search categories
            $categories = Category::where('title', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                ->get();

            // Transforming results to match the initial data structure
            $results = [
                'products' => $products->map(function ($product) {
                    return (object) [
                        'id' => $product->id,
                        'name' => $product->title,
                        'category_id' => $product->category_id,
                        'description' => $product->description,
                        'thumbnail' => $product->img,
                    ];
                }),
                'categories' => $categories->map(function ($category) {
                    return (object) [
                        'id' => $category->id,
                        'name' => $category->title,
                        'link' => '#',
                    ];
                }),
            ];
            $this->results = (object)[
                'products' => $results["products"],
                'categories' => $results["categories"]
            ];
            // Simulate making an API call to fetch search results
            // $this->results = (object) [
            //     'categories' => collect([
            //         (object) [
            //             'id' => 1,
            //             'name' => 'پرده مخمل',
            //             'link' => '#',
            //         ],
            //         (object) [
            //             'id' => 2,
            //             'name' => 'موکت',
            //             'link' => '#'
            //         ],
            //         (object) [
            //             'id' => 3,
            //             'name' => 'پرده آماده حریر',
            //             'link' => '#'
            //         ],
            //     ]),
            //     'products' => collect([
            //         (object) [
            //             'id' => 1,
            //             'name' => 'محصول 1',
            //             'category_id' => 1,
            //             'description' => 'Description1',
            //             'thumbnail' => "resources/images/single-product/1.jpg"
            //         ],
            //         (object) [
            //             'id' => 2,
            //             'name' => 'محصول 2',
            //             'category_id' => 2,
            //             'description' => 'Description2',
            //             'thumbnail' => "resources/images/single-product/6.jpg"
            //         ],
            //         (object) [
            //             'id' => 3,
            //             'name' => 'محصول 3',
            //             'category_id' => 3,
            //             'description' => 'Description3',
            //             'thumbnail' => "resources/images/single-product/5.jpg"
            //         ],
            //     ]),
            // ];
        } else {
            $this->results = [];
        }
    }

    public function clear(){
        $this->searchTerm = '';
        $this->results = [];
    }


    public function render()
    {
        return view('livewire.search');
    }
}
