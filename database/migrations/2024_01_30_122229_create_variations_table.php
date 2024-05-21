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
        Schema::create('variations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('attribute_item_id')->unsigned();
            $table->foreign('attribute_item_id')->references('id')->on('attribute_items')->onDelete('cascade');

            // ویژگی‌های مختلف
            $table->bigInteger('price')->nullable();
            $table->bigInteger('sale_price')->nullable();
            $table->bigInteger('wholesale_price')->nullable();
            $table->bigInteger('few')->nullable();
            $table->bigInteger('fewspd')->nullable();
            $table->bigInteger('fewtak')->nullable();
            $table->string('holo_code')->nullable();
            $table->string('img');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
