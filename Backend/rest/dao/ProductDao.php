<?php
require_once 'BaseDao.php';

class ProductDAO extends BaseDao {
    protected $table_name;

    public function __construct(){
        $this->table_name = "products";
        parent::__construct($this->table_name);
    }

    public function getByProductId($product_id) {
        $stmt = $this->connection->prepare("SELECT * FROM usproducts WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateProduct($product_id, $data) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET price=:price, stock_quantity=:stock WHERE product_id=:id");
        return $stmt->execute([
            ':price' => $data['price'],
            ':stock' => $data['stock_quantity'],
            ':id' => $product_id
        ]);
    }
    public function insertProduct($product_data) {
    $stmt = $this->connection->prepare(
        "INSERT INTO {$this->table_name} (name, price) VALUES (:name, :price)"
    );
    return $stmt->execute([
        'name' => $product_data['name'],
        'price' => $product_data['price']
    ]);
  }

    
    public function deleteProduct($product_id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE product_id = :id");
        return $stmt->execute([':id' => $product_id]);
    }
     public function getAllProducts() {
        return parent::getAll();
    }
}
?>
