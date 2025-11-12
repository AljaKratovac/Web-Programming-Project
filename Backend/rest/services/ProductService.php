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
        return $this->dao->getProductById($id); 
    }

    public function add($data) {
        return $this->dao->insertProduct($data);
    }

    public function update($id, $data) {
        return $this->dao->updateProduct($id, $data); 
    }

    public function delete($id) {
        return $this->dao->deleteProduct($product_id); 
    }
}
?>
