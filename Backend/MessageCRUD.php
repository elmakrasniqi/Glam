<?php
class Message {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Get a message by its ID
    public function getMessageById($id) {
        $sql = "SELECT * FROM contacts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Delete a message by its ID
    public function deleteMessageById($id) {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Get total message count
    public function getMessageCount() {
        $sql = "SELECT COUNT(*) FROM contacts";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }

    // Get all messages
    public function getAllMessages() {
        $sql = "SELECT * FROM contacts";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    // Get the message count for the past week
    public function getWeeklyMessageCount() {
        $sql = "SELECT COUNT(*) FROM contacts WHERE created_at > DATE_SUB(NOW(), INTERVAL 1 WEEK)";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    }
}
?>
