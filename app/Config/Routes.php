<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'HomeProductController::index');

$routes->get('/', 'HomeProductController::index');
$routes->post('/get_product', 'HomeProductController::getProduct');

$routes->get('/checkout', 'CheckoutController::index');
$routes->post('/checkout/data', 'CheckoutController::getData');
$routes->post('/checkout/save_payment', 'CheckoutController::savePayment');
