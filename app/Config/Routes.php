<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Inicio::index');
$routes->get('idioma/(:segment)', 'Inicio::idioma/$1');
$routes->match(['GET', 'POST'], 'registro', 'Registro::index');
$routes->get('entrar', 'Acceso::entrar');
$routes->post('entrar', 'Acceso::autenticar');
$routes->get('salir', 'Acceso::salir');
$routes->get('activar/(:segment)', 'Acceso::activar/$1');
$routes->match(['GET', 'POST'], 'recuperar', 'Recuperacion::index');
$routes->match(['GET', 'POST'], 'restablecer/(:segment)', 'Recuperacion::nueva/$1');
