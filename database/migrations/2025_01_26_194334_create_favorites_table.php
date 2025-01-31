<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();

           // تعریف کلید خارجی برای user_id
           $table->unsignedBigInteger('user_id');
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

           // تعریف کلید خارجی برای product_id با استفاده از unsignedInteger
           $table->unsignedInteger('product_id');
           $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->timestamps();

            // جلوگیری از ثبت تکراری برای user_id و product_id
            $table->unique(['user_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
