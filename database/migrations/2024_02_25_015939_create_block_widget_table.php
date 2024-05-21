<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockWidgetTable extends Migration
{
    public function up()
    {
        Schema::create('block_widget', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('widget_id');
            $table->string('block')->unique();
            $table->string('type')->nullable();
            $table->jsonb('settings')->default('{}');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('widget_id')->references('id')->on('widgets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('block_widget');
    }
}
