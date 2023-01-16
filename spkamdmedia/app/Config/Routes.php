<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Root');
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
$routes->add('/', 'Root::index');
$routes->add('/getlogin', 'Root::proseslogin');
$routes->add('/getlogout', 'Root::proseslogout');
//===============================================================================
$routes->add('/admin', 'Admin::index');
$routes->add('/profile', 'Admin::tampilprofil');
$routes->add('/ubahprofile', 'Admin::ubahprofil');

$routes->add('/karyawan', 'Karyawan::index');
$routes->add('/karyawan/simpan', 'Karyawan::simpandata');
$routes->add('/karyawan/ubah', 'Karyawan::ubahdata');

$routes->add('/kriteria', 'Kriteria::index');
$routes->add('/kriteria/simpan', 'Kriteria::simpandata');
$routes->add('/kriteria/ubah', 'Kriteria::ubahdata');

$routes->add('/indikator', 'Indikator::index');
$routes->add('/indikator/simpan', 'Indikator::simpandata');
$routes->add('/indikator/ubah', 'Indikator::ubahdata');

$routes->add('/nilai', 'Nilai::index');
$routes->add('/nilai/tampil', 'Nilai::tampildata');
$routes->add('/nilai/simpan/(:any)', 'Nilai::simpandata/$1');

$routes->add('/analisa', 'Analisa::index');
$routes->add('/analisa/tampil', 'Analisa::tampildata');
$routes->add('/analisa/process/(:any)', 'Analisa::prosesdata/$1');
$routes->add('/analisa/print/(:any)', 'Analisa::cetakdata/$1');


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
