<?php
session_start();
if ($_SESSION['role'] != 0) {
    header("Location: Login.php"); // Redirect to login if the user is not a regular user
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glam</title>
    <link rel="stylesheet" href="../Main/css/homecss.css">
    <link rel="stylesheet" href="../Main/css/footercss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Main/css/headercss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Main/css/makeupcss.css">
    
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
            <li><a class="active" href="./homeindex.php">Home</a></li>
            <li><a href="./homeMakeUp.php">Make up</a></li>
            <li><a href="homeAboutUs.php">About Us</a></li>
            <li><a href="../User/LogOut.php">LogOut</a></li>
       </ul>
    </nav>



    <!-- Main content -->
    <div class="slideshow" >
      <div class="mySlidesFade">
        <img src="../img/loreal.png" alt="loreal" width="100%" class="ad">
      </div>
      <div class="mySlidesFade">
        <img src="../img/revlon.png" alt="revlon" width="100%" class="ad">
      </div>
      <div class="mySlidesFade">
        <img src="../img/inflable1.png" alt="inflable" width="100%" class="ad">
      </div>
  
  
        <a class="prev" onclick="plusSlides(-1)">&#10094</a>
        <a class="next" onclick="plusSlides(1)">&#10095</a>
  
     </div>
     <br>
     <div class="star" style="text-align: center;">
      <span class="dot" onclick="currentSlide(1)"></span>
      <span class="dot" onclick="currentSlide(2)"></span>
      <span class="dot" onclick="currentSlide(3)"></span>
  
     </div>
   

<!--Produktet e vequara-->
   <div class="products-1">
       <div class="mostsales">
           <h1>Best sellers</h1>
           <p>Here you can find our best sellers ♡  </p>
       </div>
      <section id="products">
        <div class="product-list" data-name="Jean Paul Gaultier">
        <div class="product-item" data-name="Burberry">
          <img src="../image/Burberry Her Intense EDP set.png" alt="Burberry Her Intense EDP set">
          <h3>Burberry Her Intense EDP set</h3>
          <p class="price">80.89€</p>
          <button>Add to cart</button>
       </div>
        <div class="product-item" data-name="Essence">
           <img src="../image/ESSENCE BABY GOT BLUSH 10.png" alt="Essence Baby Got Blush 10">
           <h3> Essence Baby Got Blush 10</h3>
           <p class="price">2.99€</p>
          <button>Add to cart</button>
        </div>
       <div class="product-item" data-name="Loreal">
          <img src="../image/Lorealhyaluronmask.png" alt="Loreal Hyaluron Mask">
          <h3> Loreal Hyaluron Mask</h3>
          <p class="price">7.80€</p>
          <button>Add to cart</button>
        </div>
        <div class="product-item" data-name="Maybelline">
          <img src="../image/Maybellinemascaragloss.png" alt="Maybelline Lip-Gloss">
          <h3>Maybelline Lip-Gloss</h3>
          <p class="price">4.00€</p>
          <button>Add to cart</button>
       </div>
       <div class="product-item" data-name="Note">
          <img src="../image/NoteBrowwax.png" alt="Note Brow Wax">
          <h3>Note Brow Wax </h3>
          <p class="price">10.00€</p>
          <button>Add to cart</button>
        </div>
       </div>
       <div class="parent-makeup">
        <div class="makeup-button">
            <a href="./MakeUp.html">See more</a>
        </div>
    </div>
   </div>

   <div class="chanel">
    <div class="chanel-ad">
      <h1>Chanel</h1>
      <p>Chanel makeup is the epitome of luxury and refinement, where beauty transcends the surface to reveal a world of elegance and self-expression. Each product is a testament to meticulous craftsmanship, offering not just color, but an experience. From their velvety foundations that seamlessly blend into the skin, to their vibrant lipsticks that empower with every swipe, Chanel makeup creates a flawless canvas for every woman.Every stroke, every shade, is designed to elevate the spirit, making each woman feel like a work of art in her own right. It’s an indulgence, a statement, and above all, a celebration of timeless beauty.</p>
      <div class="chanel-makeup">
         <a href="./MakeUp.html">See more</a>
      </div>
    </div>
    <div class="chanel-img">
      <img src="../img/chanel.png" alt="chanel" >
    </div>
    
  </div>

   <div class="explain">
    <div class="explain1">
      <h3>Radiant</h3>
      <h1>Lipsticks</h1>
      <p>Lipsticks are more than just a cosmetic; they are a symbol of self-expression, confidence, and style. From subtle nudes to bold reds, each shade tells a story, transforming a look in an instant. The creamy, satin textures offer a touch of elegance, while matte finishes exude sophistication and power. Lipsticks have been cherished throughout history, evolving from natural pigments to luxurious formulas enriched with hydrating ingredients. </p>

    </div>
    <div class="explain1">
      <h3>Heavenly</h3>
      <h1>Mascara</h1>
      <p> The magic wand of any makeup routine, effortlessly enhancing the eyes with just a few strokes. Designed to lengthen, volumize, and curl, it transforms lashes into a bold frame that draws attention to the eyes. Available in a variety of formulas, from waterproof to ultra-black, mascara can create anything from a natural, fluttery look to dramatic, full lashes. Its versatility makes it a go-to product for daily wear or glamorous evenings, adding definition and depth with ease. </p>
    </div>
    <div class="explain1">
      <h3>Ethereal</h3>
      <h1>Foundation</h1>
      <p>Available in various finishes—matte, dewy, or natural—it caters to every skin type and desired effect. From lightweight, sheer formulas that let your skin breathe to full-coverage options that conceal imperfections, foundation helps enhance your complexion while maintaining its unique beauty. Modern foundations often include skincare benefits, such as hydration, SPF, or antioxidants, ensuring your skin looks flawless and feels cared for.</p>
    </div>

   </div>
   <div class="offers">
    <div class="sales">
       <div class="imgoffers">
           <img src="../img/giftcard.png" alt="giftcard" style="width: 100%; " class="img-gift">
       </div>
       <div class="offerstext1">
          <h1 class="ad">Gift cards</h1>
          <a href="#" style="color: white;">New way to suprise your loved ones and let them pick their gift.</a>
       </div>
    </div>

    <div class="sales">
       <div class="imgoffers">
          <img src="../img/blackfriday.png" alt="black-friday" style="width: 100%;" class="img-gift" >
      </div>
      <div class="offerstext2">
         <h1 class="ad">Black Friday</h1>
         <a href="#" style="color: white;">So many suprises.Up to even 50% off.Don't miss it!</a>
      </div>
    </div>
    <div class="sales">
      <div class="imgoffers">
          <img src="../img/new.png" alt="new" style="width: 100%;" class="img-gift">
      </div>
      <div class="offerstext3">
          <h1 class="ad">New products</h1>
          <a href="#" style="color: white;">You can find the newest products in the market here.</a>
     </div>
    </div>
   </div>
    
    <div class="ysl">
      <div class="ysl-img">
        <img src="../img/ysl.png" alt="ysl" style="width: 100%;">
      </div>
      <div class="ysl-ad">
        <h1>YSL</h1>
        <p>YSL (Yves Saint Laurent) is a renowned luxury brand offering a wide range of makeup products known for their high-quality formulations and elegant packaging. Some of their standout items. They  regularly releases seasonal and limited-edition collections with luxurious designs, often featuring their iconic gold and black packaging.Yves Saint Laurent is a name that whispers luxury and shouts innovation. It’s a house where elegance meets audacity, where timeless classics are born and modern sophistication thrives. YSL embodies the art of bold beauty, weaving confidence into every product and daring into every design. </p>
        <div class="ysl-makeup">
           <a href="./MakeUp.html">See more</a>
        </div>
      </div>
    </div>


   <div class="colors">
    <p style=" color: rgb(250, 224, 224) ;">show your true colors</p>
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
    <script src="../Main/js/script.js"></script>
</body>
</html>
