<?php
namespace Database\Seeders;



use App\Models\AttributeItem;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class WarrantyAttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::where('display_type', 'options')->delete();
        // ایجاد متریال مختلف برای ویژگی model
        $models = [
            ['name' => 'سه ساله', 'details' => '3 سال گارانتی محدود',"price"=>'0',"base_unit" =>"سال", 'img' => ''],
            ['name' => 'پنج ساله محدود', 'details' => '5 سال گارانتی محدود',"price"=>'60000',"base_unit" =>"سال", 'img' => ''],
            ['name' => 'پنج ساله نامحدود', 'details' => '5 سال گارانتی نامحدود',"price"=>'120000',"base_unit" =>"سال", 'img' => ''],
        ];

        $products = Product::all();
        foreach ($products as $product) {
            // ایجاد یک ویژگی model جدید برای هر محصول
            $modelAttribute = Attribute::create([
                'name' => 'گارانتی',
                'countable' => false,
                'unit' => '',

                'display_type' => 'options',
                'guide_link' => ''
            ]);

            // تعداد تصادفی از رنگ‌ها برای هر محصول
            $numberOfmodels = random_int(1, count($models));

            // تصادفی کردن آرایه models
            shuffle($models);

            // انتخاب تعداد مورد نیاز از ابتدای آرایه
            $randommodels = array_slice($models, 0, $numberOfmodels);

            // ایجاد آیتم‌های ویژگی model برای هر رنگ انتخاب شده
            foreach ($randommodels as $model) {
                AttributeItem::create([
                    'name' => $model['name'],
                    'base_unit' => $model['base_unit'],
                    'price' => $model['price'],
                    'details' => $model['details'],
                    'attribute_id' => $modelAttribute->id,
                    'img' => $model['img']
                ]);
            }

            // اتصال محصول به ویژگی model مربوطه
            $product->attributes()->attach($modelAttribute->id);
        }

    }
}
