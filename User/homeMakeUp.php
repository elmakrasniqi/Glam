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
    <div class="product-list" data-name="Jean Paul Gaultier">
        <div class="product-item">
            <img src="../Main/image/JEAN PAUL GAULTIER SO SCANDAL EDP.png" alt="JEAN PAUL GAULTIER SO SCANDAL EDP">
            <h3>Jean Paul Gaultier So Scandal EDP</h3>
            <p class="price">79.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Note">
            <img src="../Main/image/Spf.png" alt="Note Spf 50+">
            <h3>Note Spf </h3>
            <p class="price">11.99€</p>
            <button>Add to cart</button>
        </div>  
        <div class="product-item"data-name="Jean Paul Gaultier">
            <img src="../Main/image/JEAN PAUL GAULTIER SCANDAL EDP.png" alt="JEAN PAUL GAULTIER SCANDAL EDP">
            <h3>Jean Paul Gaultier Scandal EDP</h3>
            <p class="price">89.80€</p>
            <button>Add to cart</button>
        </div> 
        <div class="product-item" data-name="Note">
            <img src="../Main/image/BB-Cream.png" alt="Note BB-Cream">
            <h3>Note BB-Cream</h3>
            <p class="price">13.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Jean Paul Gaultier">
            <img src="../Main/image/JEAN PAUL GAULTIER GAULTIER DIVINE.png" alt="JEAN PAUL GAULTIER GAULTIER DIVINE">
            <h3>Jean Paul Gaultier DIVINE</h3>
            <p class="price">96.78€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Burberry">
            <img src="../Main/image/Burberry Her Intense EDP set.png" alt="Burberry Her Intense EDP set">
            <h3>Burberry Her Intense EDP set</h3>
            <p class="price">80.89€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Essence">
            <img src="../Main/image/ESSENCE MATT FIXING COMPACT POWDER.png" alt="Essence Mat Fixing Compact Powder">
            <h3> Essence Mat Fixing Compact Powder</h3>
            <p class="price">3.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Loreal">
            <img src="../Main/image/loreal compact powder.png" alt="Loreal Compact Powder">
            <h3>Loreal Compact Powder </h3>
            <p class="price">08.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Note">
            <img src="../Main/image/NoteBrowwax.png" alt="Note Brow Wax">
            <h3>Note Brow Wax </h3>
            <p class="price">10.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Note">
            <img src="../Main/image/BrowPomade.png" alt="Brow Pomade">
            <h3>Brow Pomade</h3>
            <p class="price">13.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Jean Paul Gaultier">
            <img src="../Main/image/JEAN PAUL GAULTIER LE BEAU EDT.png" alt="JEAN PAUL GAULTIER LE BEAU EDT">
            <h3>Jean Paul Gaultier LE BEAU</h3>
            <p class="price">69.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Burberry">
            <img src="../Main/image/Burberry Ladies My Blush.png" alt="Burberry Ladies My Blush">
            <h3>Burberry Ladies My Blush</h3>
            <p class="price">76.89€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Note">
            <img src="../Main/image/Compactpowder.png" alt="Compact Powder">
            <h3>Note Compact Powder</h3>
            <p class="price">8.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Loreal">
            <img src="../Main/image/Loreal hydration serum.png" alt="Loreal Hydration Serum">
            <h3>Loreal Hydration Serum</h3>
            <p class="price">13.43€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Note">
            <img src="../Main/image/Makeup.png" alt="Lip Corrector">
            <h3> Note Lip Corrector</h3>
            <p class="price">13.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Note">
            <img src="../Main/image/Fondation.png" alt="Note Fondation">
            <h3>Note Fondation</h3>
            <p class="price">15.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Burberry">
            <img src="../Main/image/Burrberry Hero EDT.png" alt="Burrberry Hero EDT">
            <h3>Burrberry Hero EDT</h3>
            <p class="price">76.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Maybelline">
            <img src="../Main/image/Maybelline mascara.png" alt="Maybelline Mascara">
            <h3>Maybelline Mascara</h3>
            <p class="price">9.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Essence">
            <img src="../Main/image/ESSENCE LASH PRINCESS SCULPTED MASCARA.png" alt="Essence Lash Princess Masscara">
            <h3> Essence Lash Princess Masscara</h3>
            <p class="price">3.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Burberry">
            <img src="../Main/image/My Burberry.png" alt="My Burberry">
            <h3> My Burberry</h3>
            <p class="price">67.94€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Maybelline">
            <img src="../Main/image/Maybellineantiageeraser.png" alt="Maybelline anti-age eraser">
            <h3>Maybelline Anti-age Eraser</h3>
            <p class="price">9.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Loreal">
            <img src="../Main/image/Loreal shampoo.png" alt="Loreal shampoo">
            <h3> Loreal Shampoo</h3>
            <p class="price">4.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Essence">
            <img src="../Main/image/ESSENCE INSTANT MATT MAKEUP SPRAY.png" alt="Essence Instant Matt Makeup Spray">
            <h3> Essence Instant Matt Makeup Spray</h3>
            <p class="price">6.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Maybelline">
            <img src="../Main/image/Maybellinemascaragloss.png" alt="Maybelline Lip-Gloss">
            <h3>Maybelline Lip-Gloss</h3>
            <p class="price">4.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Essence">
            <img src="../Main/image/ESSENCE EXTREME SHINE VOLUME LIPGLOSS 01.png" alt="Essence Extreme Shine Volume Lipgloss">
            <h3>Essence Extreme Shine Volume Lipgloss</h3>
            <p class="price">3.00€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Loreal">
            <img src="../Main/image/Lorealhyaluronmask.png" alt="Loreal Hyaluron Mask">
            <h3> Loreal Hyaluron Mask</h3>
            <p class="price">7.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Jean Paul Gaultier">
            <img src="../Main/image/JEAN PAUL GAULTIER LE MALE TERRIBLE EDT.png" alt="JEAN PAUL GAULTIER LE MALE TERRIBLE EDT">
            <h3> Jean Paul Gaultier LE MALE Terrible</h3>
            <p class="price">83.99€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Essence">
            <img src="../Main/image/ESSENCE BABY GOT BLUSH 10.png" alt="Essence Baby Got Blush 10">
            <h3> Essence Baby Got Blush 10</h3>
            <p class="price">2.99€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Loreal">
            <img src="../Main/image/loreal black eyeliner.png" alt="loreal black eyeliner">
            <h3> Loreal Black Eyeliner</h3>
            <p class="price">7.80€</p>
            <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Jean Paul Gaultier">
            <img src="../Main/image/JEAN PAUL GAULTIER ESSENCE EDP.png" alt="JEAN PAUL GAULTIER ESSENCE EDP">
            <h3> Jean Paul Gaultier Essence EDP</h3>
            <p class="price">78.00€</p>
            <button>Add to cart</button>
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

