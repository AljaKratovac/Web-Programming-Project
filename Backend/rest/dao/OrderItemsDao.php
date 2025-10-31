<?php
require_once 'BaseDao.php';

class OrderItemsDao extends BaseDao {
    protected $table_name;

    public function __construct(){
        $this->table_name = "order_items";
        parent::__construct($this->table_name);
    }

    public function getByOrderId($order_id) {
        $stmt = $this->connection->prepare("SELECT * FROM order_items WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function addOrderItem($order_items) {
        return $this->insert($order_items);
    }
    public function getAllOrderItems($order_id) {
        return parent::getAll();
    }
     public function updateOrderItem($id, $order_items) {
        return parent::update($id, $order_items);
    }

    public function deleteOrderItem($id) {
        return parent::delete($id);
    }
}
?>