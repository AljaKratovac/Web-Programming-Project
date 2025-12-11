<?php
require 'vendor/autoload.php';
require 'rest/services/AuthService.php';
require 'rest/services/UserService.php';
require "middleware/AuthMiddleware.php";


use Firebase\JWT\JWT;
use Firebase\JWT\Key;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/ProductService.php';
require_once __DIR__ . '/rest/services/PaymentService.php';
require_once __DIR__ . '/rest/services/OrderService.php';
require_once __DIR__ . '/rest/services/OrderItemsService.php';
require_once __DIR__ . '/rest/services/CartService.php';



Flight::register('userService', 'UserService');
Flight::register('productService', 'ProductService');
Flight::register('paymentService', 'PaymentService');
Flight::register('orderService', 'OrderService');
Flight::register('orderItemsService', 'OrderItemsService');
Flight::register('cartService', 'CartService');
Flight::register('auth_service', "AuthService");
Flight::register('auth_middleware', "AuthMiddleware");


Flight::route('/*', function() {
   if(
       strpos(Flight::request()->url, '/auth/login') === 0 ||
       strpos(Flight::request()->url, '/auth/register') === 0
   ) {
       return TRUE;
   } else {
       try {
           $token = Flight::request()->getHeader("Authentication");
           if(Flight::auth_middleware()->verifyToken($token))
               return TRUE;
       } catch (\Exception $e) {
           Flight::halt(401, $e->getMessage());
       }
   }
});



require_once __DIR__ . '/rest/routes/UserRoutes.php';
require_once __DIR__ . '/rest/routes/ProductRoutes.php';
require_once __DIR__ . '/rest/routes/PaymentRoutes.php';
require_once __DIR__ . '/rest/routes/OrderRoutes.php';
require_once __DIR__ . '/rest/routes/OrderItemsRoutes.php';
require_once __DIR__ . '/rest/routes/CartRoutes.php';

Flight::start();