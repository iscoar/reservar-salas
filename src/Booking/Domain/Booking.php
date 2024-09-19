<?php

namespace Src\Booking\Domain;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'meeting_rooms_booking_times';
    protected $fillable = ['room_id', 'starts_at', 'ends_at', 'active_booking'];
}
