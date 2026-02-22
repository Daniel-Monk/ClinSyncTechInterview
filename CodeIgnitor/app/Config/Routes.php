<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('api/login', 'Api\AuthController::login');

$routes->group('api', static function ($routes) {
    $routes->get('health', 'Api\Health::index');
});

$routes->group('api', ['filter' => 'auth'], static function ($routes) {
    $routes->get('patients', 'Api\PatientController::index');
    $routes->post('patients', 'Api\PatientController::create');
    $routes->get('appointments', 'Api\AppointmentController::index');
    $routes->post('appointments', 'Api\AppointmentController::create');
});
