<?php
namespace Database\Seeders;

use App\Models\Check;
use App\Models\Product;
use App\Models\CreditPlan;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تعداد چک‌های مورد نیاز
        $numberOfChecks = 2;

        for ($i = 0; $i < $numberOfChecks; $i++) {
            // انتخاب تصادفی یک کالا
            $order = Order::inRandomOrder()->first();

            // ایجاد یک چک جدید با مقادیر تصادفی
            // Check::create([
            //     'user_id' => 4, // مقداردهی موقت به شناسه کاربر
            //     'amount' => rand(100, 1000), // مقدار تصادفی برای مبلغ چک
            //     'check_number' => 'CHK' . rand(1000, 9999), // شماره چک تصادفی
            //     'due_date' => now()->addDays(rand(1, 30)), // تاریخ سررسید تصادفی
            //     'payment_status' => 'unpaid', // وضعیت پرداخت تصادفی
            //     'order_id' => $order->id, // شناسه کالای تصادفی
            // ]);
        }
    }
}
