<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//Auth
$routes->get('/auth/index', 'Auth::index', ['filter' => 'no_auth']);
$routes->get('/', 'Auth::index', ['filter' => 'no_auth']);
$routes->get('/auth/registrasi', 'auth::registrasi', ['filter' => 'admin']);
$routes->get('/registrasi', 'auth::registrasi', ['filter' => 'admin']);
$routes->get('/logout', 'auth::logout', ['filter' => 'auth']);
$routes->get('/auth/logout', 'auth::logout', ['filter' => 'auth']);

//Admin
$routes->get('/admin', 'admin::index', ['filter' => 'admin']);

//Montir
$routes->get('/montir', 'montir::index', ['filter' => 'admin']);
$routes->delete('/montir/(:num)', 'montir::delete/$1', ['filter' => 'admin']);

//pelanggan
$routes->group('/pelanggan', ['filter' => 'customer'], function ($routes) {
	$routes->resource('index');
	$routes->add('tambah', 'pelanggan::tambah');
});
$routes->get('/pelanggan', 'pelanggan::index', ['filter' => 'customer']);
// $routes->get('/pelanggan/tambah', 'pelanggan::tambah');
$routes->get('/pelanggan', 'pelanggan::save', ['filter' => 'customer']);
$routes->get('/pelanggan/edit/(:num)', 'pelanggan::edit/$1', ['filter' => 'customer']);
$routes->get('/pelanggan/update', 'pelanggan::update', ['filter' => 'customer']);
$routes->delete('/pelanggan/(:num)', 'pelanggan::delete/$1');

//Barang
$routes->get('/barang/index', 'barang::index', ['filter' => 'customer']);
$routes->get('/barang', 'barang::index', ['filter' => 'customer']);
$routes->get('/barang/tambah', 'barang::tambah', ['filter' => 'customer']);
$routes->get('/barang/save', 'barang::save', ['filter' => 'customer']);
$routes->get('/barang/edit/(:num)', 'barang::edit/$1', ['filter' => 'customer']);
$routes->get('/barang/update', 'barang::update', ['filter' => 'customer']);
$routes->delete('/barang/(:num)', 'barang::delete/$1', ['filter' => 'customer']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
