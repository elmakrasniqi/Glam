<?php
$message = "";
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "contactus";

$conn = new mysqli($servername, $username, $password, $dbname);

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if($conn->connect_error){
        die("Conection failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $stmt->execute();

        echo "<div class='thank-you-message'>";
        echo "<p>Thank you for contacting us. We will get back to you as soon as possible. Feel free to ask us for anything you need.</p>";
        echo "<a href='../ContactUs.html'class='back-link'>Return to Contact Form</a>";
        echo "</div>";
        $stmt->close();
        $conn->close();

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