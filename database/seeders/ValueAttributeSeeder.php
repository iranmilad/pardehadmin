<?php
namespace Database\Seeders;



use App\Models\AttributeItem;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class ValueAttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::where('display_type', 'value')->delete();
        // ایجاد متریال مختلف برای ویژگی size
        $sizes = [
            ['name' => 'تعداد', 'details' => 'تعداد',"base_unit" =>"عدد", 'img' => ''],

        ];

        $products = Product::all();
        foreach ($products as $product) {
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
        }

    }
}
