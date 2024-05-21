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
        Schema::create('slider_images', function (Blueprint $table) {
            $table->id();

            $table->foreignId('slider_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->string('link')->nullable();
            $table->string('sec_link')->nullable();
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->string('sec_caption')->nullable();
            $table->string('alt')->nullable();
            $table->string('sec_alt')->nullable();
            $table->string('class')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slider_images');
    }
};
