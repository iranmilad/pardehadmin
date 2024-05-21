<?php
namespace Database\Seeders;

use App\Models\Product;
use App\Models\CreditPlan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreditPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ایجاد پلن استاندارد
        $standardPlan = CreditPlan::create([
            'name' => 'Standard Plan',
            'credit_percentage' => 40,
            'installments_count' => 4,
            'installment_percentage' => 10,
            'installment_interval_months' => 1,
        ]);

        // // انتخاب تعداد تصادفی محصولات برای اتصال به پلن استاندارد
        // $standardPlanProducts = Product::inRandomOrder()->limit(rand(1, 5))->get();
        // // اتصال محصولات به پلن استاندارد
        // foreach ($standardPlanProducts as $product) {
        //     $standardPlan->products()->attach($product);
        // }

        // ایجاد پلن پریمیوم
        $premiumPlan = CreditPlan::create([
            'name' => 'Premium Plan',
            'credit_percentage' => 60,
            'installments_count' => 3,
            'installment_percentage' => 20,
            'installment_interval_months' => 1,
        ]);

        // // انتخاب تعداد تصادفی محصولات برای اتصال به پلن پریمیوم
        // $premiumPlanProducts = Product::inRandomOrder()->limit(rand(1, 5))->get();
        // // اتصال محصولات به پلن پریمیوم
        // foreach ($premiumPlanProducts as $product) {
        //     $premiumPlan->products()->attach($product);
        // }
    }
}
