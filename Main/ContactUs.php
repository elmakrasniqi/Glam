<?php
require_once '../Backend/conn.php';

    class ReplyCRUD{
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

    public function getMessagesWithReplies() {
        $sql = "SELECT DISTINCT contacts.*
                FROM contacts
                JOIN replies ON contacts.id = replies.message_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

    $database = new dbConnect();
    $conn = $database->connectDB();
    $replyCRUD = new ReplyCRUD($conn);
 

   $messagesWithReplies = $replyCRUD->getMessagesWithReplies();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/makeupcss.css">
    <link rel="stylesheet" href="./css/footercss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/headercss.css">
    <link rel="stylesheet" href="./css/homecss.css">
    <link rel="stylesheet" href="./css/contactus.css">
    
    
</head>
<body>
    <nav>
        <input type="checkbox" id="checkbox">
        <label for="checkbox" class="checkbox">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"><a href="index.php">Glam</a></label>
        <img src="../img/heart.png" alt="heart" class="heart">

        <ul class="list">
            <li><a href="index.php">Home</a></li>
            <li><a href="MakeUp.php">Make Up</a></li>
            <li><a href="AboutUS.php">About Us</a></li>
            <li><a class="active" href="ContactUs.php">Contact Us</a></li>
            <li><a href="Login.php">Login</a></li>
        </ul>
    </nav>
    <section id="contact-us">
        <div class="contact-container">
            <h1>Contact Us</h1>

            <form id="contact-form" action="../Main/thank-you-message.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your full name">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email address">
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject"required placeholder="Enter the subject">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" required placeholder="Write your message here..."></textarea>
                </div>
                <button  name="submit" type="submit">Send Message</button>
            </form>
        </div>
</section>

    <button id="reply-btn" class="reply-btn">
        <i class="fas fa-comment-dots"></i>
    </button>

    <div id="replies-section" class="replies-section">
        <a href="ContactUs.php" id="back-btn" class="back-btn">
            ←
        </a>
            <?php if (count($messagesWithReplies)>0): ?>
                <?php foreach ($messagesWithReplies as $message): ?>
                    <div class="message-container">
                        <h3>Message from: <?php echo htmlspecialchars($message['name']); ?></h3>
                        <p><strong>Subject:</strong> <?php echo htmlspecialchars($message['subject']); ?></p>
                        <p><strong>Message: </strong> <?php echo nl2br(htmlspecialchars($message['message'])); ?></p>
                        
                        <?php
                        $replies = $replyCRUD->getRepliesByMessageId($message['id']);
                        if(count($replies) > 0): ?>

                        <ul>
                    <?php foreach ($replies as $reply): ?>
                    <li>
                    <h3>Replies: </h3>
                    <p style="margin-bottom: 15px;"><?php echo nl2br(htmlspecialchars($reply['reply'])); ?></p>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                    <p>No replies yet.</p>
                    <?php endif; ?>
                </div>   
                    <?php endforeach; ?>
                        <?php else: ?>
                            <p>No messages with replies found.</p>
                            <?php endif; ?>
        </div>
    <footer class="footer">
        <div class="container">
          <div class="map">
            <img src="../img/map.png" alt="map" >
          </div>
          <div class="row">
                <div class="footer-col">
                   <h4>Adress</h4>
                  <ul>
                      <li><a href="#">At Bulevardi Bill Clinton <br>
                        Prishtinë, Kosovë<br>
                       +383 49 241 241 <br></a>
                       </li>
                      <li><a href="#">glamglow@gmail.com</a></li>
                  </ul>
                </div>
                <div class="footer-col">  
                  <h4>Help</h4>
                  <ul>
                      <li><a href="#">Returns</a></li>
                      <li><a href="../AboutUs.php">About us</a></li>
                      <li><a href="#">Shipping</a></li>
                  </ul>
                </div>
                <div class="footer-col">
                   <h4>Follow us</h4>
                 <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-x"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                  </div>
                </div>
            </div>
        </div>
        <div class="copyrights">
          <p style="color: rgb(119, 119, 119);">Copyright © 2024 Glam.All rights reserved!</p>
        </div>
    </div>
    </footer>

    <script>
        const replyBtn = document.getElementById('reply-btn');
        const repliesSection = document.getElementById('replies-section');

        replyBtn.addEventListener('click', function(){
            repliesSection.classList.toggle('show');
        });
    </script>
</body>
</html>