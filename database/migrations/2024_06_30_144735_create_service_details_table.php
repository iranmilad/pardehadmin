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
        Schema::create('service_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('normal_price', 8, 2);
            $table->decimal('urgent_price', 8, 2);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('normal_duration'); // duration in minutes
            $table->integer('urgent_duration'); // duration in minutes
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_details');
    }
};
