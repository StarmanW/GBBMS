<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood', function (Blueprint $table) {
            $table->string('bloodBagID', 10)->primary();
            $table->string('donorID', 10);
            $table->string('eventID', 10);
            $table->integer('bloodType')->nullable(false);
            $table->float('bloodVol', 8, 2)->nullable(false);
            $table->string('remarks');
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
        Schema::dropIfExists('bloods');
    }
}
