<?php
class Database {
    private $conn;
    private $servername = "localhost:3307";
    private $username = "root";
    private $password = "";
    private $dbname = "glam_db";

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }

    public function close() {
        $this->conn = null;
    }
}

class ContactFormHandler {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function submitContactForm($name, $email, $subject, $message) {
        $conn = $this->db->connect();
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $subject);
        $stmt->bindParam(4, $message);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    $contactHandler = new ContactFormHandler();

    if($contactHandler->submitContactForm($name, $email, $subject, $message)) {
        header("Location: contactus.php?status=success");
        exit();
    }else {
        header ("Location: contactus.php?status=error");
        exit();
    }
}

if(isset($_GET['status'])){
    if($_GET['status'] == 'success'){
        echo "<div class='thank-you-message'>";
        echo "<p>Thank you for contacting us. We will get back to you as soon as possible. Feel free to ask us for anything you need.</p>";
        echo "<a href='../ContactUs.php' class='back-link'>Return to Contact Form</a>";
        echo "</div>";
    } elseif ($_GET['status']=='error'){
        echo "<div class='thank-you-message'>";
        echo "<p>There wan an error with your submission. Please try again.</p>";
        echo "<a href='../ContactUs.php' class='back-link'>Return to Contact Form</a>";
        echo "</div>";
 }
}
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600&display=swap');

.thank-you-message {
    background-color: rgba(250, 224, 224, 0.664);
    padding: 70px 30px;
    width: 90%;
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
    box-sizing: border-box;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.thank-you-message p {
    font-size: 1.5em;
    color: #333;
    margin-bottom: 20px;
    font-family: 'Dancing Script', cursive;
}

.back-link{
    margin-top: 10px;
    padding: 12px 20px;
    background-color: #333;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1.1em;
}

.back-link:hover {
    background-color: #d59da7;
 }

 @media screen and (max-width: 768px) {
    .thank-you-message {
        width: 90%;
        padding: 30px 15px;
    }
    .thank-you-message p {
        font-size: 1.2em;
    }
    .back-link {
        font-size: 1em;
        padding: 10px 18px
    }
    
 }
</style>