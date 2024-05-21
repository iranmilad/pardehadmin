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
        Schema::create('credit_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('credit_percentage', 5, 2); // درصد اعتبار
            $table->integer('installments_count'); // تعداد اقساط
            $table->decimal('installment_percentage', 5, 2); // درصد هر قسط
            $table->integer('installment_interval_months'); // فاصله هر قسط به ماه
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_plans');
    }
};
