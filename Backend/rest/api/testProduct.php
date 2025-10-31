<?php
header('Content-Type: application/json');
require_once '../dao/ProductDao.php';

$productDao = new ProductDAO();

// 1. INSERT PRODUCT
$newProduct = [
    'product_id' => 2,
    'name' => 'Black Bag',
    'price' => 49.99,    
];
$insertResult = $productDao->insertProduct($newProduct);
echo "<h3>Insert Product:</h3>";
var_dump($insertResult);

// 2. GET ALL PRODUCTS
$allProducts = $productDao->getAllProducts();
echo "<h3>All Products:</h3>";
echo "<pre>";
print_r($allProducts);
echo "</pre>";

// 3. GET PRODUCT BY ID (use last inserted product)
$lastId = end($allProducts)['product_id'];
$product = $productDao->getByProductId($lastId);
echo "<h3>Get Product by ID:</h3>";
echo "<pre>";
print_r($product);
echo "</pre>";

// 4. UPDATE PRODUCT
$updateResult = $productDao->updateProduct($lastId, [
    'price' => 59.99,
    'stock_quantity' => 80
]);
echo "<h3>Update Product:</h3>";
var_dump($updateResult);

// 5. DELETE PRODUCT
$deleteResult = $productDao->deleteProduct($lastId);
echo "<h3>Delete Product:</h3>";
var_dump($deleteResult);
?>
