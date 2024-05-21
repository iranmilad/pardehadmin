<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements("id");


            $table->string('password');
            $table->boolean('active')->default(true);
            $table->rememberToken();


			$table->string("first_name")->nullable();
			$table->string("last_name")->nullable();
			$table->string("mobile",11)->nullable()->unique();
			$table->string("email")->nullable()->unique();
			$table->timestamp("email_verified_at")->nullable();

            // اضافه کردن فیلدهای آدرس
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();

            $table->boolean('check_payment_active')->default(false);
            $table->boolean('credit_payment_active')->default(false);


            $table->unsignedBigInteger('credit_limit')->nullable();

			$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
