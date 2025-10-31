<?php
require_once 'BaseDao.php';

class PaymentDao extends BaseDao {
    protected $table_name;

    public function __construct()
    {
        $this->table_name = "payments";
        parent::__construct($this->table_name);
    }

    public function getByUserId($user_id) {
        $stmt = $this->connection->prepare("SELECT * FROM payments WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function addPayment($payment_data) {
        return $this->insert($payment_data);
    }
    public function updatePayment($payment_id, $payment_data) {
        return $this->update($payment_id, $payment_data);
    }
    public function deletePayment($payment_id) {
        return $this->delete($payment_id);
    }
    public function getAllPayments() {
        return $this->getAll();
    }

}