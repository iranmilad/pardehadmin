<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->string('code')->unique();
            $table->integer('discount_amount');
            $table->boolean('is_used')->default(false);
            $table->enum('usage_type', ['single', 'multiple'])->default('single');
            $table->enum('discount_type', ['percentage_cart','percentage_product','fixed_cart','fixed_product'])->default('percentage_cart');
            $table->unsignedInteger('usage_limit')->nullable();
            $table->unsignedInteger('usage_count')->default(0);
            $table->dateTime('discount_expire_start')->nullable();
            $table->dateTime('discount_expire_end')->nullable();
            $table->unsignedBigInteger('min_amount', 8, 2)->nullable(); // حداقل مقدار سفارش
            $table->unsignedBigInteger('max_amount', 8, 2)->nullable(); // حداکثر مقدار تخفیف
            $table->boolean('except_special_products')->default(false); // محصولات ویژه بدون تخفیف
            $table->text('allowed_products')->nullable(); // محصولات مجاز برای تخفیف
            $table->text('disallowed_products')->nullable(); // محصولات غیر مجاز برای تخفیف
            $table->text('allowed_categories')->nullable(); // دسته‌های مجاز برای تخفیف
            $table->text('disallowed_categories')->nullable(); // دسته‌های غیر مجاز برای تخفیف
            $table->integer('usage_limit_per_user')->nullable(); // حد استفاده برای هر کاربر
            $table->enum('status',['active', 'deactivate'])->default('active');

            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('discount_code_id')->nullable();
            $table->foreign('discount_code_id')->references('id')->on('discount_codes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['discount_code_id']);
            $table->dropColumn('discount_code_id');
        });

        Schema::dropIfExists('discount_codes');
    }
}
