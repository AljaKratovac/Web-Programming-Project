<?php
header('Content-Type: application/json');

require_once '../dao/userDao.php';

try {
    $userDAO = new UserDao();
    $data = $userDAO->getAll();

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
$userDao->addAdmin([
  'username' => 'AdminUser',
  'email' => 'admin@example.com',
  'password' => password_hash('secret', PASSWORD_BCRYPT)
]);
?>
