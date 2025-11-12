<?php
require_once __DIR__ . '/../services/BaseService.php';
require_once __DIR__ . '/../services/PaymentService.php';

$payment_service = new PaymentService();

echo "=== Testing PaymentService ===\n\n";

// Test getAll()
echo "1. Testing getAll():\n";
$payments = $payment_service->getAll();
print_r($payments);

// Test getById()
echo "\n2. Testing getById(1):\n";
$payment = $payment_service->getById(1);
print_r($payment);

// Test addPayment()
echo "\n3. Testing addPayment():\n";
$new_payment = $payment_service->addPayment([
    'user_id' => 1,
    'amount' => 99.99,
    'payment_method' => 'credit_card',
]);
print_r($new_payment);

// Test updatePayment()
echo "\n4. Testing updatePayment():\n";
$updated_payment = $payment_service->updatePayment(1, [
    'amount' => 79.99
]);
print_r($updated_payment);

// Test deletePayment()
echo "\n5. Testing deletePayment():\n";
$deleted = $payment_service->deletePayment(1);
echo "Delete result: " . ($deleted ? 'Success' : 'Failed') . "\n";
?>