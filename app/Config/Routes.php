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
$routes->get('/', 'Auth::index', ['filter' => 'no_auth']);
$routes->get('/auth/registrasi', 'auth::registrasi', ['filter' => 'admin']);
$routes->get('/registrasi', 'auth::registrasi', ['filter' => 'admin']);
$routes->get('/logout', 'auth::logout', ['filter' => 'auth']);
$routes->get('/auth/logout', 'auth::logout', ['filter' => 'auth']);

//Admin
$routes->get('/admin', 'admin::index', ['filter' => 'admin']);
//User
$routes->group('/user', ['filter' => 'admin'], function ($routes) {
	$routes->add('', 'user::index');
	$routes->add('index', 'user::index');
	$routes->delete('(:num)', 'user::delete/$1');
});

//Montir
$routes->group('/montir', ['filter' => 'admin'], function ($routes) {
	$routes->add('', 'montir::index');
	$routes->add('index', 'montir::index');
	$routes->delete('(:num)', 'montir::delete/$1');
});

//pelanggan
$routes->group('/pelanggan', ['filter' => 'customer'], function ($routes) {
	$routes->add('', 'pelanggan::index');
	$routes->add('index', 'pelanggan::index');
	$routes->add('tambah', 'pelanggan::tambah');
	$routes->add('save', 'pelanggan::save');
	$routes->add('edit/(:num)', 'pelanggan::edit/$1');
	$routes->add('update', 'pelanggan::update');
	$routes->delete('(:num)', 'pelanggan::delete/$1');
});

//Barang
$routes->group('/barang', ['filter' => 'admin'], function ($routes) {
	$routes->add('index', 'barang::index');
	$routes->add('', 'barang::index');
	$routes->add('tambah', 'barang::tambah');
	$routes->add('save', 'barang::save');
	$routes->add('edit/(:num)', 'barang::edit/$1');
	$routes->add('update', 'barang::update');
	$routes->delete('(:num)', 'barang::delete/$1');
});

//pembayaran
$routes->group('/pembayaran', ['filter' => 'kasir'],  function ($routes) {
	$routes->add('', 'pembayaran::index');
	$routes->add('index', 'pembayaran::index');
	$routes->add('history', 'pembayaran::history');
	$routes->add('bayar/(:num)', 'pembayaran::bayar/$1');
	$routes->add('transaksi', 'pembayaran::transaksi');
});

//Profile
$routes->get('/profile', 'profile::index', ['filter' => 'auth']);
$routes->get('/profile/index', 'profile::index', ['filter' => 'auth']);


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
