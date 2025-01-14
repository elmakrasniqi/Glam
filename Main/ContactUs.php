
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
    <link rel="stylesheet" href="css/contactus.css">
    

    
</head>
<body>
    <nav>
        <input type="checkbox" id="checkbox">
        <label for="checkbox" class="checkbox">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"><a href="index.html">Glam</a></label>
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

            <form id="contact-form" action="../Main/php/contactus.php" method="POST">
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
                    <textarea name="message" id="message" required placeholder="Write your message here..."> </textarea>
                </div>
                <button  name="submit" type="submit">Send Message</button>
            </form>
        </div>
        
    </section>
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
</body>
</html>