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
        Schema::table('products', function (Blueprint $table) {
            $table->string('measurement_unit')->nullable();
            $table->string('transport_type')->nullable();
            $table->string('cost_calculation_class')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('measurement_unit');
            $table->dropColumn('transport_type');
            $table->dropColumn('cost_calculation_class');
        });
    }
};
