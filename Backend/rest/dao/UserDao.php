<?php
require_once 'BaseDao.php';

class UserDao extends BaseDao {
    protected $table_name;

    public function __construct(){
        $this->table_name = "users";
        parent::__construct($this->table_name);
    }

    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    public function createUser($username, $email, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $this->insert([
        'username' => $username,
        'email' => $email,
        'password' => $hashedPassword,
        'role' => 'user'
        ]);

    }
    
    public function deleteUser($user_id) {
    $query = "DELETE FROM " . $this->users . " WHERE user_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $user_id);
    return $stmt->execute();
    }

    public function addAdmin($admin) {
    $admin['role'] = 'admin';
    return $this->insert($admin);
    }

    public function updateAdmin($id, $data) {
    return $this->update($id, $data);
    }

    public function deleteAdmin($id) {
    return $this->delete($id);
    }
}
?>