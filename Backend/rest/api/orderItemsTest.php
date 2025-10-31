<?php
header('Content-Type: application/json');

require_once '../dao/OrderItemsDao.php';

$orderItemsDao = new OrderItemsDao();

// 1. ADD ORDER ITEM
$newOrderItem = [
    'order_id' => 1,       // make sure this order exists
    'product_id' => 1,     // make sure this product exists
    'quantityOrderd' => 2,
    'unit_price' => 49.99
];

$insertResult = $orderItemsDao->addOrderItem($newOrderItem);
echo "<h3>Add Order Item:</h3>";
var_dump($insertResult);

// 2. GET ALL ORDER ITEMS
$allItems = $orderItemsDao->getAllOrderItems();
echo "<h3>All Order Items:</h3>";
echo "<pre>";
print_r($allItems);
echo "</pre>";

// 3. GET ORDER ITEMS BY ORDER ID
$orderItems = $orderItemsDao->getByOrderId(1);
echo "<h3>Get Order Items by Order ID:</h3>";
echo "<pre>";
print_r($orderItems);
echo "</pre>";

// 4. UPDATE ORDER ITEM (update last inserted)
$lastItemId = end($allItems)['id'] ?? null;
if ($lastItemId) {
    $updateResult = $orderItemsDao->updateOrderItem($lastItemId, [
        'quantity' => 5,
        'price' => 44.99
    ]);
    echo "<h3>Update Order Item:</h3>";
    var_dump($updateResult);
}

// 5. DELETE ORDER ITEM (delete last inserted)
if ($lastItemId) {
    $deleteResult = $orderItemsDao->deleteOrderItem($lastItemId);
    echo "<h3>Delete Order Item:</h3>";
    var_dump($deleteResult);
}
?>
