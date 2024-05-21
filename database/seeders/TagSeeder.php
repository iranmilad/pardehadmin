<?php
namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::query()->delete();
        Tag::create(['name' => 'آموزش','description' => "آموزش","type"=>'blog']);
        Tag::create(['name' => 'خبر','description' => "خبر","type"=>'blog']);
        Tag::create(['name' => 'دیزاین','description' => "دیزاین","type"=>'blog']);
        Tag::create(['name' => 'آشپزخانه', 'description' => 'آشپزخانه', 'type' => 'function']);
        Tag::create(['name' => 'پذیرایی', 'description' => 'پذیرایی', 'type' => 'function']);
        Tag::create(['name' => 'اتاق خواب', 'description' => 'اتاق خواب', 'type' => 'function']);
        Tag::create(['name' => 'اتاق کودک', 'description' => 'اتاق کودک', 'type' => 'function']);
        Tag::create(['name' => 'دفتر کار', 'description' => 'دفتر کار', 'type' => 'function']);
        Tag::create(['name' => 'قابل شستشو', 'description' => 'قابل شستشو', 'type' => 'ability']);
        Tag::create(['name' => 'ضد آفتاب', 'description' => 'ضد آفتاب', 'type' => 'ability']);
        // تعداد تگ‌های موجود
        $tagCount = Tag::count();

        // تعداد محصولاتی که می‌خواهید به آن‌ها تگ اضافه کنید
        $productsCount = 10; // به عنوان مثال

        // انتخاب چند محصول به صورت تصادفی
        $products = Product::inRandomOrder()->take($productsCount)->get();

        // اضافه کردن تگ به هر یک از محصولات
        foreach ($products as $product) {
            // تعداد تگ‌هایی که به هر محصول اضافه می‌کنیم
            $tagsToAddCount = rand(1, $tagCount);

            // انتخاب تگ‌های تصادفی
            $tags = Tag::inRandomOrder()->take($tagsToAddCount)->get();

            // اضافه کردن تگ‌ها به محصول
            $product->tags()->attach($tags);
        }
    }
}
