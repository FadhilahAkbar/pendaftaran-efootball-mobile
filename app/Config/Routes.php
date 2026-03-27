<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// admin
$routes->get('/admin', 'Admin::index', ['filter' => 'admincheck']);
$routes->post('/admin/store', 'Admin::store', ['filter' => 'admincheck']);
$routes->post('/admin/turnamen/update-status/(:num)', 'Admin::updateTournamentStatus/$1', ['filter' => 'admincheck']);
$routes->get('/admin/turnamen/(:num)/tim', 'Admin::teams/$1', ['filter' => 'admincheck']);
$routes->get('/admin/tim/status/(:num)/(:segment)', 'Admin::updateStatus/$1/$2', ['filter' => 'admincheck']);
// Rute Edit & Hapus Turnamen (Admin)
$routes->get('/admin/edit/(:num)', 'Admin::edit/$1', ['filter' => 'admincheck']);
$routes->post('/admin/update/(:num)', 'Admin::update/$1', ['filter' => 'admincheck']);
$routes->get('/admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'admincheck']);

// Rute untuk Registrasi & Login
$routes->get('/register', 'Auth::register');
$routes->post('/register/process', 'Auth::processRegister');

$routes->get('/login', 'Auth::login');
$routes->post('/login/process', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');


// Rute Pendaftaran Turnamen oleh Pemain
$routes->get('/turnamen/daftar/(:num)', 'Turnamen::daftar/$1');
$routes->post('/turnamen/simpan', 'Turnamen::simpan');
$routes->get('/turnamen/bagan/(:num)', 'Turnamen::bagan/$1');
$routes->get('/tim-saya', 'Turnamen::timSaya');
$routes->get('/tim-saya/batal/(:num)', 'Turnamen::batalDaftar/$1');

