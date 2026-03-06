<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


//El slash "/" representa el HOME de tu aplicación
//es decir www.miweb.com/programador

$routes->get('/', 'Home::index');

//¿Cómo funciona una ruta?
//$routes->verbo('/ruta/', 'Controlador::MetodoAccion');
//Nota: Es posible crear más de una ruta para una vista

$routes->get('/programador', 'Carrera::showIngenieria');
$routes->get('/coder', 'Carrera::showIngenieria');

$routes->get('/creativo', 'Carrera::showDesign');
$routes->get('/marketing', 'Carrera::showDesign');
