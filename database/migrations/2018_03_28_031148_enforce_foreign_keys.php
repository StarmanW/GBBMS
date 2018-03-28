<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EnforceForeignKeys extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //Add foreign keys
        Schema::table('event_schedules', function ($table) {
            $table->foreign('staffID')->references('staffID')->on('staff');
            $table->foreign('eventID')->references('eventID')->on('events');
        });

        Schema::table('reservations', function (Blueprint $table) {
            $table->foreign('donorID')->references('donorID')->on('donors');
            $table->foreign('eventID')->references('eventID')->on('events');
        });

        Schema::table('blood', function ($table) {
            $table->foreign('donorID')->references('donorID')->on('donors');
            $table->foreign('eventID')->references('eventID')->on('events');
        });

        Schema::table('events', function ($table) {
            $table->foreign('roomID')->references('roomID')->on('room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //Remove all the foreign keys
        Schema::table('event_schedules', function ($table) {
            $table->dropForeign('staffID');
            $table->dropForeign('eventID');
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign('donorID');
            $table->dropForeign('eventID');
        });
        Schema::table('blood', function ($table) {
            $table->dropForeign('donorID');
            $table->dropForeign('eventID');
        });

        Schema::table('events', function ($table) {
            $table->dropForeign('roomID');
        });
    }
}
