<?php
namespace Database\Seeders;



use App\Models\AttributeItem;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Database\Seeder;

class MaterialAttributeSeeder extends Seeder
{
    public function run()
    {
        Attribute::where('display_type', 'material')->delete();
        // ایجاد متریال مختلف برای ویژگی material
        $materials = [
            ['name' => 'کتان', 'details' => 'کتان', 'img' => '/images/materials/1.jpg'],
            ['name' => 'حریر', 'details' => 'حریر', 'img' => '/images/materials/2.jpg'],
            ['name' => 'مخمل', 'details' => 'مخمل', 'img' => '/images/materials/3.jpg'],
            ['name' => 'هازان', 'details' => 'هازان', 'img' => '/images/materials/4.jpg'],
            ['name' => 'مخمل پتینه', 'details' => 'مخمل پتینه', 'img' => '/images/materials/5.jpg'],
            ['name' => 'کتان مخمل', 'details' => 'کتان مخمل', 'img' => '/images/materials/6.jpg'],
            ['name' => 'مخمل حریر', 'details' => 'مخمل حریر', 'img' => '/images/materials/1.jpg'],
        ];

        $products = Product::all();
        foreach ($products as $product) {
            // ایجاد یک ویژگی material جدید برای هر محصول
            $materialAttribute = Attribute::create([
                'name' => 'جنس',
                'countable' => false,
                'unit' => '',
                'display_type' => 'material',
                'guide_link' => ''
            ]);

            // تعداد تصادفی از رنگ‌ها برای هر محصول
            $numberOfmaterials = random_int(1, count($materials));

            // تصادفی کردن آرایه materials
            shuffle($materials);

            // انتخاب تعداد مورد نیاز از ابتدای آرایه
            $randommaterials = array_slice($materials, 0, $numberOfmaterials);

            // ایجاد آیتم‌های ویژگی material برای هر رنگ انتخاب شده
            foreach ($randommaterials as $material) {
                AttributeItem::create([
                    'name' => $material['name'],
                    'details' => $material['details'],
                    'attribute_id' => $materialAttribute->id,
                    'img' => $material['img']
                ]);
            }

            // اتصال محصول به ویژگی material مربوطه
            $product->attributes()->attach($materialAttribute->id);
        }

    }
}
