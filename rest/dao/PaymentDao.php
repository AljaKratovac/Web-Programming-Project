<?php
require_once 'BaseDao.php';


class PaymentDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "payments";
        parent::__construct("payments");
    }

    public function getByUserId($user_id) {
        return $this->getByColumn('user_id', $user_id);
    }
    public function addPayment($data) {
        return $this->insert($data);
    }
    public function updatePayment($payment_id, $data) {
        return $this->update($payment_id, $data);
    }
    public function partial_update_payment($id, $data) {
        return $this->update($id, $data);
    }
    public function deletePayment($payment_id) {
        return $this->delete($payment_id);
    }
    public function getAllPayments() {
        return $this->getAll();
    }
}
?>