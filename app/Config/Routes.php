<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('stafftable', 'Home::staff');

$routes->get('staff', 'Staff::index');
$routes->post('staff/create', 'Staff::create');
$routes->put('staff/update/(:num)', 'Staff::update/$1');
$routes->delete('staff/delete/(:num)', 'Staff::delete/$1');
