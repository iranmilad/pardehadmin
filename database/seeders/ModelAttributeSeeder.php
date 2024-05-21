<?php
namespace Database\Seeders;



use App\Models\AttributeItem;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class ModelAttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::where('display_type', 'model')->delete();
        // ایجاد متریال مختلف برای ویژگی model
        $models = [
            ['name' => 'داخلی', 'details' => 'داخلی',"base_unit" =>"", 'img' => '/images/product/inside.svg'],
            ['name' => 'بیرونی', 'details' => 'بیرونی',"base_unit" =>"", 'img' => '/images/product/outside.svg'],
        ];

        $products = Product::all();
        foreach ($products as $product) {
            // ایجاد یک ویژگی model جدید برای هر محصول
            $modelAttribute = Attribute::create([
                'name' => 'مدل',
                'countable' => false,
                'unit' => '',
                'display_type' => 'model',
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
