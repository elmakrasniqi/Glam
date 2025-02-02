<?php
class ProductCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    public function getAllProducts() {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    public function getProductCount() {
        $sql = "SELECT COUNT(*) FROM products";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }

    public function getWeeklyProductCount() {
        $sql = "SELECT COUNT(*) FROM products WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }
}

?>