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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('merchant_code')->nullable();
            $table->text('success_message')->nullable();
            $table->text('failure_message')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gateway_id')->constrained()->onDelete('cascade');
            $table->string('bankname');
            $table->string('accountnumber');
            $table->string('cardnumber')->nullable();
            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('gateway_id')->nullable()->constrained('gateways');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['gateway_id']);
            $table->dropColumn('gateway_id');

        });
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('gateways');

    }
};
