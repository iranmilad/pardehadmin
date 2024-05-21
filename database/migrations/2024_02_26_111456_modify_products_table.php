<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add new columns
            $table->enum('inventory_display', ['few', 'fewspd', 'fewtak'])->default('few');
            $table->integer('minimum_quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop added columns
            $table->dropColumn('inventory_display');
            $table->dropColumn('minimum_quantity');
        });
    }
}
