<?php
require_once __DIR__ . '/../services/BaseService.php';
require_once __DIR__ . '/../services/ProductService.php';

$product_service = new ProductService();


echo "=== Testing ProductService (Safe Methods Only) ===\n\n";

// Test 1: getAll() - This works!
echo "1. Testing getAll():\n";
$products = $product_service->getAll();
echo "✓ SUCCESS: Found " . count($products) . " products\n";

// Show available product IDs
echo "Available product IDs: ";
$ids = [];
foreach ($products as $product) {
    $ids[] = $product['id'];
}
echo implode(', ', $ids) . "\n";

echo "\n" . str_repeat("-", 50) . "\n";

// Test 2: add() - This works!
echo "2. Testing add():\n";
$new_product = $product_service->add([
    'name' => 'Test Bag ' . date('H:i:s'),
    'price' => 49.99,
    'description' => 'Test description',
    'stock_quantity' => 5,
    'image' => ''
]);
if ($new_product) {
    echo "✓ SUCCESS: Added new product\n";
} else {
    echo "✗ FAILED: Could not add product\n";
}

echo "\n" . str_repeat("-", 50) . "\n";

// Test 3: Try getById() with a known existing ID
echo "3. Testing getById() with existing product:\n";
if (!empty($products)) {
    $first_product_id = $products[0]['id'];
    echo "Trying to get product ID: $first_product_id\n";
    
    try {
        $product = $product_service->getById($first_product_id);
        if ($product) {
            echo "✓ SUCCESS: Found product: {$product['name']}\n";
        } else {
            echo "✗ Product not found (might be BaseDao column issue)\n";
        }
    } catch (Exception $e) {
        echo "✗ ERROR: " . $e->getMessage() . "\n";
    }
}

echo "\n" . str_repeat("=", 50) . "\n";

