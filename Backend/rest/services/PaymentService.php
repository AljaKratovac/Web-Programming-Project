<?php
require_once __DIR__ .'/BaseService.php';
require_once __DIR__ .'/../dao/PaymentDao.php';

class PaymentService extends BaseService {
    public function __construct() {
        $dao = new PaymentDao();
        parent::__construct($dao);
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        return $this->dao->getById($id);
    }

    public function addPayment($data) {
        return $this->dao->insert($data);
    }

    public function updatePayment($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function deletePayment($id) {
        return $this->dao->delete($id);
    }
}
?>
