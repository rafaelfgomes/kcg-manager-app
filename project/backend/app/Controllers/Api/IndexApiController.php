<?php

namespace App\Controllers\Api;

use Symfony\Component\HttpFoundation\JsonResponse;

class IndexApiController {
    public function __invoke() {
        return new JsonResponse(['api' => 'kcg-app', 'version' => env('API_VERSION')]);
    }
}
