<?php
namespace Database\Seeders;


use App\Models\AttributeItem;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class ColorAttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::where('display_type', 'color')->delete();
        // ایجاد رنگ‌های مختلف برای ویژگی color
        $colors = [
            ['name' => 'black','details' => 'سیاه', 'img' => ''],
            ['name' => 'gray','details' => 'خاکستری', 'img' => ''],
            ['name' => 'orange','details' => 'نارنجی', 'img' => ''],
            ['name' => 'yellow','details' => 'زرد', 'img' => ''],
            ['name' => 'blue','details' => 'آبی', 'img' => ''],
            ['name' => 'purple','details' => 'بنفش', 'img' => ''],
            ['name' => 'pink','details' => 'صورتی', 'img' => ''],
        ];

        $products = Product::all();
        foreach ($products as $product) {
            // ایجاد یک ویژگی color جدید برای هر محصول
            $colorAttribute = Attribute::create([
                'name' => 'رنگ',
                'countable' => false,
                'unit' => '',
                'display_type' => 'color',
                'guide_link' => ''
            ]);

            // تعداد تصادفی از رنگ‌ها برای هر محصول
            $numberOfColors = random_int(1, count($colors));

            // تصادفی کردن آرایه colors
            shuffle($colors);

            // انتخاب تعداد مورد نیاز از ابتدای آرایه
            $randomColors = array_slice($colors, 0, $numberOfColors);

            // ایجاد آیتم‌های ویژگی color برای هر رنگ انتخاب شده
            foreach ($randomColors as $color) {
                AttributeItem::create([
                    'name' => $color['name'],
                    'details' => $color['details'],
                    'attribute_id' => $colorAttribute->id,
                    'img' => $color['img']
                ]);
            }

            // اتصال محصول به ویژگی color مربوطه
            $product->attributes()->attach($colorAttribute->id);
        }

    }
}
