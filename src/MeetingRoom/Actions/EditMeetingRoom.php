<?php

namespace Src\MeetingRoom\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Common\Responders\ErrorResponderInterface;
use Src\Common\Responders\SuccessResponderInterface;
use Src\MeetingRoom\Domain\MeetingRoomRepositoryInterface;

final class EditMeetingRoom extends Controller
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
     * Handle the edit meeting room request.
     * @param \Illuminate\Http\Request $request
     * @param int $room_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request, int $room_id): JsonResponse
    {
        if (!$request->filled('name')) {
            return $this->errorResponder->respond('empty_fields', 'debe contener un nombre', 404);
        }

        $data = $request->all();

        $updated = $this->repository->update($room_id, $data);

        if (!$updated) {
            return $this->errorResponder->respond('not_updated', 'No se pudo actualizar la sala de juntas', 404);
        }

        return $this->successResponder->respond(['message' => 'Se actualizo con exito la sala de juntas']);
    }
}
