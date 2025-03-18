<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

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

return $routes;