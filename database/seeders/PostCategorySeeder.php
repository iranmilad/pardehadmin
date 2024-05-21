<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategory::create(['name' => 'بدون دسته بندی']);
        PostCategory::create(['name' => 'پرده کتان']);
        PostCategory::create(['name' => 'پرده پذیرایی']);
        PostCategory::create(['name' => 'پرده ابریشمی']);
    }
}
