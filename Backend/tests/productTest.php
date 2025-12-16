<?php
use PHPUnit\Framework\TestCase;
class productTest extends TestCase {
 public function setUp(): void{
 require_once __DIR__ . '/../vendor/autoload.php';
 require_once __DIR__ . '/../index.php';
 Flight::halt(false); // this is used to prevent auto-exit during test
 Flight::start(); // here we need to start the app
 }

public function testGetAllProducts() {
 $_SERVER['REQUEST_METHOD'] = 'GET';
 $_SERVER['REQUEST_URI'] = '/products';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id"', $output);
}

public function testGetProductById() {
 $_SERVER['REQUEST_METHOD'] = 'GET';
 $_SERVER['REQUEST_URI'] = '/products/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id":1', $output);
}

public function testCreateProduct() {
 $_SERVER['REQUEST_METHOD'] = 'POST';
 $_SERVER['REQUEST_URI'] = '/products';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(201, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id"', $output);
}

public function testUpdateProduct() {
 $_SERVER['REQUEST_METHOD'] = 'PUT';
 $_SERVER['REQUEST_URI'] = '/products/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id":1', $output);
}

public function testPartiallyUpdateProduct() {
 $_SERVER['REQUEST_METHOD'] = 'PATCH';
 $_SERVER['REQUEST_URI'] = '/products/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id":1', $output);
}

public function testDeleteProduct() {
 $_SERVER['REQUEST_METHOD'] = 'DELETE';
 $_SERVER['REQUEST_URI'] = '/products/1';
 ob_start();
 Flight::start();
 $output = ob_get_clean();
 $this->assertEquals(200, http_response_code());
 $this->assertJson($output);
 $this->assertStringContainsString('"id":1', $output);
}
}