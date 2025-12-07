<?php
// Enable errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require_once __DIR__ . '/rest/config.php';
require_once __DIR__ . '/rest/db.php';

// Services
require_once __DIR__ . '/rest/services/AuthService.php'; 
require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/ProductService.php';
require_once __DIR__ . '/rest/services/PaymentService.php';
require_once __DIR__ . '/rest/services/OrderService.php';
require_once __DIR__ . '/rest/services/OrderItemsService.php';
require_once __DIR__ . '/rest/services/CartService.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Register services
Flight::register('userService', 'UserService');
Flight::register('productService', 'ProductService');
Flight::register('paymentService', 'PaymentService');
Flight::register('orderService', 'OrderService');
Flight::register('orderItemsService', 'OrderItemsService');
Flight::register('cartService', 'CartService');
Flight::register('auth_service', 'AuthService');

// Middleware
Flight::route('/*', function() {
    $url = Flight::request()->url;
    
    // Public routes
    if(
        strpos($url, '/auth/login') === 0 ||
        strpos($url, '/auth/register') === 0 
    ) {
        return true;
    }
    
    // Protected routes
  try {
    $headers = getallheaders();
    $auth_header = isset($headers['Authorization']) ? $headers['Authorization'] : null;
    
    if(!$auth_header) {
        Flight::halt(401, "Missing authentication header");
    }
    
    // Extract token from "Bearer <token>"
    $token = null;
    if (preg_match('/Bearer\s+(.*)$/i', $auth_header, $matches)) {
        $token = $matches[1];
    }
    
    if(!$token) {
        Flight::halt(401, "Invalid authorization format. Use: Bearer <token>");
    }
    
    $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
    Flight::set('user', $decoded_token->user);
    Flight::set('jwt_token', $token);
    
    return true;
} catch (\Exception $e) {
    Flight::halt(401, $e->getMessage());
}
});

// Routes
require_once __DIR__ . '/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/UserRoutes.php';
require_once __DIR__ . '/rest/routes/ProductRoutes.php';
require_once __DIR__ . '/rest/routes/PaymentRoutes.php';
require_once __DIR__ . '/rest/routes/OrderRoutes.php';
require_once __DIR__ . '/rest/routes/OrderItemsRoutes.php';
require_once __DIR__ . '/rest/routes/CartRoutes.php';

Flight::start();