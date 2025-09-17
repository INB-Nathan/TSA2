<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');
$routes->get('register', 'Register::index');
$routes->post('register/submit', 'Register::submit');