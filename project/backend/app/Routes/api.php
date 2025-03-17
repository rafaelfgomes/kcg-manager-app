<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('api.index', createRoute('/api', 'IndexApiController'));

$routes->add('sysusers.all', createRoute('/api/sysusers', 'SysUsers\GetAllSysUsersController'));

$routes->add(
    'sysusers.create',
    createRoute(
        '/api/sysusers',
        'SysUsers\CreateSysUserController',
        [Request::METHOD_POST]
    )
);

return $routes;