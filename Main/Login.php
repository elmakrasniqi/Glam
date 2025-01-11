<?php
require_once '../Backend/Admin.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $admin = new Admin();
    $userData = $admin->login($email, $password);

    if ($userData) {
        // User login successful
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['role'] = $userData['role'];

        // Redirect to admin or user dashboard
        if ($userData['role'] == 1) {
            header("Location: ../Admin/dashboard.php");
        } else {
            header("Location: ../User/homeindex.php");
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Glam</title>
    <link rel="stylesheet" href="./css/logincss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="./css/homecss.css">
      <link rel="stylesheet" href="./css/footercss.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="stylesheet" href="./css/headercss.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <link rel="stylesheet" href="./css/homecss.css">
    
</head>
<body>

    <nav>
        <input type="checkbox" id="checkbox">
        <label for="checkbox" class="checkbox"><i class="fas fa-bars"></i></label>
        <label class="logo"><a href="index.html">Glam</a></label>
        <ul class="list">
            <li><a href="index.html">Home</a></li>
            <li><a href="MakeUp.html">Make up</a></li>
            <li><a href="AboutUs.html">About Us</a></li>
            <li><a class="active" href="Login.html">Login</a></li>
        </ul>
    </nav>
  
    <div class="login-container">
        <div class="wrapper">
            <form action="Login.php" method="POST">
                <h1>Log In</h1>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="remember-forgot">
                    <label for="remember"><input type="checkbox" name="remember">Remember me</label>
                    <a href="#">Forgot password</a>
                </div>
                <button type="submit" class="btn">Log in</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="./SignUp.html">Register here</a></p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
