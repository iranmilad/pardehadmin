<?php
namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->delete();

        //Product::query()->delete();

        // Create the "Kourosh" category
        $category = Category::create([
            'title' => 'محصولات اختصاصی کوروش',
            'description' => 'محصولات اختصاصی کوروش کمپانی',
            'alias' => 'برند-کوروش',
            // Add other necessary fields
        ]);



        $products = [
            [
                'title' => 'پرده جدید 1',
                'few' => rand(0,11),
                'price' => '12000000',
                'sale_price' => '10000000',
                'img' => '/images/auth3.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 1',
            ],
            [
                'title' => 'پرده جدید 2',
                'few' => rand(0,11),
                'price' => '11000000',
                'sale_price' => '9000000',
                'img' => '/images/auth2.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 2',
            ],
            [
                'title' => 'پرده جدید 3',
                'few' => rand(0,11),
                'price' => '10000000',
                'img' => '/images/single-product/3.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 3',
            ],
            [
                'title' => 'پرده جدید 4',
                'few' => rand(0,11),
                'price' => '9500000',
                'sale_price' => '8000000',
                'img' => '/images/auth4.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 4',
            ],
            [
                'title' => 'پرده جدید 5',
                'few' => rand(0,11),
                'price' => '8500000',
                'img' => '/images/auth3.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 5',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/1.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 1',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'sale_price' => '9000000',
                'img' => '/images/single-product/2.jpg',
                'hover_img' => '/images/auth2.jpg',
                'description' => 'توضیحات نمونه برای محصول 2',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/3.jpg',
                'hover_img' => '/images/auth3.jpg',
                'description' => 'توضیحات نمونه برای محصول 3',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/1.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 1',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'sale_price' => '9000000',
                'img' => '/images/single-product/2.jpg',
                'hover_img' => '/images/auth2.jpg',
                'description' => 'توضیحات نمونه برای محصول 2',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/3.jpg',
                'hover_img' => '/images/auth3.jpg',
                'description' => 'توضیحات نمونه برای محصول 3',
            ],

            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/1.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 1',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'sale_price' => '8500000',
                'img' => '/images/single-product/2.jpg',
                'hover_img' => '/images/auth2.jpg',
                'description' => 'توضیحات نمونه برای محصول 2',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/3.jpg',
                'hover_img' => '/images/auth3.jpg',
                'description' => 'توضیحات نمونه برای محصول 3',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/1.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 1',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'sale_price' => '8000000',
                'img' => '/images/single-product/2.jpg',
                'hover_img' => '/images/auth2.jpg',
                'description' => 'توضیحات نمونه برای محصول 2',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/3.jpg',
                'hover_img' => '/images/auth3.jpg',
                'description' => 'توضیحات نمونه برای محصول 3',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '11000000',
                'img' => '/images/single-product/1.jpg',
                'hover_img' => '/images/auth.jpg',
                'description' => 'توضیحات نمونه برای محصول 1',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'sale_price' => '9000000',
                'img' => '/images/single-product/2.jpg',
                'hover_img' => '/images/auth2.jpg',
                'description' => 'توضیحات نمونه برای محصول 2',
            ],
            [
                'title' => 'پرده جدیده کتان',
                'few' => rand(0,11),
                'price' => '12000000',
                'img' => '/images/single-product/3.jpg',
                'hover_img' => '/images/auth3.jpg',
                'description' => 'توضیحات نمونه برای محصول 3',
            ],
            // Add more products as needed
        ];

        foreach ($products as $productData) {
            $product = new Product();
            $product->fill($productData);
            $product->type = 'simple';
            $product->is_top = false;
            $product->is_new = false;
            $product->save();
        }

        foreach ($products as $productData) {
            $product = new Product();
            $product->fill($productData);
            $product->type = 'simple';
            $product->is_top = false;
            $product->is_new = false;
            $product->save();

            // Attach the product to the "Kourosh" category
            $product->categories()->attach($category->id);
        }

    }
}
