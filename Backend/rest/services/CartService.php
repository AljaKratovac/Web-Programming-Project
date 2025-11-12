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

    public function getById($cart_id) {
        return $this->dao->getById($id);
    }

    public function addToCart($data) {
        return $this->dao->insert($data);
    }

    public function updateCart($cart_id, $data) {
        return $this->dao->update($cart_id, $data);
    }

    public function deleteCart($cart_id) {
        return $this->dao->delete($cart_id);
    }
}
?>
