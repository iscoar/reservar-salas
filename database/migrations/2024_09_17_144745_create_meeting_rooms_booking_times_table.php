<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRoomsBookingTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_rooms_booking_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->references('id')->on('meeting_rooms');
            $table->dateTime('starts_at', 0);
            $table->dateTime('ends_at', 0);
            $table->char('active_booking', 1)->default('1');
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
        Schema::dropIfExists('meeting_rooms_booking_times');
    }
}
