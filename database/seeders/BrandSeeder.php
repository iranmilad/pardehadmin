<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;


class BrandSeeder extends Seeder
{
    public function run()
    {
        // ایجاد برندهای تصادفی
        Brand::create([
            'title' => 'اپل',
            'alias' => 'apple',
            'image' => 'http://j2b.loc/storage/brand/1.png',
        ]);

        Brand::create([
            'title' => 'سامسونگ',
            'alias' => 'samsung',
            'image' => 'http://j2b.loc/storage/brand/2.png',
        ]);

        Brand::create([
            'title' => 'ایسوس',
            'alias' => 'asus',
            'image' => 'http://j2b.loc/storage/brand/3.png',
        ]);

        Brand::create([
            'title' => 'ال جی',
            'alias' => 'lg',
            'image' => 'http://j2b.loc/storage/brand/4.png',
        ]);
    }
}
