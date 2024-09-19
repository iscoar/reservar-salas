<?php

namespace Src\MeetingRoom\Domain;

use Illuminate\Database\Eloquent\Model;

class MeetingRoom extends Model
{
    protected $fillable = ['name'];

    /**
     * Get the bookings for the meeting room.
     */
    public function bookings()
    {
        return $this->hasMany('Src\Booking\Domain\Booking', 'room_id');
    }
}
