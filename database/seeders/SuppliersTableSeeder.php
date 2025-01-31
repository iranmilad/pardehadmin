<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuppliersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'user_id' => 1, // فرض کنید یوزر با ID 1
                'name' => 'دیجی کالا',
                'payment_type' => 'Cash',
                'delivery_areas' => 'Area 1, Area 2',
                'buy_type' => 'Retail',
                'sku' => 'SKU-001',
                'price' => 100.00,
                'sale_price' => 120.00,
                'wholesale_price' => 90.00,
                'few' => 10,
                'fewspd' => 5,
                'fewtak' => 20,
                'holo_code' => 'Holo-001',
                'min_order' => 1,
                'max_order' => 100,
                'rating' => 4.5,
            ],
            [
                'user_id' => 2, // فرض کنید یوزر با ID 2
                'name' => 'تک اسیا',
                'payment_type' => 'Credit',
                'delivery_areas' => 'Area 3, Area 4',
                'buy_type' => 'Wholesale',
                'sku' => 'SKU-002',
                'price' => 110.00,
                'sale_price' => 130.00,
                'wholesale_price' => 100.00,
                'few' => 15,
                'fewspd' => 8,
                'fewtak' => 25,
                'holo_code' => 'Holo-002',
                'min_order' => 2,
                'max_order' => 150,
                'rating' => 4.8,
            ]
        ]);
    }
}
