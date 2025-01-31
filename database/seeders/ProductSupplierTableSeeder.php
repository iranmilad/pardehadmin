<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSupplierTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_supplier')->insert([
            [
                'product_id' => 4, // فرض کنید محصول با ID 1
                'supplier_id' => 1, // Supplier 1
                'combination_id' => 19, // فرض کنید combination_id برای محصول
            ],
            [
                'product_id' => 4, // فرض کنید محصول با ID 2
                'supplier_id' => 2, // Supplier 2
                'combination_id' => 19, // فرض کنید combination_id برای محصول
            ],
            [
                'product_id' => 4, // فرض کنید محصول با ID 2
                'supplier_id' => 2, // Supplier 2
                'combination_id' => 20, // فرض کنید combination_id برای محصول
            ],
            [
                'product_id' => 4, // فرض کنید محصول با ID 1
                'supplier_id' => 1, // Supplier 1
                'combination_id' => 21, // فرض کنید combination_id برای محصول
            ],

        ]);
    }
}
