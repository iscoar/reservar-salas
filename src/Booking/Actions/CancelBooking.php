<?php

namespace Src\Booking\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\Booking\Domain\BookingRepositoryInterface;
use Src\Common\Responders\{SuccessResponderInterface, ErrorResponderInterface};

final class CancelBooking extends Controller
{
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
     * Handle the cancel booking request.
     *
     * @param int $room_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(int $room_id): JsonResponse
    {
        $updated = $this->repository->cancel($room_id);

        if (!$updated) {
            return $this->errorResponder->respond('not_updated', 'No se pudo cancelar esta reserva', 404);
        }

        return $this->successResponder->respond(['message' => 'Se cancelo con exito la reserva para la sala']);
    }
}
