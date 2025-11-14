<?php
require_once __DIR__ .'/BaseService.php';
require_once __DIR__ .'/../dao/UserDao.php';

class UserService extends BaseService {
    public function __construct() {
        $dao = new UserDao();
        parent::__construct($dao);
    }

    public function getAllUsers() {
        return $this->dao->getAll();
    }

    public function getByEmail($email) {
       return $this->dao->getByEmail($email);
    }

    public function addUser($data) {
        return $this->dao->insert($data);
    }

    public function updateUser($id, $data) {
        return $this->dao->update($id, $data);
    }

    public function partial_update_user($id, $data) {
        return $this->dao->partial_update_user($id, $data);
    }

    public function deleteUser($id) {
        return $this->dao->delete($id);
    }
}
?>
