<?php
require_once 'BaseDao.php';

class ProductDAO extends BaseDao {

    public function __construct(){
        parent::__construct("products");
    }

    public function getProductById($product_id) {
        return parent::getById($product_id);
    }

    public function updateProduct($product_id, $data) {
        $mappedData = [
            'price' => $data['price'],
            'stock_quantity' => $data['stock_quantity']
        ];
        return parent::update($product_id, $mappedData);
    }

    public function insertProduct($product_data) {
        $mappedData = [
            'name' => $product_data['name'],
            'price' => $product_data['price']
        ];
        return parent::insert($mappedData);
    }

    public function partial_update_product($id, $data) {
        return $this->update($id, $data);
    }



    public function getAllProducts() {
        return parent::getAll();
    }

    public function deleteProduct($product_id) {
    return parent::delete($product_id);
    }
}
?>
