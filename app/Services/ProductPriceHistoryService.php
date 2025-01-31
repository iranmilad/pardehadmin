<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductPriceHistory;
use Carbon\Carbon;

class ProductPriceHistoryService
{
    public function updateMonthlyPriceHistory()
    {
        // دریافت تمامی محصولات
        $products = Product::all();

        foreach ($products as $product) {
            // دریافت کمترین و بیشترین قیمت از تأمین‌کنندگان محصول
            $minPrice = $product->suppliers()->min('price');
            $maxPrice = $product->suppliers()->max('price');

            if (!is_null($minPrice) && !is_null($maxPrice)) {
                // ذخیره در تاریخچه قیمت
                ProductPriceHistory::create([
                    'product_id' => $product->id,
                    'date' => Carbon::now()->startOfMonth(),
                    'min_price' => $minPrice,
                    'max_price' => $maxPrice,
                ]);
            }
        }
    }
}
