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
        Schema::create('credit_plan_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_plan_id');
            $table->unsignedBigInteger('user_id');


            $table->foreign('credit_plan_id')->references('id')->on('credit_plans')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_plan_user');
    }
};
