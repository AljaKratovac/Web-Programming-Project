<?php
require_once __DIR__ .'/BaseService.php';
require_once __DIR__ .'/../dao/CartDao.php';

class CartService extends BaseService {
    public function __construct() {
        $dao = new CartDao();
        parent::__construct($dao);
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function addToCart($data) {
        return $this->dao->insert($data);
    }

    public function updateCart($id, $data) {
        return $this->dao->update($id, $data);
    }
    public function partial_cart_update($id, $data) {
        return $this->dao->partial_cart_update($id, $data);
    }

    public function deleteCart($id) {
        return $this->dao->delete($id);
    }
}
?>
