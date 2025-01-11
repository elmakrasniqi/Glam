<?php
require_once '../Backend/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();

    // Retrieve form data
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->role = isset($_POST['role']) ? $_POST['role'] : 0; // Default to user role (0)

    if ($user->register()) {
        echo "Registration successful!";
    } else {
        echo "Registration failed. Please try again.";
    }
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp-Glam</title>
    <link rel="stylesheet" href="./css/signupcss.css">
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
    <label for="checkbox" class="checkbox">
        <i class="fas fa-bars"></i>
    </label>

    <label class="logo"  ><a href="index.html">Glam </a></label>
    <img src="../img/heart.png" alt="heart" class="heart">
    
    <ul class="list">
        <li><a  href="index.html">Home</a></li>
        <li><a href="MakeUp.html">Make up</a></li>
        <li><a href="AboutUs.html">About Us</a></li>
        <li><a class="active" href="Login.html">Login</a></li>
   </ul>
</nav>

<div class="wrapper">
  <div class="form-container">
      <h1>Sign up</h1>
      <!-- <form id="form">
          <div class="input-box">
              <input type="text" placeholder="Emri" required><br><br>
              <input type="text" placeholder="Mbiemri" required><br><br>
              <input type="email" placeholder="Email" required><br><br>
              <input type="password" placeholder="Password" required><br><br>
              
          </div>
          <div class="button">
              <button type="submit" class="btn">Sign Up</button>
          </div>
      </form> -->
      <form id="form" action="Signup.php" method="POST">
    <div class="input-box">
        <input type="text" name="first_name" placeholder="Emri" required><br><br>
        <input type="text" name="last_name" placeholder="Mbiemri" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="hidden" name="role" value="0"> <!-- Default role is user -->
    </div>
    <div class="button">
        <button type="submit" class="btn">Sign Up</button>
    </div>
</form>
  
  </div>
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
                    <li><a href="../AboutUs.html">About us</a></li>
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