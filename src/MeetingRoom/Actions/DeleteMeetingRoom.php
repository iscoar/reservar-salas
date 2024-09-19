<?php

namespace Src\MeetingRoom\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\Common\Responders\ErrorResponderInterface;
use Src\Common\Responders\SuccessResponderInterface;
use Src\MeetingRoom\Domain\MeetingRoomRepositoryInterface;

final class DeleteMeetingRoom extends Controller
{
    private $repository;
    private $errorResponder;
    private $successResponder;

    /**
     * @param \Src\MeetingRoom\Domain\MeetingRoomRepositoryInterface $repository
     * @param \Src\Common\Responders\ErrorResponderInterface $errorResponder
     * @param \Src\Common\Responders\SuccessResponderInterface $successResponder
     */
    public function __construct(MeetingRoomRepositoryInterface $repository, ErrorResponderInterface $errorResponder, SuccessResponderInterface $successResponder)
    {
        $this->repository = $repository;
        $this->errorResponder = $errorResponder;
        $this->successResponder = $successResponder;
    }

    /**
     * Handle the delete meeting room request.
     * @param int $room_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(int $room_id): JsonResponse
    {
        $deleted = $this->repository->delete($room_id);

        if (!$deleted) {
            return $this->errorResponder->respond('not_deleted', 'No se pudo eliminar la sala de juntas', 404);
        }

        return $this->successResponder->respond(['message' => 'Se elimino con exito la sala de juntas']);
    }
}
