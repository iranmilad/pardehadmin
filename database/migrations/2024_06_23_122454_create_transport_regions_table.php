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
        Schema::create('transport_regions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->json('regions');
            $table->string('cost_type');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('user_id')->nullable(); // برای نگهداری اطلاعات کاربری که روش حمل را تعریف کرده است
            $table->decimal('percentage_of_cart_value', 5, 2)->nullable(); // درصد ارزش سبد
            $table->unsignedBigInteger('weight_based_cost')->nullable(); // هزینه بر اساس وزن
            $table->unsignedBigInteger('dimension_based_cost')->nullable(); // هزینه بر اساس ابعاد (طول، عرض، ارتفاع)
            $table->timestamps();

            // تعریف کلید خارجی برای ستون user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transport_regions');
    }
};
