<?php
header('Content-Type: application/json');

require_once '../dao/userDao.php';;

$userDao = new UserDao();


try {
    $userDAO = new UserDao();

    // 1. Dohvati sve korisnike
    $allUsers = $userDAO->getAll();

    // 2. Dodaj testnog admina
    $adminData = [
        'username' => 'AdminUser',
        'email' => 'admin@example.com',
        'password' => password_hash('secret', PASSWORD_BCRYPT)
    ];
    $insertResult = $userDAO->addAdmin($adminData);

    // 3. Dohvati korisnika po emailu
    $fetchedUser = $userDAO->getByEmail('admin@example.com');

    // 4. JSON output
    echo json_encode([
        'success' => true,
        'message' => 'UserDao test successful!',
        'allUsers' => $allUsers,
        'insertResult' => $insertResult,
        'fetchedUser' => $fetchedUser
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'UserDao test failed: ' . $e->getMessage()
    ]);
}
?>
