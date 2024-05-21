<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderAttributeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_attribute_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('order_item_id');
            $table->foreign('order_item_id')->references('id')->on('order_items')->onDelete('cascade');

            $table->unsignedInteger('attribute_item_id');
            $table->foreign('attribute_item_id')->references('id')->on('attribute_items')->onDelete('cascade');

            $table->string('name');
            $table->string('value')->nullable();

            $table->bigInteger('price')->nullable();
            $table->bigInteger('sale_price')->nullable();

            $table->bigInteger('total')->nullable();

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
        Schema::dropIfExists('order_attribute_items');
    }
}
