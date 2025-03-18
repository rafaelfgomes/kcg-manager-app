<?php

require __DIR__ . '/vendor/autoload.php';

use App\Config\Database;
use App\Core\Kernel;
use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

$entityManager = Database::getEntityManager();

$apiPrefix = '/api';

$apiRoutesFilepath = '/app/Routes/api.php';

$webRoutesFilepath = '/app/Routes/web.php';

Dotenv::createUnsafeImmutable(__DIR__)->load();

$kernel = new Kernel();

$container = $kernel->getContainer();

$request = Request::createFromGlobals();

$context = new RequestContext();

$context->fromRequest($request);

$isRouteFileApi = str_contains($request->getPathInfo(), $apiPrefix);

$routeFile = $isRouteFileApi ? __DIR__ . $apiRoutesFilepath : __DIR__ . $webRoutesFilepath;

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
    $response = errorExceptionResponse($isRouteFileApi, $e->getMessage(), $e->getStatusCode());
} catch (Exception $e) {
    $response = errorExceptionResponse($isRouteFileApi, $e->getMessage());
}

$response->send();