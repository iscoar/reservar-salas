<?php

namespace Src\Booking\Domain;

class BookingRepository implements BookingRepositoryInterface
{
    public function find(int $id): ?Booking
    {
        return Booking::where('id', $id)
            ->where('active_booking', '1')
            ->first();
    }

    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function cancel(int $id): bool
    {
        $booking = $this->find($id);

        if (!$booking) {
            return false;
        }

        return $booking->update(['active_booking' => '0']);
    }
}
