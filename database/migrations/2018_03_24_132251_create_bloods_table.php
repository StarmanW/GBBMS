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
            $table->foreign('donorID')->references('donorID')->on('donors');
            $table->foreign('eventID')->references('eventID')->on('events');
            $table->float('bloodVol', 8, 2)->nullable(false);
            $table->string('remarks', 255)->nullable(false);
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
