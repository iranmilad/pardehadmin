<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->boolean('is_special')->default(false)->after('rating'); // وضعیت فروش ویژه
            $table->timestamp('special_time')->nullable()->after('is_special'); // زمان فروش ویژه
        });
    }

    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn(['is_special', 'special_time']);
        });
    }
};
