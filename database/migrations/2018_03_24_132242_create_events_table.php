<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->string('eventID', 10)->primary();
            $table->string('eventName', 255)->nullable(false);
            $table->date('eventDate')->nullable(false);
            $table->time('eventStartTime')->nullable(false);
            $table->time('eventEndTime')->nullable(false);
            $table->string('roomID', 10)->nullable(false)->unique();
            $table->boolean('eventStatus')->nullable(false);
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
        Schema::dropIfExists('events');
    }
}
