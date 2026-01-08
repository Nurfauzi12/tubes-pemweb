<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Dashboard::index');
/** routes dashboard */


// routes login dan register(sign up)
$routes->get('/register', 'Register::index');
$routes->post('/register/process', 'Register::process');
$routes->get('/login/index', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->get('/logout', 'Login::logout');



// grup routes table
$routes->group('table', function ($routes) {
	// ============================================================
	// MAIN TABLES
	// ============================================================

	// Rencana Pembelajaran
	$routes->get('rencana-pembelajaran', 'RencanaPembelajaran::index');
	$routes->add('rencana-pembelajaran/new', 'RencanaPembelajaran::create');
	$routes->add('rencana-pembelajaran/(:segment)/edit', 'RencanaPembelajaran::edit/$1');
	$routes->get('rencana-pembelajaran/(:segment)/delete', 'RencanaPembelajaran::delete/$1');
	$routes->get('rencana-pembelajaran/cari', 'RencanaPembelajaran::cari');

	// Nilai Kompetensi
	$routes->get('nilai-kompetensi', 'NilaiKompetensi::index');
	$routes->add('nilai-kompetensi/new', 'NilaiKompetensi::create');
	$routes->add('nilai-kompetensi/(:segment)/edit', 'NilaiKompetensi::edit/$1');
	$routes->get('nilai-kompetensi/(:segment)/delete', 'NilaiKompetensi::delete/$1');
	$routes->get('nilai-kompetensi/cari', 'NilaiKompetensi::cari');

	// Matakuliah Syarat
	$routes->get('matakuliah-syarat', 'MatakuliahSyarat::index');
	$routes->add('matakuliah-syarat/new', 'MatakuliahSyarat::create');
	$routes->add('matakuliah-syarat/(:segment)/edit', 'MatakuliahSyarat::edit/$1');
	$routes->get('matakuliah-syarat/(:segment)/delete', 'MatakuliahSyarat::delete/$1');
	$routes->get('matakuliah-syarat/cari', 'MatakuliahSyarat::cari');

	// Sub CPMK
	$routes->get('subcpmk', 'SubCpmk::index');
	$routes->add('subcpmk/create', 'SubCpmk::create');
	$routes->post('subcpmk/store', 'SubCpmk::store');
	$routes->get('subcpmk/cari', 'SubCpmk::cari');
	$routes->get('subcpmk/edit/(:segment)', 'SubCpmk::edit/$1');
	$routes->post('subcpmk/update', 'SubCpmk::update');
	$routes->get('subcpmk/delete/(:segment)', 'SubCpmk::delete/$1');
	
	// CPMK (alias ke Master CPMK)
    $routes->get('cpmk', 'CpmkController::index');
    $routes->get('cpmk/cari', 'CpmkController::cari');
	$routes->get('cpmk/new', 'CpmkController::create');
    $routes->post('cpmk/new', 'CpmkController::create');
    $routes->get('cpmk/(:num)/edit', 'CpmkController::edit/$1');
    $routes->post('cpmk/(:num)/edit', 'CpmkController::edit/$1');
    $routes->get('cpmk/(:num)/delete', 'CpmkController::delete/$1');


	// Korelasi CPL-CPMK
	$routes->get('korelasi-cpl-cpmk', 'KorelasiCplCpmk::index');
	$routes->add('korelasi-cpl-cpmk/new', 'KorelasiCplCpmk::create');
	$routes->add('korelasi-cpl-cpmk/(:segment)/edit', 'KorelasiCplCpmk::edit/$1');
	$routes->get('korelasi-cpl-cpmk/(:segment)/delete', 'KorelasiCplCpmk::delete/$1');
	$routes->get('korelasi-cpl-cpmk/cari', 'KorelasiCplCpmk::cari');

	// ============================================================
	// LEGACY TABLES (3B & 5 Series)
	// ============================================================

	// Tabel 3b71
	$routes->get('table3b71', 'Table3b71::index');
	$routes->get('table3b71/(:segment)/preview', 'Table3b71::preview/$1');
	$routes->add('table3b71/new', 'Table3b71::create');
	$routes->add('table3b71/(:segment)/edit', 'Table3b71::edit/$1');
	$routes->get('table3b71/(:segment)/delete', 'Table3b71::delete/$1');
	$routes->get('table3b71/cari', 'Table3b71::cari');

	// Tabel 3b72
	$routes->get('table3b72', 'Table3b72::index');
	$routes->get('table3b72/(:segment)/preview', 'Table3b72::preview/$1');
	$routes->add('table3b72/new', 'Table3b72::create');
	$routes->add('table3b72/(:segment)/edit', 'Table3b72::edit/$1');
	$routes->get('table3b72/(:segment)/delete', 'Table3b72::delete/$1');
	$routes->get('table3b72/cari', 'Table3b72::cari');

	// Tabel 3b73
	$routes->get('table3b73', 'table3b73::index');
	$routes->get('table3b73/(:segment)/preview', 'table3b73::preview/$1');
	$routes->add('table3b73/new', 'table3b73::create');
	$routes->add('table3b73/(:segment)/edit', 'table3b73::edit/$1');
	$routes->get('table3b73/(:segment)/delete', 'table3b73::delete/$1');
	$routes->get('table3b73/cari', 'table3b73::cari');

	// Tabel 3b74
	$routes->get('table3b74', 'table3b74::index');
	$routes->get('table3b74/(:segment)/preview', 'table3b74::preview/$1');
	$routes->add('table3b74/new', 'table3b74::create');
	$routes->add('table3b74/(:segment)/edit', 'table3b74::edit/$1');
	$routes->get('table3b74/(:segment)/delete', 'table3b74::delete/$1');
	$routes->get('table3b74/cari', 'table3b74::cari');

	// Tabel 4
	// TODO: Add routes for table 4

	// Tabel 5a
	$routes->get('table5a', 'table5a::index');
	$routes->get('table5a/(:segment)/preview', 'table5a::preview/$1');
	$routes->add('table5a/new', 'table5a::create');
	$routes->add('table5a/(:segment)/edit', 'table5a::edit/$1');
	$routes->get('table5a/(:segment)/delete', 'table5a::delete/$1');
	$routes->get('table5a/cari', 'table5a::cari');

	// Tabel 5b
	$routes->get('table5b', 'table5b::index');
	$routes->get('table5b/(:segment)/preview', 'table5b::preview/$1');
	$routes->add('table5b/new', 'table5b::create');
	$routes->add('table5b/(:segment)/edit', 'table5b::edit/$1');
	$routes->get('table5b/(:segment)/delete', 'table5b::delete/$1');
	$routes->get('table5b/cari', 'table5b::cari');

	// Tabel 5c
	$routes->get('table5c', 'table5c::index');
	$routes->get('table5c/(:segment)/preview', 'table5c::preview/$1');
	$routes->add('table5c/new', 'table5c::create');
	$routes->add('table5c/(:segment)/edit', 'table5c::edit/$1');
	$routes->get('table5c/(:segment)/delete', 'table5c::delete/$1');
	$routes->get('table5c/cari', 'table5c::cari');
});

// grup routes master data
$routes->group('master', function ($routes) {
	// Master Data Penyusun
	$routes->get('penyusun', 'Penyusun::index');
	$routes->add('penyusun/new', 'Penyusun::create');
	$routes->add('penyusun/(:segment)/edit', 'Penyusun::edit/$1');
	$routes->get('penyusun/(:segment)/delete', 'Penyusun::delete/$1');
	$routes->get('penyusun/cari', 'Penyusun::cari');

	// Master Data Matakuliah
	$routes->get('matakuliah', 'MataKuliah::index');
	$routes->add('matakuliah/new', 'MataKuliah::create');
	$routes->add('matakuliah/(:segment)/edit', 'MataKuliah::edit/$1');
	$routes->get('matakuliah/(:segment)/delete', 'MataKuliah::delete/$1');
	$routes->get('matakuliah/cari', 'MataKuliah::cari');

	// Master Data CPMK
    $routes->get('cpmk', 'CpmkController::index');
    $routes->get('cpmk/cari', 'CpmkController::cari');
	$routes->get('cpmk/new', 'CpmkController::create');
    $routes->post('cpmk/new', 'CpmkController::create');
    $routes->get('cpmk/(:num)/edit', 'CpmkController::edit/$1');
    $routes->post('cpmk/(:num)/edit', 'CpmkController::edit/$1');
    $routes->get('cpmk/(:num)/delete', 'CpmkController::delete/$1');

	// Master Data Sub-CPMK
	$routes->get('sub-cpmk', 'SubCpmk::index');
	$routes->add('sub-cpmk/new', 'SubCpmk::create');
	$routes->add('sub-cpmk/(:segment)/edit', 'SubCpmk::edit/$1');
	$routes->get('sub-cpmk/(:segment)/delete', 'SubCpmk::delete/$1');
	$routes->get('sub-cpmk/cari', 'SubCpmk::cari');

	// Master Data CPL
$routes->get('cpl', 'CplController::index');

// CREATE
$routes->get('cpl/create', 'CplController::create');
$routes->post('cpl/store', 'CplController::store');

// EDIT
$routes->get('cpl/edit/(:num)', 'CplController::edit/$1');
$routes->post('cpl/update/(:num)', 'CplController::update/$1');

// DELETE
$routes->get('cpl/delete/(:num)', 'CplController::delete/$1');

// SEARCH (opsional)
$routes->get('cpl/cari', 'CplController::cari');


});
