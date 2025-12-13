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
	// tabel 2b6
	$routes->get('table2b6', 'Table2b6::index');
	$routes->get('table2b6/(:segment)/preview', 'Table2b6::preview/$1');
	$routes->add('table2b6/new', 'Table2b6::create');
	$routes->add('table2b6/(:segment)/edit', 'Table2b6::edit/$1');
	$routes->get('table2b6/(:segment)/delete', 'Table2b6::delete/$1');
	$routes->get('table2b6/cari', 'Table2b6::cari');

	$routes->get('table2b6/export', 'Table2b6::exportExcel');

	// tabel 3b71
	$routes->get('table3b71', 'Table3b71::index');
	$routes->get('table3b71/(:segment)/preview', 'Table3b71::preview/$1');
	$routes->add('table3b71/new', 'Table3b71::create');
	$routes->add('table3b71/(:segment)/edit', 'Table3b71::edit/$1');
	$routes->get('table3b71/(:segment)/delete', 'Table3b71::delete/$1');
	$routes->get('table3b71/cari', 'Table3b71::cari');

	// tabel 3b72
	$routes->get('table3b72', 'Table3b72::index');
	$routes->get('table3b72/(:segment)/preview', 'Table3b72::preview/$1');
	$routes->add('table3b72/new', 'Table3b72::create');
	$routes->add('table3b72/(:segment)/edit', 'Table3b72::edit/$1');
	$routes->get('table3b72/(:segment)/delete', 'Table3b72::delete/$1');
	$routes->get('table3b72/cari', 'Table3b72::cari');

	// tabel 3b73
	$routes->get('table3b73', 'table3b73::index');
	$routes->get('table3b73/(:segment)/preview', 'table3b73::preview/$1');
	$routes->add('table3b73/new', 'table3b73::create');
	$routes->add('table3b73/(:segment)/edit', 'table3b73::edit/$1');
	$routes->get('table3b73/(:segment)/delete', 'table3b73::delete/$1');
	$routes->get('table3b73/cari', 'table3b73::cari');

	// tabel 3b74
	$routes->get('table3b74', 'table3b74::index');
	$routes->get('table3b74/(:segment)/preview', 'table3b74::preview/$1');
	$routes->add('table3b74/new', 'table3b74::create');
	$routes->add('table3b74/(:segment)/edit', 'table3b74::edit/$1');
	$routes->get('table3b74/(:segment)/delete', 'table3b74::delete/$1');
	$routes->get('table3b74/cari', 'table3b74::cari');

	// tabel 4

	// tabel 5a
	$routes->get('table5a', 'table5a::index');
	$routes->get('table5a/(:segment)/preview', 'table5a::preview/$1');
	$routes->add('table5a/new', 'table5a::create');
	$routes->add('table5a/(:segment)/edit', 'table5a::edit/$1');
	$routes->get('table5a/(:segment)/delete', 'table5a::delete/$1');
	$routes->get('table5a/cari', 'table5a::cari');

	// tabel 5b
	$routes->get('table5b', 'table5b::index');
	$routes->get('table5b/(:segment)/preview', 'table5b::preview/$1');
	$routes->add('table5b/new', 'table5b::create');
	$routes->add('table5b/(:segment)/edit', 'table5b::edit/$1');
	$routes->get('table5b/(:segment)/delete', 'table5b::delete/$1');
	$routes->get('table5b/cari', 'table5b::cari');

	// tabel 5c
	$routes->get('table5c', 'table5c::index');
	$routes->get('table5c/(:segment)/preview', 'table5c::preview/$1');
	$routes->add('table5c/new', 'table5c::create');
	$routes->add('table5c/(:segment)/edit', 'table5b::edit/$1');
	$routes->get('table5c/(:segment)/delete', 'table5b::delete/$1');
	$routes->get('table5c/cari', 'table5c::cari');

	// Routes untuk Table 2c
	$routes->get('table2c/export', 'Table2c::exportExcel');

	$routes->get('table2c', 'Table2c::index');
	$routes->get('table2c/(:segment)/preview', 'Table2c::preview/$1'); // Pastikan method 'preview' dibuat di controller jika ingin digunakan
	$routes->add('table2c/new', 'Table2c::create');
	$routes->add('table2c/(:segment)/edit', 'Table2c::edit/$1');
	$routes->get('table2c/(:segment)/delete', 'Table2c::delete/$1');
	$routes->get('table2c/cari', 'Table2c::cari');
	

	// Routes untuk Table 2d
	$routes->get('table2d/export', 'Table2d::exportExcel');

	$routes->get('table2d', 'Table2d::index');
	$routes->get('table2d/(:segment)/preview', 'Table2d::preview/$1');
	$routes->add('table2d/new', 'Table2d::create');
	$routes->add('table2d/(:segment)/edit', 'Table2d::edit/$1');
	$routes->get('table2d/(:segment)/delete', 'Table2d::delete/$1');
	$routes->get('table2d/cari', 'Table2d::cari');

	// Routes untuk Table 3a1
	$routes->get('table3a1/export', 'Table3a1::exportExcel');

	$routes->get('table3a1', 'Table3a1::index');
	$routes->get('table3a1/(:segment)/preview', 'Table3a1::preview/$1');
	$routes->add('table3a1/new', 'Table3a1::create');
	$routes->add('table3a1/(:segment)/edit', 'Table3a1::edit/$1');
	$routes->get('table3a1/(:segment)/delete', 'Table3a1::delete/$1');
	$routes->get('table3a1/cari', 'Table3a1::cari');
});
