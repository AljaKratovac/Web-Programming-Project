<?php
require_once 'BaseDao.php';

class OrderDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "orders";
        parent::__construct("orders");
    }

    public function getByOrderId($order_id) {
        return $this->getByColumn('order_id', $order_id);
    }

    public function getByUserId($user_id) {
        return parent::getById($user_id);
    }
    public function addOrders($orders){
        $this->insert($orders);
        return $orders;
    }
    public function deleteOrder($order_id) {
        return $this->delete($order_id);
    }
}
?>