<?php
require_once __DIR__ . '/../services/BaseService.php';
require_once __DIR__ . '/../services/OrderService.php';

$order_service = new OrderService();

echo "=== Testing OrderService ===\n\n";

// Test getAll()
echo "1. Testing getAll():\n";
$orders = $order_service->getAll();
print_r($orders);

// Test getById()
echo "\n2. Testing getById(4):\n";
$order = $order_service->getById(1);
print_r($order);

// Test addOrder()
$currentDate = (new DateTime())->format('Y-m-d H:i:s'); 
echo "\n3. Testing addOrder():\n";
$new_order = $order_service->addOrder([
    'user_id' => 1,
    'order_date' => $currentDate,
    'status' => 'Pending',
    'shipping_address' => '123 Test Street, Test City',
    'tracking_number' => '222' 
]);
print_r($new_order);

// Test updateOrder()
echo "\n4. Testing updateOrder():\n";
echo "</br> OVDJE.   !!!!! ";
$updated_order = $order_service->updateOrder(2, [
    'status' => 'Shipping',
    'tracking_number' => '123456789'
]);
print_r($updated_order);

// Test deleteOrder()
echo "\n5. Testing deleteOrder():\n";
$deleted = $order_service->deleteOrder(2);
echo "Delete result: " . ($deleted ? 'Success' : 'Failed') . "\n";
?>