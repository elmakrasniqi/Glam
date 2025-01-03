<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "glamdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed:" . $conn->connect_error);

}
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO contacts (name, email, subject, message) VALUES('$name', '$email', '$subject','$message')"; 
    
    if($conn->query($sql)===TRUE){
        echo"Thank you for contacting us. We will get back to you soon!";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error; 
    }
    $conn->close();
    }

    $conn = mysqli_connect($servername, $username, $password,$dbname);  
    if($conn){
        echo"you are connected!"
    }
    else{
        echo"Could not connect";
    }
    ?>