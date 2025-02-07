<?php
require_once '../Backend/conn.php';
require_once '../Backend/Products.php';

$db = new dbConnect();
$pdo = $db->connectDB();

$products = Product::getAllProducts($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Makeup-Glam</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Main/css/makeupcss.css">
    <link rel="stylesheet" href="../Main/css/footercss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Main/css/headercss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Main/css/homecss.css">
    
    
</head>
<body>
        <nav>
            <input type="checkbox" id="checkbox">
            <label for="checkbox" class="checkbox">
                <i class="fas fa-bars"></i>
            </label>
    
            <label class="logo"  ><a href="homeindex.php">Glam </a></label>
            <img src="../img/heart.png" alt="heart" class="heart">
            
            <ul class="list">
                <li><a  href="./homeindex.php">Home</a></li>
                <li><a class="active" href="./homeMakeUp.php">Make up</a></li>
                <li><a href="homeAboutUs.php">About Us</a></li>
                <li><a href="LogOut.php">LogOut</a></li>
           </ul>
        </nav>
    
     <div class="makeup-header">
     <div class="brand-selector" style="margin-top: 100px;">
        <label for="brand-select"></label>
        <div class= "dropdown">
          <select id="brand-select">
              <option value="disabled selected">Brands</option>
              <option value="">All products</option>
              <option value="Jean Paul Gaultier">Jean Paul Gaultier</option>
              <option value="Note">Note</option>
              <option value="Burberry">Burberry</option>
              <option value="Essence">Essence</option>
              <option value="Loreal">Loreal</option>
          </select>
      </div>
     </div>
       <div class="search">
          <input type="text" id="search-bar" placeholder="Search products...">
          <button id="search-button">Search</button>
        </div>
     </div>

    <section id="products">
        <div class="product-list">
            <?php
            foreach ($products as $product) {
                echo $product->displayProduct();
            }
            ?>
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
        
    <script src="../Main/js/Makeup.js" type="text/javascript"></script>
</body>
</html>

