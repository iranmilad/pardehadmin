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
        Schema::create('code_pieces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['completed', 'in_progress', 'canceled', 'pending']);
            $table->enum('document_type', ['debit', 'credit']);
            $table->bigInteger('service_total');
            $table->bigInteger('site_commission');
            $table->string('account_number');
            $table->string('transaction_number');
            $table->timestamp('settlement_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_pieces');
    }
};
