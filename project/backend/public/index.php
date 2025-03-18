<?php

declare(strict_types = 1);

require __DIR__ . '/../bootstrap.php';

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$apiPrefix = '/api';

$apiRoutesFilepath = rootPath() . '/routes/api.php';

$webRoutesFilepath = rootPath() . '/routes/web.php';

$request = Request::createFromGlobals();

$context = new RequestContext();

$context->fromRequest($request);

$isRouteFileApi = str_contains($request->getPathInfo(), $apiPrefix);

$routeFile = $isRouteFileApi ? $apiRoutesFilepath : $webRoutesFilepath;

$routes = require $routeFile;

$matcher = new UrlMatcher($routes, $context);

try {
    $method = '__invoke';

    $parameters = $matcher->match($request->getPathInfo());

    $controllerClass = $parameters['_controller'];

    if (str_contains($controllerClass, '@')) {
        [$controllerClass, $method] = explode('@', $controllerClass);
    }

    $controller = $container->get($controllerClass);

    $response = call_user_func([$controller, $method]);

    if ($isRouteFileApi && $response instanceof JsonResponse) {
        $response = new JsonResponse(
            ['data' => json_decode($response->getContent())],
            $response->getStatusCode()
        );
    }
} catch (HttpException $e) {
    $response = errorExceptionResponse($isRouteFileApi, $e->getMessage(), $e->getTrace(), $e->getStatusCode());
} catch (Exception $e) {
    $response = errorExceptionResponse($isRouteFileApi, $e->getMessage(), $e->getTrace());
}

$response->send();
