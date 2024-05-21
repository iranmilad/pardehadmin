<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::query()->delete();
        $faker = Faker::create('fa_IR'); // استفاده از متن‌های فارسی
        $images= [
            '/images/single-product/1.jpg',
            '/images/single-product/2.jpg',
            '/images/single-product/3.jpg',
            '/images/single-product/4.jpg',
            '/images/single-product/5.jpg',
            '/images/single-product/6.jpg',
        ];
        // برای هر محصول
        foreach (Product::all() as $product) {
            // تعداد نظرات تصادفی برای هر محصول
            $numReviews = $faker->numberBetween(1, 5);

            // برای هر نظر
            for ($i = 0; $i < 14; $i++) {

                $user = User::inRandomOrder()->first();
                $quality = $faker->numberBetween(1, 5);
                $design = $faker->numberBetween(1, 5);
                $ease_of_use = $faker->numberBetween(1, 5);
                $performance = $faker->numberBetween(1, 5);
                $price = $faker->numberBetween(1, 5);
                $numImages = $faker->numberBetween(0, 2);
                $selectedImages = $faker->randomElements($images, $numImages);

                // تبدیل آرایه به JSON برای ذخیره در فیلد images
                $jsonImages = json_encode($selectedImages);
                // ایجاد یک نظر تصادفی
                $review = new Review([
                    'title' => $faker->realText(100),
                    'text' => $faker->realText(300),

                    'rating' => $faker->numberBetween(1, 5),

                    'quality' => $quality,
                    'design' => $design,
                    'ease_of_use' => $ease_of_use,
                    'performance' => $performance,
                    'price' => $price,
                    'images' => $jsonImages, // اضافه کردن تصاویر به صورت JSON
                    'name' => $faker->name, // نام کاربر
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                ]);
                $review->save();

            }
        }
    }
}
