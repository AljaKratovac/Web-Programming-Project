<?php
// Web-Programming-Project/Backend/api/test.php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

echo json_encode([
    'success' => true,
    'message' => 'API is working!',
    'server_time' => date('Y-m-d H:i:s')
]);
?>