<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('/webgl', 'HomeController::webgl');
$routes->get('/faq', 'HomeController::faq');
$routes->post('/contact', 'HomeController::contact');
$routes->post('/cart', 'CartController::index');
$routes->post('/checkout', 'CartController::checkout');
$routes->post('/remove_cart', 'CartController::remove');
$routes->post('/update_cart', 'CartController::update');
$routes->post('/add_image', 'UploadController::add_image');
$routes->post('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/register', 'RegisterController::register');
$routes->get('/confirm/(:hash)', 'RegisterController::confirm/$1');
$routes->post('/forgot', 'ForgotPasswordController::forgot');
$routes->get('/reset/(:hash)', 'ForgotPasswordController::reset/$1');
$routes->post('/reset_confirm', 'ForgotPasswordController::reset_confirm');
$routes->get('/profile', 'ProfileController::profile');
$routes->post('/update','ProfileController::update');
$routes->get('/product', 'ProductController::index');
$routes->get('/product/(:num)','ProductController::product/$1');
$routes->post('/add_cart/(:num)','ProductController::add_cart/$1');
//Routes Api
$routes->group('api', function ($routes) {
    $routes->post('login', 'Api\LoginController::index');
    $routes->get('profile','Api\ProfileController::index',['filter'=>'api-auth']);
    $routes->resource('product', ['controller' => 'Api\ProductController', 'except' => 'new,edit,remove']);
    $routes->resource('user', ['controller' => 'Api\UserController', 'except' => 'new,edit,remove']);
    $routes->resource('group', ['controller' => 'Api\GroupController', 'except' => 'new,edit,remove']);
    $routes->resource('subscription', ['controller' => 'Api\SubscriptionController', 'except' => 'new,edit,remove']);
    $routes->resource('company', ['controller' => 'Api\CompanyController', 'except' => 'new,edit,remove']);
    $routes->resource('partner', ['controller' => 'Api\PartnerController', 'except' => 'new,edit,remove']);
    $routes->resource('warehouse', ['controller' => 'Api\WarehouseController', 'except' => 'new,edit,remove']);
    $routes->resource('stock', ['controller' => 'Api\StockController', 'except' => 'new,edit,remove']);
    $routes->resource('type_product', ['controller' => 'Api\ProductTypeController', 'except' => 'new,edit,remove']);
    $routes->resource('order', ['controller' => 'Api\OrderController', 'except' => 'new,edit,remove']);
    $routes->resource('order_product', ['controller' => 'Api\OrderProductController', 'except' => 'new,edit,remove']);
});
//Routes Admin
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\HomeController::index');
    $routes->presenter('product', ['controller' => 'Admin\ProductController', 'except' => 'new,edit,remove']);
    $routes->presenter('user', ['controller' => 'Admin\UserController', 'except' => 'new,edit,remove']);
    $routes->presenter('company', ['controller' => 'Admin\CompagnyController', 'except' => 'new,edit,remove']);
    $routes->presenter('group', ['controller' => 'Admin\GroupController', 'except' => 'new,edit,remove']);
    $routes->presenter('order', ['controller' => 'Admin\OrderController', 'except' => 'new,edit,remove']);
    $routes->presenter('order_product', ['controller' => 'Admin\OrderProductController', 'except' => 'new,edit,remove']);
    $routes->presenter('partner', ['controller' => 'Admin\PartnerController', 'except' => 'new,edit,remove']);
    $routes->presenter('type_product', ['controller' => 'Admin\ProductTypeController', 'except' => 'new,edit,remove']);
    $routes->presenter('stock', ['controller' => 'Admin\StockController', 'except' => 'new,edit,remove']);
    $routes->presenter('subscription', ['controller' => 'Admin\SubscriptionController', 'except' => 'new,edit,remove']);
    $routes->presenter('warehouse', ['controller' => 'Admin\WarehouseController', 'except' => 'new,edit,remove']);
});




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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
