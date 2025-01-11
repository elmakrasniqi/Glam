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
    <label for="checkbox" class="checkbox">
        <i class="fas fa-bars"></i>
    </label>

    <label class="logo"  ><a href="index.html">Glam </a></label>
    <img src="../img/heart.png" alt="heart" class="heart">
    
    <ul class="list">
        <li><a href="index.html">Home</a></li>
        <li><a href="MakeUp.html">Make up</a></li>
        <li><a href="AboutUs.html">About Us</a></li>
        <li><a class="active" href="Login.html">Login</a></li>
   </ul>
</nav>
  
  <!--Login Form-->
  <div class="login-container">
    <div class="wrapper">
        <form action="">
            <h1>Log In</h1>
            <div class="input-box">
                <input type="email" id="email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                <input type="password" id="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>
            <div class="remeber-forgot">
                <label for="remember"><input type="checkbox" id="remember">Remember me</label>
                <a href="#">Forgot password</a>
            </div>

            <button type="submit" class="btn">Log in</button>

            <div class="register-link">
                <p>Don't have an account? <a href="./SignUp.html">Register here</a></p>
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
    <!-- <script src="./js/validation.js"></script> -->
</body>
</html>
