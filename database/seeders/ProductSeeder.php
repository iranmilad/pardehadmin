<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    public function run()
    {
       
        $brands = Brand::all(); // دریافت برندهای موجود

        // دریافت تمام محصولات موجود
        $products = Product::all();

        // اتصال تصادفی برندها به محصولات موجود
        foreach ($products as $product) {
            $randomBrand = $brands->random(); // انتخاب یک برند تصادفی
            $product->brand_id = $randomBrand->id; // اتصال برند به محصول
            $product->save();
        }
    }
}
