<?php
require_once 'BaseDao.php';

class OrderItemsDao extends BaseDao {
    protected $table_name;

    public function __construct(){
        $this->table_name = "order_items";
        parent::__construct("order_items");
    }

    public function getByOrderId($order_id) {
        return $this->getByColumn('order_id', $order_id);
    }

    public function addOrderItem($data) {
        return $this->insert($data);
    }
    
    public function getAllOrderItems($order_id) { 
        return $this->getByColumn('order_id', $order_id);
    }
    
    public function updateOrderItem($id, $data) {
        return parent::update($id, $data);
    }
    public function partial_update_orderItems($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteOrderItem($id) {
        return parent::delete($id);
    }
}
?>