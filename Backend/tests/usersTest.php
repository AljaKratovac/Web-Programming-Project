<?php
use PHPUnit\Framework\TestCase;
class userTest extends TestCase {
 public function setUp(): void{
 require_once __DIR__ . '/../vendor/autoload.php';
 require_once __DIR__ . '/../index.php';
 Flight::halt(false); // this is used to prevent auto-exit during test
 Flight::start(); // here we need to start the app
 }

 public function testGetAllUsers(){
 $_SERVER['REQUEST_METHOD'] = 'GET';
 $_SERVER['REQUEST_URI'] = '/users';
 ob_start();
 Flight::start(); 
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code()); 
 $this->assertJson($output); 
 }

 public function testGetUsersById() {
 $_SERVER['REQUEST_METHOD'] = 'GET';
 $_SERVER['REQUEST_URI'] = '/users/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output); 
 $this->assertStringContainsString('"id":1', $output);
 }
 public function testCreateUser() {
 $_SERVER['REQUEST_METHOD'] = 'POST';
 $_SERVER['REQUEST_URI'] = '/users';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(201, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id"', $output);
}

public function testUpdateUser() {
 $_SERVER['REQUEST_METHOD'] = 'PUT';
 $_SERVER['REQUEST_URI'] = '/users/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id":1', $output);
}

public function testPartiallyUpdateUser() {
 $_SERVER['REQUEST_METHOD'] = 'PATCH';
 $_SERVER['REQUEST_URI'] = '/users/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id":1', $output);
}

public function testDeleteUser() {
 $_SERVER['REQUEST_METHOD'] = 'DELETE';
 $_SERVER['REQUEST_URI'] = '/users/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id":1', $output);
}
}