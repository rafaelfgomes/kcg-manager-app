<?php

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;

function createRoute(
    string $routePath,
    string $controllerName,
    array $methods = [Request::METHOD_GET]
): Route {
    $prefixControllerNamespace = str_contains($routePath, 'api')
        ? 'App\Controllers\Api\\'
        : 'App\Controllers\Web\\';

    return new Route(
        $routePath,
        ['_controller' => $prefixControllerNamespace . $controllerName],
        [],
        [],
        '',
        [],
        $methods
    );
}

function errorExceptionResponse(
    bool $isRouteFileApi,
    string $message,
    int $errorCode = Response::HTTP_INTERNAL_SERVER_ERROR
): Response {
    if ($isRouteFileApi) {
        return new JsonResponse(['error' => $message, 'code' => $errorCode], $errorCode);
    }

    ob_start(function() use ($message) {
        return getHtmlTemplate($message);
    });

    return new Response(ob_get_flush(), $errorCode);
}
