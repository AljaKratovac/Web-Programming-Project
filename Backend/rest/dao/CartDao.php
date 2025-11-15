<?php
require_once 'BaseDao.php';

class CartDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "cart";
        parent::__construct("cart");
    }

    public function getByUserId($user_id) {
        return $this->getByColumn('user_id', $user_id);
    }

    public function add_to_cart($user_id, $product_id, $quantity) {
        $data = [
            'user_id' => $user_id,
            'product_id' => $product_id,
            'quantity' => $quantity
        ];
        return $this->insert($data); 
    }
    
    public function getById($cart_id) {
        return parent::getById($cart_id);
    }

    public function create($cart_data) {
        return $this->insert($cart_data);
    }

    public function updateCart($cart_id, $cart_data) {
        return $this->update($cart_id, $cart_data);
    }

    public function partial_cart_update($id, $data) {
        return $this->update($id, $data);
    }

    public function deleteCart($cart_id) {
        return $this->delete($cart_id);
    } 
}
?>