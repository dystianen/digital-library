<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'AuthController::loginView');
$routes->post('/login', 'AuthController::loginStore');

$routes->get('/register', 'AuthController::registerView');
$routes->post('/register', 'AuthController::registerStore');

// Kalau mau Register Admin, langsung tembak lewat route
$routes->get('/admin/register', 'AuthController::registerView');
$routes->post('/admin/register', 'AuthController::registerStore');

$routes->get('/logout', 'AuthController::logout');
$routes->get('/', 'HomeController::index');

$routes->group('/member', ['filter' => 'authGuard'], function ($routes) {
  // Borrowing
  $routes->post('borrow/(:num)', 'BorrowingController::borrow/$1');
  $routes->get('borrowed', 'BorrowingController::borrowed');
});

$routes->group('/admin', ['filter' => 'authGuard'], function ($routes) {
  // Dashboard
  $routes->get('dashboard', 'DashboardController::index');

  // Books
  $routes->get('books', 'BookController::index');             // List books
  $routes->post('books', 'BookController::create');            // Proses tambah buku
  $routes->post('books/update/(:num)', 'BookController::update/$1'); // Proses update
  $routes->post('books/delete/(:num)', 'BookController::delete/$1'); // Proses hapus

  // Borrowings
  $routes->get('borrowings', 'BorrowingController::index');
});
