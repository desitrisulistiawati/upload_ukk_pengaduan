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
$routes->get('/', 'Home::index');

$routes->get('/login','LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->get('/register','LoginController::register');
$routes->add('saveregister','LoginController::saveregister');
$routes->add('login','LoginController::login');

$routes->get('/petugas', 'PetugasController::index');
$routes->get('/fpetugas', 'PetugasController::create');
$routes->post('/spetugas', 'PetugasController::simpan');
$routes->post('/petugas/edit/(:segment)', 'PetugasController::edit/$1');
$routes->get('/petugas/delete/(:segment)', 'PetugasController::delete/$1');

$routes->get('/masyarakat', 'MasyarakatController::index');
$routes->get('/fmasyarakat', 'MasyarakatController::create');
$routes->post('/smasyarakat', 'MasyarakatController::simpan');
$routes->post('/masyarakat/edit/(:segment)', 'MasyarakatController::edit/$1');
$routes->get('/masyarakat/delete/(:segment)', 'MasyarakatController::delete/$1');

$routes->get('/pengaduan','PengaduanController::index');
$routes->post('/tambahpengaduan','PengaduanController::simpan');
$routes->get('/pengaduan/hapus/(:segment)','PengaduanController::delete/$1');

$routes->get('/profil','LoginController::lihatProfil');
$routes->post('/editprofil','LoginController::editProfil');

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
