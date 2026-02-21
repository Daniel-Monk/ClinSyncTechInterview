<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('api/login','Api\AuthController::login');

$routes->group('api', static function ($routes) {
    $routes->get('health', 'Api\Health::index');
});

