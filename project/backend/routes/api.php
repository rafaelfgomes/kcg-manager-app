<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

// $prefixControllerNamespace = 'App\Controllers\Api\\';

$routes->add('api.index', createRoute('/api', 'IndexApiController'));

#####
# Customer routes
#####
$routes->add('customers.all', createRoute('/api/customers', 'Customer\GetAllCustomersController'));

$routes->add(
    'customer.create',
    createRoute(
        '/api/customers',
        'Customer\CreateCustomerController',
        [Request::METHOD_POST]
    )
);

$routes->add(
    'customer.search.by-email',
    createRoute(
        '/api/customers/search/by-email/{email}',
        'Customer\GetCustomerByEmailController',
        [Request::METHOD_GET]
    )
);
#####
# Customer routes (fim)
#####

#####
# Admin routes
#####
$routes->add(
    'admin.search.by-email',
    createRoute(
        '/api/admins/search/by-email/{email}',
        'Admin\GetAdminByEmailController',
        [Request::METHOD_GET]
    )
);

$routes->add(
    'admin.create',
    createRoute(
        '/api/admins',
        'Admin\CreateAdminController',
        [Request::METHOD_POST]
    )
);
#####
# Admin routes (fim)
#####

return $routes;