<?php
require_once __DIR__ . '/../services/BaseService.php';
require_once __DIR__ . '/../services/CartService.php';
$cart_service = new CartService();

// Test getAll()
echo "1. Testing getAll():\n";
$carts = $cart_service->getAll();
print_r($carts);

// Test getById()
echo "\n2. Testing getById(1):\n";
$cart = $cart_service->getById(1);
print_r($cart);

// Test addToCart()
echo "\n3. Testing addToCart():\n";
$new_cart_item = $cart_service->addToCart([
    'user_id' => 1,
    'product_id' => 1,
    'quantity' => 2,
    'added_at' => date('Y-m-d H:i:s')
]);
print_r($new_cart_item);

// Test updateCart()
echo "\n4. Testing updateCart():\n";
$updated_cart = $cart_service->updateCart(1, [
    'quantity' => 3
]);
print_r($updated_cart);

// Test deleteCart()
echo "\n5. Testing deleteCart():\n";
$deleted = $cart_service->deleteCart(1);
echo "Delete result: " . ($deleted ? 'Success' : 'Failed') . "\n";
?>