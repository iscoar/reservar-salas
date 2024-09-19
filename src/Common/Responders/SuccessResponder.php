<?php

namespace Src\Common\Responders;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;

class SuccessResponder implements SuccessResponderInterface
{
    /**
     * @var ResponseFactory
     */
    private $responseFactory;

    public function __construct(ResponseFactory $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function respond($content = []): JsonResponse
    {
        return $this->responseFactory->json(array_merge(['type' => 'success'], $content), 200);
    }
}
