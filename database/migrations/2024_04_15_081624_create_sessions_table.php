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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('priority')->nullable();
            // اضافه کردن ستون برای جلسه‌های متصل به گروه
            $table->unsignedBigInteger('member_list_id')->nullable();
            $table->foreign('member_list_id')->references('id')->on('member_lists')->onDelete('cascade');

            // اضافه کردن ستون برای جلسه‌های متصل به کاربر
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
