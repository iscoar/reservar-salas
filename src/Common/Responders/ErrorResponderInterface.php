<?php

namespace Src\Common\Responders;

use Illuminate\Http\JsonResponse;

interface ErrorResponderInterface
{
    public function respond(string $type, $message, int $code): JsonResponse;
}
