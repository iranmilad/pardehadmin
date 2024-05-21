<?php

// app/View/Components/Product/Comments.php

namespace App\View\Components\Product;

use Illuminate\View\Component;

class Comments extends Component
{
    // Component logic goes here

    public function render()
    {
        return view('components.product.description');
    }
}
