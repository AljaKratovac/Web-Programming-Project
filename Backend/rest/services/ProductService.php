<?php
require_once __DIR__ .'/BaseService.php';
require_once __DIR__ .'/../dao/ProductDao.php';

class ProductService extends BaseService {
    public function __construct() {
        $dao = new ProductDao();
        parent::__construct($dao);
    }

    public function getAll() {
        return $this->dao->getAllProducts(); 
    }

    public function getById($id) {
        return $this->dao->getById($id); 
    }

    public function insertProduct($data) {
        return $this->dao->insert($data);
    }

    public function updateProduct($id, $data) {
        return $this->dao->update($id, $data); 
    }
    public function partial_update_product($id, $data) {
        return $this->dao->partial_update_product($id, $data);
    }

    public function deleteProduct($id) {
        return $this->dao->delete($id); 
    }
}
?>