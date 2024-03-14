<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('mahasiswa', 'MahasiswaController::index');
$routes->post('mahasiswa', 'MahasiswaController::create');
$routes->put('mahasiswa/(:num)', 'MahasiswaController::update/$1');
$routes->delete('mahasiswa/(:num)', 'MahasiswaController::delete/$1');
