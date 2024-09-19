<?php

namespace Src\MeetingRoom\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Src\Booking\Domain\BookingRepositoryInterface;
use Src\MeetingRoom\Domain\MeetingRoomRepositoryInterface;

final class ShowAllMeetingRooms extends Controller
{
    private $repository;
    private $bookingRepository;

    /**
     * @param \Src\MeetingRoom\Domain\MeetingRoomRepositoryInterface $repository
     * @param \Src\Booking\Domain\BookingRepositoryInterface $bookingRepository
     */
    public function __construct(MeetingRoomRepositoryInterface $repository, BookingRepositoryInterface $bookingRepository)
    {
        $this->repository = $repository;
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * Handle the show all meeting rooms.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke(): Collection
    {
        $now = new Carbon();
        $meeting_rooms = $this->repository->findAll();

        foreach ($meeting_rooms as $room) {
            foreach ($room->bookings as $booking) {
                $ends_at = new Carbon($booking->ends_at);
                if ($now > $ends_at) {
                    $this->bookingRepository->cancel($booking->id);
                }
            }
        }

        return $meeting_rooms;
    }
}
