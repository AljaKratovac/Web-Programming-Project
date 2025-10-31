<?php
header('Content-Type: application/json');
require_once '../dao/PaymentDao.php';

$paymentDao = new PaymentDao();

// 1. ADD PAYMENT
$newPayment = [
    'user_id' => 1,             // make sure this user exists
    'amount' => 99.99,
    'payment_method' => 'credit_card',
];

$insertResult = $paymentDao->addPayment($newPayment);
echo "<h3>Add Payment:</h3>";
var_dump($insertResult);

// 2. GET ALL PAYMENTS
$allPayments = $paymentDao->getAllPayments();
echo "<h3>All Payments:</h3>";
echo "<pre>";
print_r($allPayments);
echo "</pre>";

// 3. GET PAYMENT BY USER ID
$userPayments = $paymentDao->getByUserId(1);
echo "<h3>Get Payments by User ID:</h3>";
echo "<pre>";
print_r($userPayments);
echo "</pre>";

// 4. UPDATE PAYMENT (update the last inserted payment)
$lastPaymentId = end($allPayments)['payment_id'] ?? null;
if ($lastPaymentId) {
    $updateResult = $paymentDao->updatePayment($lastPaymentId, [
        'status' => 'completed'
    ]);
    echo "<h3>Update Payment:</h3>";
    var_dump($updateResult);
}

// 5. DELETE PAYMENT (delete the last inserted payment)
if ($lastPaymentId) {
    $deleteResult = $paymentDao->deletePayment($lastPaymentId);
    echo "<h3>Delete Payment:</h3>";
    var_dump($deleteResult);
}
?>
