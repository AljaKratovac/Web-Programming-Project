order <?php
use PHPUnit\Framework\TestCase;
class orderTest extends TestCase {
   public function setUp(): void{
       require_once __DIR__ . '/../vendor/autoload.php';
       require_once __DIR__ . '/../index.php';
       Flight::halt(false);  // this is used to prevent auto-exit during test
       Flight::start();  // here we need to start the app
    }
    public function testGetAllOrders() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/orders';
        ob_start();
        Flight::start();
        $output = ob_get_clean();
        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"id"', $output);
    }

   public function testGetOrderById() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/orders/1';
        ob_start();
        Flight::start();
        $output = ob_get_clean();
        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
       $this->assertStringContainsString('"id":1', $output);
    }

    public function testCreateOrder() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/orders';
        ob_start();
        Flight::start();
        $output = ob_get_clean();
        $this->assertEquals(201, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"id"', $output);
    }

    public function testUpdateOrder() {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_SERVER['REQUEST_URI'] = '/orders/1';
        ob_start();
        Flight::start();
        $output = ob_get_clean();
        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"id":1', $output);
    }

    public function testPartiallyUpdateOrder() {
        $_SERVER['REQUEST_METHOD'] = 'PATCH';
        $_SERVER['REQUEST_URI'] = '/orders/1';
        ob_start();
        Flight::start();
        $output = ob_get_clean();
        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"id":1', $output);
    }

    public function testDeleteOrder() {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/orders/1';
        ob_start();
        Flight::start();
        $output = ob_get_clean();
        $this->assertEquals(200, http_response_code());
        $this->assertJson($output);
        $this->assertStringContainsString('"id":1', $output);
    }
}