<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;


class ApiController extends Controller
{
    public function getResource()
    {
        $data = [
            'img' => "resources/images/single-product/6.jpg",
            'title' => 'پرده پانچی آماده هازان (کتان) رنگ خردلی',
            'price' => '12,800,000',
            'discounted_price' => '11,000,000', // 10.99 - (10.99 * 0.2) = 8.79
            'discount' => "20%",
            'options' => [
                'سایز' => '2*3',
                'رنگ' => 'خردلی',
                'عرض' => '2.6 متر',
                'طول' => '3.5 متر',
                'هدریل' => 'داخلی',
                'حالت بالابر' => 'دستی',
                'همراه با موتور' => 'ندارد',
                'گارانتی' => 'سه سال محدود'
            ]
        ];

        // Render the Blade view
        $html = View::make('components/cart-details', $data)->render();

        // Return the HTML as an API response
        return response()->json(['html' => $html]);
    }
}
