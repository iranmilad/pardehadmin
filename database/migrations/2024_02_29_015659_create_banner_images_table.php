<?php

// database/migrations/YYYY_MM_DD_create_banner_images_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerImagesTable extends Migration
{
    public function up()
    {
        Schema::create('banner_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_id')->constrained()->onDelete('cascade');
            $table->string('image');
            $table->string('hover_image')->nullable();
            $table->string('link')->nullable();
            $table->string('title')->nullable();
            $table->text('caption')->nullable();
            $table->string('alt')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_images');
    }
}
