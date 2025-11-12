<?php
require_once __DIR__ .'/BaseService.php';
require_once __DIR__ .'/../dao/OrderDao.php';

class OrderService extends BaseService {
    public function __construct() {
        $dao = new OrderDao();
        parent::__construct($dao);
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function addOrder($data) {
        return $this->dao->insert($data);
    }

    public function updateOrder($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deleteOrder($id) {
        return $this->dao->delete($id);
    }
}
?>
