<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Inicio::index');
$routes->get('idioma/(:segment)', 'Inicio::idioma/$1');
