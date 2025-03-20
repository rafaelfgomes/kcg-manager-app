<?php

require __DIR__ . '/../bootstrap.php';

use Config\Database;
use Config\Kernel;
use Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

const INVOKE_METHOD = '__invoke';

Dotenv::createUnsafeImmutable(rootPath())->load();

date_default_timezone_set(env('TIMEZONE'));

try {

    $entityManager = Database::getEntityManager();

    $kernel = new Kernel($entityManager);

    $container = $kernel->getContainer();

    $request = Request::createFromGlobals();

    $context = (new RequestContext())->fromRequest($request);

    $routeFile = str_starts_with($request->getPathInfo(), '/api') 
        ? rootPath() . '/routes/api.php' 
        : rootPath() . '/routes/web.php';

    $isApiRoute = str_starts_with($request->getPathInfo(), '/api');

    $routes = require $routeFile;

    $matcher = new UrlMatcher($routes, $context);

    $parameters = $matcher->match($request->getPathInfo());

    $controllerDefinition = $parameters['_controller'];

    unset($parameters['_controller'], $parameters['_route']);

    [$controllerClass, $controllerMethod] = str_contains($controllerDefinition, '@') 
        ? explode('@', $controllerDefinition) 
        : [$controllerDefinition, INVOKE_METHOD];

    $controller = $container->get($controllerClass);

    $args = [$request, ...array_values($parameters)];

    if (empty($request->getContent())) {
        unset($args[0]);
    }

    $response = call_user_func_array([$controller, $controllerMethod], $args);

    if ($response instanceof JsonResponse && $isApiRoute) {
        $response = new JsonResponse(
            ['data' => json_decode($response->getContent(), true)], 
            $response->getStatusCode()
        );
    }
} catch (HttpException $e) {
    $response = errorExceptionResponse($isApiRoute, $e->getMessage(), $e->getTrace(), $e->getStatusCode());
} catch (Exception $e) {
    $response = errorExceptionResponse($isApiRoute, $e->getMessage(), $e->getTrace());
}

$response->send();
