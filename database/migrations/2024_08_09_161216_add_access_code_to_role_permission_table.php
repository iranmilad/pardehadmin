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
        Schema::table('role_permission', function (Blueprint $table) {
            $table->boolean('read_all')->default(false);
            $table->boolean('read_same_role')->default(false);
            $table->boolean('read_own')->default(false);
            $table->boolean('write_all')->default(false);
            $table->boolean('write_same_role')->default(false);
            $table->boolean('write_own')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('role_permission', function (Blueprint $table) {
            $table->dropColumn('read_all');
            $table->dropColumn('read_same_role');
            $table->dropColumn('read_own');
            $table->dropColumn('write_all');
            $table->dropColumn('write_same_role');
            $table->dropColumn('write_own');
        });
    }
};
