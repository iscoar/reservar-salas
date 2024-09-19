<?php

namespace Src\MeetingRoom\Actions;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Common\Responders\ErrorResponderInterface;
use Src\Common\Responders\SuccessResponderInterface;
use Src\MeetingRoom\Domain\MeetingRoomRepositoryInterface;

final class CreateMeetingRoom extends Controller
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
     * Handle the create meeting room request.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        if (!$request->filled('name')) {
            return $this->errorResponder->respond('empty_fields', 'debe contener un nombre', 404);
        }

        $data = $request->all();

        $meeting_room = $this->repository->create($data);

        return $this->successResponder->respond([
            'message' => 'Sala creada con exito',
            'data' => $meeting_room
        ]);
    }
}
