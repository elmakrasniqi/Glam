<?php
class ReplyCRUD {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getRepliesByMessageId($messageId) {
        $sql = "SELECT * FROM replies WHERE message_id = :message_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':message_id', $messageId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addReply($messageId, $reply) {
        $sql = "INSERT INTO replies (message_id, reply) VALUES (:message_id, :reply)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':message_id', $messageId, PDO::PARAM_INT);
        $stmt->bindParam(':reply', $reply, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
?>
