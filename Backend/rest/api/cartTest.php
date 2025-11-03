<?php
header('Content-Type: application/json');

require_once '../dao/CartDao.php';

try {
    $cartDAO = new CartDao();
    $data = $cartDAO->getAll();

    echo json_encode([
        'success' => true,
        'message' => 'DAO connection successful!',
        'data' => $data
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'DAO test failed: ' . $e->getMessage()
    ]);
}
?>