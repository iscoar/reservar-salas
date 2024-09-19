<?php

namespace Src\MeetingRoom\Domain;

use Illuminate\Database\Eloquent\Collection;

class MeetingRoomRepository implements MeetingRoomRepositoryInterface
{
    public function findAll(): Collection
    {
        $rooms = MeetingRoom::with([
            'bookings' => function ($booking) {
                return $booking->where('active_booking', '1');
            }
        ])->get();

        return $rooms;
    }

    public function find(int $id): ?MeetingRoom
    {
        return MeetingRoom::find($id);
    }

    public function create(array $data): MeetingRoom
    {
        return MeetingRoom::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $room = $this->find($id);

        if (!$room) {
            return false;
        }

        return $room->update($data);
    }

    public function delete(int $id): bool
    {
        $room = $this->find($id);

        if (!$room) {
            return false;
        }

        return $room->delete();
    }
}
