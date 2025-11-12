<?php
require_once __DIR__ . '/../services/BaseService.php';
require_once __DIR__ . '/../services/UserService.php';

$user_service = new UserService();

echo "=== Testing UserService ===\n\n";

// Test getAllUsers()
echo "1. Testing getAllUsers():\n";
$users = $user_service->getAllUsers();
print_r($users);

// Test getByEmail()
echo "\n2. Testing getByEmail():\n";
$user = $user_service->getByEmail('test@example.com');
print_r($user);

// Test addUser()
echo "\n3. Testing addUser():\n";
$new_user = $user_service->addUser([
    'username' => 'newuser',
    'email' => 'newuser@example.com',
    'password' => 'hashed_password_here',
    'first_name' => 'John',
    'last_name' => 'Doe',
    'address' => '123 Main Street',
]);
print_r($new_user);

// Test updateUser()
echo "\n4. Testing updateUser():\n";
$updated_user = $user_service->updateUser(1, [
    'first_name' => 'Jane',
    'last_name' => 'Smith',
    'address' => '456 Updated Street'
]);
print_r($updated_user);

// Test deleteUser()
echo "\n5. Testing deleteUser():\n";
$deleted = $user_service->deleteUser(10);
echo "Delete result: " . ($deleted ? 'Success' : 'Failed') . "\n";
?>