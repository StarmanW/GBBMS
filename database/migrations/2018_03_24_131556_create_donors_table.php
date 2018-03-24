<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donors', function (Blueprint $table) {
            $table->string('donorID', 10)->primary();
            $table->string('password', 255)->nullable(false);
            $table->string('ICNum', 12)->unique()->nullable(false);
            $table->date('birthDate')->nullable(false);
            $table->string('firstName', 255)->nullable(false);
            $table->string('lastName', 255)->nullable(false);
            $table->string('emailAddress', 255)->unique()->nullable(false);
            $table->string('phoneNum', 20);
            $table->string('homeAddress', 500);
            $table->integer('bloodType')->nullable(false);
            $table->boolean('donorAccStatus')->nullable(false);
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
        Schema::drop('donors');
    }
}
