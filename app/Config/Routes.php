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
$routes->get('perfil', 'Perfil::index');
$routes->match(['GET', 'POST'], 'perfil/confirmar', 'Perfil::confirmar');
$routes->match(['GET', 'POST'], 'perfil/editar', 'Perfil::editar');
$routes->match(['GET', 'POST'], 'perfil/contrasena', 'Perfil::contrasena');
$routes->match(['GET', 'POST'], 'perfil/foto', 'Perfil::foto');
$routes->match(['GET', 'POST'], 'perfil/eliminar', 'Perfil::eliminar');
