<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Inicio::index');
$routes->get('idioma/(:segment)', 'Inicio::idioma/$1');
$routes->match(['GET', 'POST'], 'registro', 'Registro::index');
$routes->get('activar/(:segment)', 'Acceso::activar/$1');
