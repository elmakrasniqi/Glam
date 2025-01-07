<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "contactus";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);

}
$message = "";
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $messageContent = $_POST['message'];
    
    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES('$name', '$email', '$subject','$messageContent')"; 
    
    if($conn->query($sql)===TRUE){
        $message = "Thank you for contacting us. We will get back to you soon!";
    }else{
        $message =  "Error: " . $conn->error; 
    }
    $conn->close();
    }
    ?>
    
    
    