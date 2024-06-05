<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');

            $table->bigInteger('price')->nullable();
            $table->bigInteger('sale_price')->nullable();
            $table->bigInteger('wholesale_price')->nullable();

            $table->bigInteger('few')->nullable();
            $table->bigInteger('fewspd')->nullable();
            $table->bigInteger('fewtak')->nullable();
            $table->string('holo_code')->nullable();
            $table->text('description')->nullable();;

            $table->enum('type', ['simple', 'variation'])->default('simple');

            $table->boolean('is_top')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_special')->default(false);
            $table->date('special_time')->nullable();
            $table->boolean('service')->default(false);
            $table->string('img')->default("/images/defaultProduct.png");
            $table->string('hover_img')->nullable();;
            $table->enum('status', ['published', 'inactive'])->default('inactive');
            $table->boolean('reviews_enabled')->default(true);
            $table->string('video_path')->nullable();
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
        Schema::dropIfExists('products');
    }
}
