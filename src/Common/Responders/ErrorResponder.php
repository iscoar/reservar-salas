<?php

namespace Src\Common\Responders;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;

class ErrorResponder implements ErrorResponderInterface
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function respond($type = 'not_found', $message = null, $code = 404): JsonResponse
    {
        return $this->responseFactory->json(
            [
                'error' => [
                    'type' => $type,
                    'message' => $message,
                ],
            ],
            $code
        );
    }
}
