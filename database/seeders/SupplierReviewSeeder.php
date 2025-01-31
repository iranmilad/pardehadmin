<?php

namespace Database\Seeders;

use App\Models\SupplierReview;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierReviewSeeder extends Seeder
{
    public function run()
    {
        SupplierReview::insert([
            [
                'supplier_id' => 1, // تأمین‌کننده مرتبط با محصول ۴
               'user_id' => 2, // کاربر ثبت‌کننده نظر
                'rating' => 5,
                'text' => 'کیفیت عالی و ارسال سریع!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 1,
                'user_id' => 2,
                'rating' => 4,
                'text' => 'قیمت مناسب، اما زمان ارسال کمی طولانی بود.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 2,
                'user_id' => 5,
                'rating' => 3,
                'text' => 'متوسط بود، نیاز به بهبود در بسته‌بندی.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'supplier_id' => 2,
                'user_id' => 5,
                'rating' => 2,
                'text' => 'متأسفانه کالا دیر رسید و قیمت نسبت به کیفیت بالا بود.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
