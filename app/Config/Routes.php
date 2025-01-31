<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
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
 * Auth Routes
 * --------------------------------------------------------------------
 */

$routes->match(['get', 'post'], 'login', 'Auth::login'); // LOGIN PAGE
$routes->match(['get', 'post'], 'register', 'Auth::register'); // REGISTER PAGE
$routes->match(['get', 'post'], 'forgotpassword', 'Auth::forgotPassword'); // FORGOT PASSWORD
$routes->match(['get', 'post'], 'activate/(:num)/(:any)', 'Auth::activateUser/$1/$2'); // INCOMING ACTIVATION TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'resetpassword/(:num)/(:any)', 'Auth::resetPassword/$1/$2'); // INCOMING RESET TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'updatepassword/(:num)', 'Auth::updatepassword/$1'); // UPDATE PASSWORD
$routes->match(['get', 'post'], 'lockscreen', 'Auth::lockscreen'); // LOCK SCREEN
$routes->get('logout', 'Auth::logout'); // LOGOUT

/**
 * --------------------------------------------------------------------
 * Checkout / Payment Routes
 * --------------------------------------------------------------------
 */

$routes->post('/checkout', 'Checkout::process_checkout');


/**
 * --------------------------------------------------------------------
 * SUPER ADMIN ROUTES. MUST BE LOGGED IN AND HAVE ROLE OF '1'
 * --------------------------------------------------------------------
 */

$routes->group('', ['filter' => 'auth:Role,1'], function ($routes) {

	$routes->get('superadmin', 'Superadmin::index'); // SUPER ADMIN DASHBOARD
	$routes->match(['get', 'post'], 'Superadmin/profile', 'Auth::profile'); 

	// GAMBAR URLS
	$routes->post('/gambar/add', 'Gambar::save_new');
	$routes->post('/gambar/edit/(:num)', 'Gambar::save_edit/$1');
	$routes->get('/gambar/add', 'Gambar::add');
	$routes->get('/gambar/edit/(:num)', 'Gambar::edit/$1');
	$routes->get('/gambar/delete/(:num)', 'Gambar::delete/$1');
	$routes->get('/gambar', 'Gambar::index');

	// PRODUK URLS
	$routes->get('/produk/add', 'Produk::add');
	$routes->get('/produk/edit/(:num)', 'Produk::edit/$1');
	$routes->get('/produk/slug/(:any)', 'Produk::slug/$1');
	$routes->get('/produk/delete/(:num)', 'Produk::delete/$1');
	$routes->get('/produk', 'Produk::index');
	$routes->post('/produk/edit/(:num)', 'Produk::save_edit/$1');
	$routes->post('/produk/add', 'Produk::save_new');
	
	// KATEGORI URLS
	$routes->get('/kategori/add', 'Kategori::add');
	$routes->get('/kategori/edit/(:num)', 'Kategori::edit/$1');
	$routes->get('/kategori/slug/(:any)', 'Kategori::slug/$1');
	$routes->get('/kategori/delete/(:num)', 'Kategori::delete/$1');
	$routes->get('/kategori', 'Kategori::index');
	$routes->post('/kategori/add', 'Kategori::save_new');
	$routes->post('/kategori/edit/(:num)', 'Kategori::save_edit/$1');

		
});


/**
 * --------------------------------------------------------------------
 * ADMIN ROUTES. MUST BE LOGGED IN AND HAVE ROLE OF '2'
 * --------------------------------------------------------------------
 */

$routes->group('', ['filter' => 'auth:Role,2'], function ($routes){

	$routes->get('dashboard', 'Dashboard::index'); // ADMIN DASHBOARD
	$routes->match(['get', 'post'], 'dashboard/profile', 'Auth::profile');

	$routes->post('/produk/edit/(:num)', 'Produk::save_edit/$1');
	$routes->post('/produk/add', 'Produk::save_new');
	
});


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Produk::homepage');

/*
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





if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
