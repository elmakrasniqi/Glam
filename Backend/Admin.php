<?php
require_once 'User.php';

class Admin extends User {

    public function __construct() {
        parent::__construct(); 
    }

    
    public function isAdmin($email) {
        $sql = "SELECT role FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['role'] == 1) { // 1 means admin
            return true;
        }

        return false;
    }

 
    public function login($email, $password) {
        $sql = "SELECT id, password, role FROM " . $this->table . " WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return ['id' => $user['id'], 'role' => $user['role']];
            }
        }


        return false; //fail
    }
}
?>
