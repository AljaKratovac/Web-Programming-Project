<?php
require_once __DIR__ . '/../services/BaseService.php';
require_once __DIR__ . '/../services/OrderItemsService.php';

$order_items_service = new OrderItemsService();

echo "=== Testing OrderItemsDao ===\n\n";

// Test getAllOrderItems() 
echo "1. Testing getAll():\n";
$all_items = $order_items_service->getAll(); 
print_r($all_items);

// Test getById()
echo "\n2. Testing getById(1):\n";
$order_items = $order_items_service->getById(1);
print_r($order_items);

// Test addOrderItem()
echo "\n3. Testing addOrderItem():\n";
$new_item = $order_items_service->addOrderItem([
    'order_id' => 1,
    'product_id' => 1,
    'quantityOrderd' => 2,
    'unit_price' => 25.00,
    'total_price' => 50.00
]);
print_r($new_item);

// Test updateOrderItem()
echo "\n4. Testing updateOrderItem():\n";
$updated_item = $order_items_service->updateOrderItem(1, [
    'quantityOrderd' => 3,
    'total_price' => 75.00
]);
print_r($updated_item);

// Test deleteOrderItem()
echo "\n5. Testing deleteOrderItem():\n";
$deleted = $order_items_service->deleteOrderItem(1);
echo "Delete result: " . ($deleted ? 'Success' : 'Failed') . "\n";
?>