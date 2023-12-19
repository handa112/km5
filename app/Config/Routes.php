<?php

use CodeIgniter\Router\RouteCollection;

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);


/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['get'], 'news/delete/(:num)', 'News::delete/$1');
$routes->match(['get', 'post'], 'news/edit/(:num)', 'News::edit/$1');
$routes->match(['get', 'post'], 'news/create', 'News::create');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');
$routes->get('(:any)', 'Pages::view/$1');

