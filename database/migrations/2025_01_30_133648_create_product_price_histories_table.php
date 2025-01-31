<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_price_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->date('date'); // تاریخ ثبت قیمت
            $table->bigInteger('min_price');
            $table->bigInteger('max_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_price_histories');
    }
};
