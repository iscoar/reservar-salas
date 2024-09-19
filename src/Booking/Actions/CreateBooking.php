<?php

namespace Src\Booking\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Src\Booking\Domain\BookingRepositoryInterface;
use Src\Common\Responders\ErrorResponderInterface;
use Src\Common\Responders\SuccessResponderInterface;

final class CreateBooking extends Controller
{
    const MIN_VALUE = 1;
    const MAX_VALUE = 120;
    private $repository;
    private $errorResponder;
    private $successResponder;

    /**
     * @param \Src\Booking\Domain\BookingRepositoryInterface $repository
     * @param \Src\Common\Responders\ErrorResponderInterface $errorResponder
     * @param \Src\Common\Responders\SuccessResponderInterface $successResponder
     */
    public function __construct(BookingRepositoryInterface $repository, ErrorResponderInterface $errorResponder, SuccessResponderInterface $successResponder)
    {
        $this->repository = $repository;
        $this->errorResponder = $errorResponder;
        $this->successResponder = $successResponder;
    }

    /**
     * Handle the create booking request.
     * @param \Illuminate\Http\Request $request
     * @param int $room_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, int $room_id): JsonResponse
    {
        if (!$request->filled('starts_at') || !$request->filled('ends_at')) {
            return $this->errorResponder->respond('empty_fields', 'Debe contener una fecha de inicio y fin', 404);
        }

        $now = new Carbon();
        $starts_at = new Carbon($request->input('starts_at'));
        $ends_at = new Carbon($request->input('ends_at'));

        if ($starts_at < $now) {
            return $this->errorResponder->respond('error', 'No se puede reservar en una fecha pasada', 404);
        }

        if ($starts_at->diffInMinutes($ends_at, false) < self::MIN_VALUE) {
            return $this->errorResponder->respond('error', 'La fecha de fin no puede ser menor a la de inicio', 404);
        }

        if ($this->repository->find($room_id)) {
            return $this->errorResponder->respond('error', 'Esta sala tiene una reserva activa', 404);
        }

        if ($starts_at->diffInMinutes($ends_at, false) > self::MAX_VALUE) {
            return $this->errorResponder->respond('error', 'No se puede reservar una sala por mas de dos horas', 404);
        }

        $booking = $this->repository->create([
            'room_id' => $room_id,
            'starts_at' => $request->input('starts_at'),
            'ends_at' => $request->input('ends_at')
        ]);

        return $this->successResponder->respond([
            'message' => 'Reserva creada con exito',
            'data' => $booking
        ]);
    }
}
