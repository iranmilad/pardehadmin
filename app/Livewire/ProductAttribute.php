<?php

namespace App\Livewire;

use Livewire\Component;

class ProductAttribute extends Component
{
    public $productAttributes = [];
    public $selectedAttributes = [1];
    public $items = [];

    public function mount()
    {
        $this->productAttributes = [
            [
                'id' => 1,
                'name' => "رنگ",
                "slug" => "color",
            ],
            [
                'id' => 2,
                'name' => "سایز",
                "slug" => "size",
            ],
            // material
            [
                'id' => 3,
                'name' => "جنس",
                "slug" => "material",
            ],
        ];
        $this->generateItems();
    }
    public function generateItems()
    {
        $this->items = [];
        if (in_array(1, $this->selectedAttributes)) {
            $this->items[] =             [
                "id" => 1,
                "name" => "رنگ",
                "slug" => "color",
                "child" => [
                    [
                        "id" => 1,
                        "name" => "قرمز",
                        "slug" => "red"
                    ],
                    [
                        "id" => 2,
                        "name" => "آبی",
                        "slug" => "blue"
                    ],
                    [
                        "id" => 3,
                        "name" => "سبز",
                        "slug" => "green"
                    ]
                ]
            ];
        }
        if(in_array(2, $this->selectedAttributes)){
            $this->items[] =             [
                "id" => 2,
                "name" => "سایز",
                "slug" => "size",
                "child" => [
                    [
                        "id" => 1,
                        "name" => "کوچک",
                        "slug" => "small"
                    ],
                    [
                        "id" => 2,
                        "name" => "متوسط",
                        "slug" => "medium"
                    ],
                    [
                        "id" => 3,
                        "name" => "بزرگ",
                        "slug" => "large"
                    ]
                ]
            ];
        }
        
        if( in_array(3, $this->selectedAttributes)){
            $this->items[] =             [
                "id" => 3,
                "name" => "جنس",
                "slug" => "material",
                "child" => [
                    [
                        "id" => 1,
                        "name" => "کتان",
                        "slug" => "cotton"
                    ],
                    [
                        "id" => 2,
                        "name" => "پلی استر",
                        "slug" => "polyester"
                    ],
                    [
                        "id" => 3,
                        "name" => "اسلیک",
                        "slug" => "silk"
                    ]
                ]
            ];
        }
    }
    public function updatedSelectedAttributes()
    {
        $this->generateItems();
    }
    public function render()
    {
        return view('livewire.product-attribute');
    }
}
