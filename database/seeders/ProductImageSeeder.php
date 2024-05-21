<?php
namespace Database\Seeders;


use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        ProductImage::query()->delete();
        $products = Product::all();

        // تعداد عکس‌های موجود
        $totalImages = 6;

        foreach ($products as $product) {
            // تعداد تصادفی از عکس‌ها برای هر محصول
            $numberOfImages = rand(1, $totalImages);

            // انتخاب تعداد مورد نیاز از اعداد 1 تا تعداد کل عکس‌ها
            $selectedImages = [];
            while (count($selectedImages) < $numberOfImages) {
                $randomImageIndex = rand(1, $totalImages);
                if (!in_array($randomImageIndex, $selectedImages)) {
                    $selectedImages[] = $randomImageIndex;
                }
            }

            // ایجاد رکورد مرتبط بین هر محصول و عکس‌های انتخاب شده
            foreach ($selectedImages as $imageIndex) {
                ProductImage::create([
                    'url' => "/images/single-product/{$imageIndex}.jpg",
                    'product_id' => $product->id,
                ]);
            }
        }

    }
}
