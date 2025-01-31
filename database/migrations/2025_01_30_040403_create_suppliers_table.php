<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Migration for suppliers table
    public function up()
    {
        // جدول تامین‌کنندگان
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // هر تامین‌کننده یک یوزر است
            $table->string('name'); // نام تامین‌کننده
            $table->string('payment_type'); // نوع پرداخت
            $table->text('delivery_areas')->nullable(); // مناطق تحویل
            $table->string('buy_type'); // نوع خرید
            $table->string('sku')->nullable(); // SKU
            $table->decimal('price', 10, 2)->nullable(); // قیمت تامین‌کننده
            $table->decimal('sale_price', 10, 2)->nullable(); // قیمت فروش
            $table->decimal('wholesale_price', 10, 2)->nullable(); // قیمت عمده‌فروشی
            $table->integer('few')->nullable(); // مقدار few
            $table->integer('fewspd')->nullable(); // مقدار fewspd
            $table->integer('fewtak')->nullable(); // مقدار fewtak
            $table->string('holo_code')->nullable(); // کد هولو
            $table->integer('min_order')->nullable(); // حداقل سفارش
            $table->integer('max_order')->nullable(); // حداکثر سفارش
            $table->decimal('rating', 3, 2)->nullable(); // امتیاز

            $table->timestamps();
        });

        // جدول محصول-تامین‌کننده
        Schema::create('product_supplier', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('combination_id')->nullable(); // تعریف فیلد combination_id
            $table->foreign('combination_id')->references('id')->on('product_attribute_combinations')->onDelete('cascade'); // تعریف foreign key برای combination_id
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_supplier');
        Schema::dropIfExists('suppliers');
    }
};
