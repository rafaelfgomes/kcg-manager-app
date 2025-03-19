<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$prefixControllerNamespace = 'App\Controllers\Api\\';

$routes->add('api.index', createRoute('/api', 'IndexApiController'));

$routes->add('users.all', createRoute('/api/users', 'User\GetAllUsersController'));

$routes->add(
    'users.create',
    createRoute(
        '/api/users',
        'User\CreateUserController',
        [Request::METHOD_POST]
    )
);

$routes->add(
    'user.get-by-email',
    createRoute(
        '/api/users/get-by-email/{email}',
        'User\GetUserByEmailController',
        [Request::METHOD_GET]
    )
);

return $routes;