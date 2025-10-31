<?php
header('Content-Type: application/json');

require_once '../dao/userDao.php';;

$userDao = new UserDao();

// TEST CREATE USER
$newUser = $userDao->createUser('Test User', 'test@example.com', 'password123');
echo "<h3>Create User:</h3>";
var_dump($newUser);

// TEST GET BY EMAIL
$user = $userDao->getByEmail('test@example.com');
echo "<h3>Get User by Email:</h3>";
echo "<pre>";
print_r($user);
echo "</pre>";

// TEST ADD ADMIN
$newAdmin = $userDao->addAdmin([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => password_hash('adminpass', PASSWORD_DEFAULT)
]);
echo "<h3>Add Admin:</h3>";
var_dump($newAdmin);

// TEST DELETE USER
if (!empty($user)) {
    $deleteResult = $userDao->deleteUser($user[0]['user_id']);
    echo "<h3>Delete User:</h3>";
    var_dump($deleteResult);
}

?>
