<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->string('staffID', 10)->primary();
            $table->boolean('staffPos')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('ICNum', 12)->unique()->nullable(false);
            $table->date('birthDate')->nullable(false);
            $table->string('firstName')->nullable(false);
            $table->string('lastName')->nullable(false);
            $table->string('emailAddress')->unique()->nullable(false);
            $table->boolean('gender')->nullable(false);
            $table->string('phoneNum', 20);
            $table->string('homeAddress');
            $table->string('profileImage');
            $table->boolean('staffAccStatus')->nullable(false);
            $table->rememberToken();
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
        Schema::drop('staff');
    }
}
