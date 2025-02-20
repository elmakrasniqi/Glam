<?php
require_once '../Backend/Admin.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $admin = new Admin();
    $userData = $admin->login($email, $password);

    if ($userData) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['role'] = $userData['role'];

        setcookie('user_email', $email, time() + (86400 * 30), "/");
        setcookie('user_id', $userData['id'], time() + (86400 * 30), "/");

        if ($userData['role'] == 1) {
            header("Location: ../Admin/dashboard.php");
            exit();
        } else {
            header("Location: ../User/homeindex.php");
            exit();
        }
    } else {
        header("Location: Login.php"); //silent fail
        exit();
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
        <label class="logo"><a href="index.php">Glam</a></label>
        <ul class="list">
            <li><a href="index.php">Home</a></li>
            <li><a href="MakeUp.php">Make up</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
            <li><a href="ContactUs.php">Contact Us</a></li>
            <li><a href="SignUp.php">SignUp</a></li>
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
                <button type="submit" class="btn">Log in</button>
                <div class="register-link">
                    <p>Don't have an account? <a href="./SignUp.php">Register here</a></p>
                </div>
            </form>
        </div>
    </div>
   <!--Validation-->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const loginForm = document.querySelector('form[action="Login.php"]');
        loginForm.addEventListener('submit', (event) => {
            const email = loginForm.querySelector('input[name="email"]').value.trim();
            const password = loginForm.querySelector('input[name="password"]').value.trim();

            const emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;

            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                event.preventDefault(); 
                return;
            }

            if (password.length < 6) {
                alert('Password must be at least 6 characters long.');
                event.preventDefault(); 
                return;
            }
        });
    });
</script>

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
                      <li><a href="../Main/AboutUs.php">About us</a></li>
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
</body>
</html>
