<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
	public function up()
	{
		Schema::create('payments', function (Blueprint $table) {
			$table->bigIncrements("id");
			$table->string("gu_id");
			$table->unsignedBigInteger("user_id");
            $table->unsignedBigInteger("order_id");
			$table->bigInteger("reference_id");
			$table->string("ref_id")->nullable();
			$table->bigInteger("amount");
			$table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
			$table->tinyInteger("type")->comment('1:subscribe')->default(1);
            $table->enum('payment_method', ['cash','check', 'credit','bank'])->default('cash');
			$table->softDeletes();
			$table->bigInteger("deleted_by")->nullable();

			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('payments');
	}
}
