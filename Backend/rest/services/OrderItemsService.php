<?php
require_once __DIR__ .'/BaseService.php';
require_once __DIR__ .'/../dao/OrderItemsDao.php';

class OrderItemsService extends BaseService {
    public function __construct() {
        $dao = new OrderItemsDao();
        parent::__construct($dao);
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function addOrderItem($data) {
        return $this->dao->insert($data);
    }

    public function updateOrderItem($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function partial_update_orderItems($id, $data) {
        return $this->dao->partial_update_orderItems($id, $data);
    }

    public function deleteOrderItem($id) {
        return $this->dao->delete($id);
    }
}
?>