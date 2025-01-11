<?php
require_once 'User.php';

class Admin extends User {
    public function __construct() {
        parent::__construct(); // Call parent constructor for database connection
    }

    // Example method: Promote a user to admin
    public function promoteUser($userId) {
        $sql = "UPDATE " . $this->table . " SET role = 1 WHERE id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":user_id", $userId);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Example method: View all users
    public function viewUsers() {
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>
  