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
        Schema::create('landings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->string('description')->nullable();
            $table->string('cap1')->nullable();
            $table->string('btnLink2')->nullable();
            $table->string('cap2')->nullable();
            $table->string('style')->nullable();
            $table->string('type')->nullable();
            $table->enum('direction', ['rtl', 'ltr'])->default('rtl');
            $table->string('image')->nullable(); // برای ذخیره آدرس تصویر
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landings');
    }
};
