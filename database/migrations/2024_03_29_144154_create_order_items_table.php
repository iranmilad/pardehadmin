<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->integer('quantity');

            $table->bigInteger('installer')->nullable();
            $table->bigInteger('designer')->nullable();
            $table->bigInteger('sewing')->nullable();

            $table->bigInteger('price')->nullable();
            $table->bigInteger('sale_price')->nullable();

            $table->bigInteger('total')->nullable();


            $table->enum('item_type', ['simple', 'variation', 'shipping']);
            $table->enum('status', ['waiting', 'processing', 'complete','cancel','stop','referral'])->default('waiting');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
