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
        Schema::create('supplier_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->unsignedTinyInteger('rating'); // امتیاز کلی (1 تا 5)
            $table->unsignedTinyInteger('quality')->nullable(); // کیفیت محصول
            $table->unsignedTinyInteger('service')->nullable(); // کیفیت خدمات
            $table->unsignedTinyInteger('price')->nullable(); // قیمت‌گذاری
            $table->json('images')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_reviews');
    }
};
