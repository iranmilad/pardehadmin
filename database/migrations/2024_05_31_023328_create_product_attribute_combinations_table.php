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
        Schema::create('product_attribute_combinations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->integer('price')->nullable();
            $table->integer('sale_price')->nullable();
            $table->integer('wholesale_price')->nullable();
            $table->integer('stock_quantity')->nullable();
            $table->text('description')->nullable();
            $table->text('holo_code')->nullable();
            $table->boolean('independent')->default(false);
            $table->string('img')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attribute_combinations');
    }
};
