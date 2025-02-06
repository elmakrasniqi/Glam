<?php
class UserCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserCount() {
        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }

    public function getWeeklyUserCount() {
        $sql = "SELECT COUNT(*) FROM users WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }
}
?>