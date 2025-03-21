<?php

require __DIR__ . '/../bootstrap.php';

use App\Kernel;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
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
    $entityManager = require rootPath() . '/database/config.php';

    // Criar a configuração de migrations
    $migrationsConfig = require rootPath() . '/migrations.php';

    $configuration = new ConfigurationArray($migrationsConfig);

    // Criar a `DependencyFactory`
    $dependencyFactory = DependencyFactory::fromEntityManager(
        $configuration,
        new ExistingEntityManager($entityManager)
    );

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
    $response = errorExceptionResponse($isApiRoute, $e->getMessage(), $e->getStatusCode());
} catch (Exception $e) {
    $response = errorExceptionResponse($isApiRoute, $e->getMessage());
} finally {
    $response->send();
}
