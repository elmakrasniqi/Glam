<?php
require_once 'conn.php'; 
require_once '../Admin/MessageCRUD.php'; 
require_once '../Admin/ReplyCRUD.php'; 

class MessageController {
    private $messageCRUD;
    private $replyCRUD;

    public function __construct() {
        // Initialize the dbConnect and get connection
        $db = new dbConnect();
        $conn = $db->connectDB(); // Calling connectDB() to get the connection
        $this->messageCRUD = new MessageCRUD($conn);
        $this->replyCRUD = new ReplyCRUD($conn);
    }

    public function handleRequest() {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'delete' && isset($_GET['id'])) {
                $this->messageCRUD->deleteMessageById($_GET['id']);
                header("Location: manage_messages.php");
                exit();
            } elseif ($_GET['action'] == 'view' && isset($_GET['id'])) {
                $messageId = $_GET['id'];
                $message = $this->messageCRUD->getMessageById($messageId);

                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply'])) {
                    $reply = htmlspecialchars($_POST['reply']);
                    $this->replyCRUD->addReply($messageId, $reply);
                    header("Location: manage_messages.php?action=view&id=$messageId");
                    exit();
                }

                $replies = $this->replyCRUD->getRepliesByMessageId($messageId);
                return ['message' => $message, 'replies' => $replies];
            }
        }

        return ['messages' => $this->messageCRUD->getAllMessages()];
    }
}
?>
