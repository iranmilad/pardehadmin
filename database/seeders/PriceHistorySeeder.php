<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\ProductPriceHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PriceHistorySeeder extends Seeder
{
    public function run()
    {
        $productId = 4; // محصول مورد نظر

        $historicalPrices = [
            ['date' => '2024-01-01', 'min_price' => 950000, 'max_price' => 1200000],
            ['date' => '2024-02-01', 'min_price' => 900000, 'max_price' => 1150000],
            ['date' => '2024-03-01', 'min_price' => 870000, 'max_price' => 1100000],
            ['date' => '2024-04-01', 'min_price' => 880000, 'max_price' => 1080000],
            ['date' => '2024-05-01', 'min_price' => 860000, 'max_price' => 1050000],
        ];

        foreach ($historicalPrices as $data) {
            ProductPriceHistory::create([
                'product_id' => $productId,
                'date' => Carbon::parse($data['date']),
                'min_price' => $data['min_price'],
                'max_price' => $data['max_price'],
            ]);
        }
    }
}
