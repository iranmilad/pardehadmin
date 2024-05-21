<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Service;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\AttributeItem;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد متریال مختلف برای ویژگی size
        $sizes = [
            ['name' => 'تعداد', 'details' => 'تعداد',"base_unit" =>"عدد", 'img' => ''],

        ];
        // Create the "sewing" category
        $category = Category::create([
            'title' => 'خدمت دوخت',
            'description' => 'خدمت دوخت',
            'alias' => 'خدمت-دوخت',
            // Add other necessary fields
        ]);

        // Create sample products
        $productData = [
            'title' => 'دوخت پرده',
            'few' => rand(0, 11),
            'price' => '50000',
            'sale_price' => '40000',
            'service' => true,
            'img' => '/images/auth3.jpg',
            'hover_img' => '/images/auth.jpg',
            'description' => 'توضیحات نمونه برای دوخت پرده',
            // Add other products data as needed
        ];

        $product = new Product();
        $product->fill($productData);
        $product->type = 'simple';
        $product->is_top = false;
        $product->is_new = false;
        $product->save();

        $product->categories()->attach($category->id);

        // ایجاد یک ویژگی size جدید برای هر محصول
        $sizeAttribute = Attribute::create([
            'name' => 'تعداد',
            'countable' => false,
            'unit' => 'عدد',
            'display_type' => 'value',
            'guide_link' => ''
        ]);

        // تعداد تصادفی از رنگ‌ها برای هر محصول
        $numberOfsizes = random_int(1, count($sizes));

        // تصادفی کردن آرایه sizes
        shuffle($sizes);

        // انتخاب تعداد مورد نیاز از ابتدای آرایه
        $randomsizes = array_slice($sizes, 0, $numberOfsizes);

        // ایجاد آیتم‌های ویژگی size برای هر رنگ انتخاب شده
        foreach ($randomsizes as $size) {
            AttributeItem::create([
                'name' => $size['name'],
                'base_unit' => $size['base_unit'],
                'details' => $size['details'],
                'attribute_id' => $sizeAttribute->id,
                'img' => $size['img']
            ]);
        }

        // اتصال محصول به ویژگی size مربوطه
        $product->attributes()->attach($sizeAttribute->id);
        // ایجاد متریال مختلف برای ویژگی size
        $sizes = [
            ['name' => 'طول', 'details' => 'طول',"base_unit" =>"متر", 'img' => '/images/product/Default_Height.jpg'],
            ['name' => 'عرض', 'details' => 'عرض',"base_unit" =>"متر", 'img' => '/images/product/Default_Width.jpg'],
        ];
        // ایجاد یک ویژگی size جدید برای هر محصول
        $sizeAttribute = Attribute::create([
            'name' => 'سایز',
            'countable' => false,
            'unit' => 'ابعاد',
            'display_type' => 'size',
            'guide_link' => ''
        ]);

        // تعداد تصادفی از رنگ‌ها برای هر محصول
        $numberOfsizes = random_int(1, count($sizes));

        // تصادفی کردن آرایه sizes
        shuffle($sizes);

        // انتخاب تعداد مورد نیاز از ابتدای آرایه
        $randomsizes = array_slice($sizes, 0, $numberOfsizes);

        // ایجاد آیتم‌های ویژگی size برای هر رنگ انتخاب شده
        foreach ($randomsizes as $size) {
            AttributeItem::create([
                'name' => $size['name'],
                'base_unit' => $size['base_unit'],
                'details' => $size['details'],
                'attribute_id' => $sizeAttribute->id,
                'img' => $size['img']
            ]);
        }


        // اتصال محصول به ویژگی size مربوطه
        $product->attributes()->attach($sizeAttribute->id);


        // Create the "installer" category
        $category = Category::create([
            'title' => 'خدمت نصب',
            'description' => 'خدمت نصب',
            'alias' => 'خدمت-نصب',
            // Add other necessary fields
        ]);

        // Create sample products
        $productData = [
            'title' => 'خدمت نصب',
            'few' => rand(0, 11),
            'price' => '30000',
            'sale_price' => '23000',
            'service' => true,
            'img' => '/images/auth3.jpg',
            'hover_img' => '/images/auth.jpg',
            'description' => 'توضیحات نمونه برای نصب پرده',
            // Add other products data as needed
        ];
        $product = new Product();
        $product->fill($productData);
        $product->type = 'simple';
        $product->is_top = false;
        $product->is_new = false;
        $product->save();
        $product->categories()->attach($category->id);


        // ایجاد یک ویژگی size جدید برای هر محصول
        $sizeAttribute = Attribute::create([
            'name' => 'تعداد',
            'countable' => false,
            'unit' => 'عدد',
            'display_type' => 'value',
            'guide_link' => ''
        ]);
        $sizes = [
            ['name' => 'تعداد', 'details' => 'تعداد',"base_unit" =>"عدد", 'img' => ''],

        ];
        // تعداد تصادفی از رنگ‌ها برای هر محصول
        $numberOfsizes = random_int(1, count($sizes));

        // تصادفی کردن آرایه sizes
        shuffle($sizes);

        // انتخاب تعداد مورد نیاز از ابتدای آرایه
        $randomsizes = array_slice($sizes, 0, $numberOfsizes);

        // ایجاد آیتم‌های ویژگی size برای هر رنگ انتخاب شده
        foreach ($randomsizes as $size) {
            AttributeItem::create([
                'name' => $size['name'],
                'base_unit' => $size['base_unit'],
                'details' => $size['details'],
                'attribute_id' => $sizeAttribute->id,
                'img' => $size['img']
            ]);
        }

        // اتصال محصول به ویژگی size مربوطه
        $product->attributes()->attach($sizeAttribute->id);


        // Create the "design" category
        $category = Category::create([
            'title' => 'خدمت طرحی',
            'description' => 'خدمت طراحی',
            'alias' => 'خدمت-طراحی',
            // Add other necessary fields
        ]);


        // Create sample products
        $productData = [
            'title' => 'خدمت طراحی',
            'few' => rand(0, 11),
            'price' => '34000',
            'sale_price' => '33000',
            'service' => true,
            'img' => '/images/auth3.jpg',
            'hover_img' => '/images/auth.jpg',
            'description' => 'توضیحات نمونه برای طراحی پرده',
            // Add other products data as needed
        ];
        $product = new Product();
        $product->fill($productData);
        $product->type = 'simple';
        $product->is_top = false;
        $product->is_new = false;
        $product->save();

        $product->categories()->attach($category->id);


        // ایجاد یک ویژگی size جدید برای هر محصول
        $sizeAttribute = Attribute::create([
            'name' => 'تعداد',
            'countable' => false,
            'unit' => 'عدد',
            'display_type' => 'value',
            'guide_link' => ''
        ]);

        // تعداد تصادفی از رنگ‌ها برای هر محصول
        $numberOfsizes = random_int(1, count($sizes));

        // تصادفی کردن آرایه sizes
        shuffle($sizes);

        // انتخاب تعداد مورد نیاز از ابتدای آرایه
        $randomsizes = array_slice($sizes, 0, $numberOfsizes);

        // ایجاد آیتم‌های ویژگی size برای هر رنگ انتخاب شده
        foreach ($randomsizes as $size) {
            AttributeItem::create([
                'name' => $size['name'],
                'base_unit' => $size['base_unit'],
                'details' => $size['details'],
                'attribute_id' => $sizeAttribute->id,
                'img' => $size['img']
            ]);
        }

        // اتصال محصول به ویژگی size مربوطه
        $product->attributes()->attach($sizeAttribute->id);




        // Create sample services
        $products = Product::all();
        $categories = Category::all();

        foreach ($products as $product) {
            // Attach random service to each product
            $service = new Service([
                'type' => ['sewing', 'installer', 'design'][rand(0, 2)],
            ]);
            $product->services()->save($service);

            // Optionally, attach a random category to the service
            if (rand(0, 1)) {
                $service->category()->associate($categories->random());
                $service->save();
            }
        }
    }
}
