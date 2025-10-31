<?php
header('Content-Type: application/json');

require_once '../dao/CartDao.php';

$cartDao = new CartDao();

// 👇 Use IDs that exist in your DB
$existingUserId = 1;
$existingProductId = 1;

echo "<h3>Add to Cart:</h3>";
$add = $cartDao->add_to_cart($existingUserId, $existingProductId, 3);
var_dump($add);

echo "<h3>Get All Carts for User:</h3>";
print_r($cartDao->getByUserId($existingUserId));

echo "<h3>Get Cart by ID (1):</h3>";
print_r($cartDao->getById(1));

echo "<h3>Update Cart:</h3>";
$update = $cartDao->updateCart(1, ['quantity' => 5]);
var_dump($update);

echo "<h3>Delete Cart:</h3>";
$delete = $cartDao->deleteCart(1);
var_dump($delete);
?>
