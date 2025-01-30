<?php
require_once '../Backend/conn.php';

class MessageCRUD {
    private $conn;

    public function __construct($conn) {
    $this->conn = $conn;
    }

    public function getMessageById($id) {
    $sql = "SELECT * FROM contacts WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
    }

    public function deleteMessageById($id) {
        $sql = "DELETE FROM contacts WHERE id = :id"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  
        return $stmt->execute();
    }
    

    public function getMessageCount() {
            $sql = "SELECT COUNT(*) FROM contacts";
            $stmt = $this->conn->query($sql);
             return $stmt->fetchColumn();

    }
    public function getAllMessages() {
        $sql = "SELECT * FROM contacts";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }
}
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

$database = new dbConnect();
$conn = $database->connectDB();

$messageCRUD = new MessageCRUD($conn);
$replyCRUD = new ReplyCRUD($conn);

$messages = [];
$messageCount = $messageCRUD->getMessageCount();

    if(isset($_GET['action'])) {
        if($_GET['action'] == 'delete' && isset($_GET['id'])) {
            $messageCRUD->deleteMessageById($_GET['id']);
            header("Location: manage_messages.php");
            exit();
        } elseif ($_GET['action'] == 'view' && isset($_GET['id'])){
            $messageId = $_GET['id'];

            $message = $messageCRUD->getMessageById($messageId);


            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply'])){
                $reply = htmlspecialchars($_POST['reply']);
                $replyCRUD->addReply($messageId, $reply);

                header("Location: manage_messages.php?action=view&id=$messageId");
                exit();
            }

            $replies = $replyCRUD->getRepliesByMessageId($messageId);
        }
    } else {
        $messages = $messageCRUD->getAllMessages();
        $messageCount = $messageCRUD->getMessageCount();
        
    
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Messages</title>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../dashboard.css">
        


        <style>
body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    min-height: 100vh;
    background-color: #f4f4f4;
    color: #333;
}

.back-button {
    position: fixed;
    top: 20px;
    left: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 50%;
    padding: 10px;
    font-size: 18px;
    color: #333;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.back-button:hover {
    background-color: rgb(128, 97, 114);
    color: white;
}

.content {
    padding: 30px;
    width: 100%;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

h2 {
    font-size: 1.8rem;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.message-detail {
    margin-top: 20px;
    padding: 20px;
    background-color: #fafafa;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    font-size: 16px;
    border-radius: 8px;
    overflow: hidden;
    table-layout: fixed;
}

table, th, td {
    border: 1px solid #ddd;
    padding: 12px 15px;
    text-align: center;
}

th {
    background-color: rgb(166, 136, 152);
    color: #495057;
    font-weight: 500;
}

td {
    background-color: #fff;
    color: #6c757d;
}

tr:hover {
    background-color: #f1e2e2;
}

.action-buttons {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.action-buttons a {
    border-radius: 8px;
    padding: 10px 12px;
    background-color: rgb(128, 97, 114);
    color: white;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.action-buttons a:hover {
    background-color: #5a6268;
}

.action-buttons a.delete {
    background-color: rgb(193, 107, 104);
}

.action-buttons a.delete:hover {
    background-color: rgb(186, 91, 88);
}

.message-detail a {
    color: rgb(128, 97, 114);
    text-decoration: none;
}
.reply-section {
    margin-top:20px;
}
.reply-section label {
    font-weight: 600;
    margin-bottom: 10px;
    display: block;
}
.reply-section textarea {
    width: 60%;
    padding: 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    resize: vertical;
}

.reply-section button {
    background-color: rgb(128, 97, 114);
    color: white;
    font-size: 10px;
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: block;
    margin-top: 6px;
    margin-bottom: 10px;
}
.reply-section button:hover {
    background-color: #5a6268;
}

@media screen and (max-width: 768px) {
    
    .content h2 {
        font-size: 20px;
    }

    .message-detail {
        padding: 15px;
    }

    .back-button {
        top: 15px;
        left: 15px;
        font-size: 16px;
    }
        

    th, td {
        padding: 15px 10px;
        font-size: 12px;
    }

    .action-buttons {
        display: flex;
        flex-direction: column; 
        gap: 10px;
        justify-content: center;
        align-items: center; 
    }

    .action-buttons a {
        font-size: 12px;
        padding: 6px 10px;
        width: 80%; 
        text-align: center; 
    }

    .action-buttons a.delete {
        font-size: 12px;
        padding: 6px 10px;
        width: 80%; 
    }

    .message-detail a {
        font-size: 14px;
    }

    .message-detail {
        padding: 15px;
    }
    .reply-section button {
        font-size: 10px;
        padding: 9px 12px;
    }
}

@media screen and (max-width: 480px) {
    .message-detail {
        padding: 10px;
    }

    table {
        font-size: 12px;
    }

    .back-button {
        top: 15px;
        left: 15px;
        font-size: 16px;
    }

    .message-detail a {
        font-size: 14px;
    }

    .action-buttons a {
        font-size: 12px;
        padding: 5px 8px;
    }
    .reply-section button {
        font-size: 14px;
        padding: 8px 9px;
    }
}


    </style>

    </head>
    <body>
    <?php if(!isset($_GET['action']) || $_GET['action'] !== 'view'): ?>
    <a href="dashboard.php" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
    <?php endif; ?>
    <div class="content">
        <h2>Manage Messages (Total Messages: <?php echo $messageCount; ?>)</h2>
        
        <?php if (isset($message)): ?>
            <div class="message-detail">
                <h3>Message Details</h3>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($message['name']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($message['email']); ?></p>
                <p><strong>Subject:</strong> <?php echo htmlspecialchars($message['subject']); ?></p>
                <p><strong>Message:</strong> <?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                <p><strong>Date:</strong> <?php echo $message['created_at']; ?></p>
                
                <h4>Replies:</h4>
                <?php if (count($replies)>0): ?>
                    <ul>
                    <?php foreach ($replies as $reply): ?>
                        <li>
                            <p><?php echo nl2br(htmlspecialchars($reply['reply'])); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No replies yet.</p>
            <?php endif; ?>
            <h4>Admin Reply:</h4>
            <form method="POST" class="reply-section">
                <label for="reply">Your Reply:</label>
                <textarea name="reply" id="reply" rows="4" placeholder="Type your reply here..." required></textarea>
                <button type="submit">Send Reply</button>
            </form>
                
                <a href="manage_messages.php">Back to Messages</a>
            </div>

            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(count($messages)>0) {
                            foreach($messages as $row){
                                echo "<tr>";
                                echo "<td>" .$row["name"]."</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["subject"] . "</td>";
                                echo "<td>" . $row["created_at"] . "</td>";
                                echo "<td class='action-buttons'>";
                                echo "<a href='?action=view&id=" . $row["id"] . "'>View</a>";
                                echo " <a href='?action=delete&id=" . $row["id"] . "' class='delete'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";

                            }
                        } else {
                            echo "<tr><td colspan='5'>No messages found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php endif; ?>
                </div>

    </body>
    </html>