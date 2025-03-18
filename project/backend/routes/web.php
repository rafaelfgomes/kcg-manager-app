<?php

use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('web.index', createRoute('/', 'IndexWebController'));

return $routes;