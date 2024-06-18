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
        Schema::create('discount_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('discount_code_id');
            $table->unsignedInteger('category_id');
            $table->timestamps();

            $table->foreign('discount_code_id')->references('id')->on('discount_codes')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_category');
    }
};
