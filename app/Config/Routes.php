<?php

namespace Config;


// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
$routes->get('/pengaduan', 'Pengaduan::index');
$routes->get('/pengaduan/create', 'Pengaduan::create');
$routes->post('/pengaduan/save', 'Pengaduan::save');
$routes->delete('/pengaduan/(:num)', 'Pengaduan::delete/$1');
$routes->post('/pengaduan/update', 'Pengaduan::update/$1');
$routes->get('/pengaduan/edit/(:segment)', 'Pengaduan::edit/$1');
$routes->post('/pengaduan/update/(:segment)', 'Pengaduan::update/$1');
$routes->get('/pengaduan/pending', 'Pengaduan::pending', ['filter' => 'role:admin']);
$routes->get('/pengaduan/finish', 'Pengaduan::finish', ['filter' => 'role:admin']);

// Search
$routes->post('pengaduan', 'Pengaduan::index');



// Admin
// $routes->get('/admin/verifikasi/(:segment)', 'Admin::verifikasi/$1');
$routes->get('admin/verifikasi/(:num)', 'Admin::verifikasi/$1', ['filter' => 'role:admin']);
$routes->get('admin/verifikasi/(:num)/(:segment)', 'Admin::verifikasiStatus/$1/$2', ['filter' => 'role:admin']);
$routes->get('/admin', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin::index', ['filter' => 'role:admin']);
$routes->get('/admin', 'Admin::userlist', ['filter' => 'role:admin']);
$routes->get('/admin/userlist', 'Admin::userlist', ['filter' => 'role:admin']);
$routes->get('/admin/report', 'Admin::report', ['filter' => 'role:admin,upt_heads']);
$routes->get('/admin/export', 'Admin::export', ['filter' => 'role:admin,upt_heads']);
// $routes->get('/admin/report', 'Admin::report');
// $routes->get('/admin/export', 'Admin::export');
// $routes->get('/admin/pending', 'Admin::pending');


$routes->get('/user/index', 'User::index');


$routes->get('/admin/(:num)', 'Admin::detail/$1', ['filter' => 'role:admin']);




$routes->get('/pengaduan/(:any)', 'Pengaduan::detail/$1');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
