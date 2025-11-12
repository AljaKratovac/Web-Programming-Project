<?php
require 'vendor/autoload.php';

require_once __DIR__ . '/rest/services/UserService.php';
require_once __DIR__ . '/rest/services/ProductService.php';
require_once __DIR__ . '/rest/services/PaymentService.php';
require_once __DIR__ . '/rest/services/OrderService.php';
require_once __DIR__ . '/rest/services/OrderItemsService.php';
require_once __DIR__ . '/rest/services/CartService.php';



Flight::register('userService', 'UserService');
Flight::register('productService', 'ProductService');
Flight::register('paymentService', 'PaymentService');
Flight::register('paymentService', 'OrderService');
Flight::register('paymentService', 'OrderItemsService');
Flight::register('paymentService', 'CartService');


require_once __DIR__ . '/rest/routes/UserRoutes.php';
require_once __DIR__ . '/rest/routes/ProductRoutes.php';
require_once __DIR__ . '/rest/routes/PaymentRoutes.php';
require_once __DIR__ . '/rest/routes/OrderRoutes.php';
require_once __DIR__ . '/rest/routes/OrderItemsRoutes.php';
require_once __DIR__ . '/rest/routes/CartRoutes.php';

Flight::start();