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
        Schema::create('credit_plan_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('credit_plan_id');
            $table->unsignedInteger('product_id');
            $table->timestamps();

            $table->foreign('credit_plan_id')->references('id')->on('credit_plans')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_plan_products');
    }
};
