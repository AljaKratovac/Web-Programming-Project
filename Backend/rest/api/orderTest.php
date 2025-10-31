<?php
header('Content-Type: application/json');
require_once '../dao/OrderDao.php';
require_once '../dao/UserDao.php';

$orderDao = new OrderDao();
$userDao = new UserDao();

// 1. Get an existing user ID dynamically
$existingUser = $userDao->getAll()[0] ?? null;
if (!$existingUser) {
    die("No users exist. Please add at least one user.");
}
$userId = $existingUser['user_id'];

// 2. ADD ORDER
$newOrder = [
    'user_id' => $userId,
    'tracking_number' => 10,
    'status' => 'pending'
];
$insertResult = $orderDao->addOrders($newOrder);
echo "<h3>Add Order:</h3>";
echo $insertResult ? "Success" : "Failed";

// 3. GET ALL ORDERS
$allOrders = $orderDao->getAll();
echo "<h3>All Orders:</h3>";
echo "<table border='1' cellpadding='5'>
        <tr><th>Order ID</th><th>User ID</th><th>Total Amount</th><th>Status</th></tr>";
foreach ($allOrders as $order) {
    echo "<tr>
            <td>{$order['order_id']}</td>
            <td>{$order['user_id']}</td>
            <td>{$order['total_amount']}</td>
            <td>{$order['status']}</td>
          </tr>";
}
echo "</table>";

// 4. GET ORDER BY ORDER ID (last inserted)
$lastOrderId = end($allOrders)['order_id'] ?? null;
if ($lastOrderId) {
    $orderById = $orderDao->getByOrderId($lastOrderId);
    echo "<h3>Get Order by ID {$lastOrderId}:</h3>";
    echo "<pre>";
    print_r($orderById);
    echo "</pre>";
}

// 5. DELETE ORDER (last inserted)
if ($lastOrderId) {
    $deleteResult = $orderDao->deleteOrder($lastOrderId);
    echo "<h3>Delete Order ID {$lastOrderId}:</h3>";
    echo $deleteResult ? "Success" : "Failed";
}
?>
