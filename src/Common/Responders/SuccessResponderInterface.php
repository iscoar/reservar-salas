<?php

namespace Src\Common\Responders;

use Illuminate\Http\JsonResponse;

interface SuccessResponderInterface
{
    public function respond(array $content): JsonResponse;
}
