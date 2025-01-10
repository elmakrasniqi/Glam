<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
<<<<<<<< HEAD:Main/dashboard.html
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="./css/footercss.css">
    <link rel="stylesheet" href="./css/headercss.css">
========
    <link rel="stylesheet" href="../Main/css/dashboard.css">
    <link rel="stylesheet" href="../Main/css/footercss.css">
    <link rel="stylesheet" href="../Main/css/headercss.css">
>>>>>>>> 06c9987413050155c2062893aac12d860bf73d36:Admin/dashboard.php
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
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
            <li><a href="dashboard.html" class="active">Dashboard</a></li>
            <li><a href="menage_users.htm">Menage Users</a></li>
            <li><a href="menage-products.html">Menage Products</a></li>
            <li><a href="Menage orders.html">Menage Orders</a></li>
            <li><a href="logout.html">Logout</a></li>
        </ul>
    </nav>
    <section id="admin-dashboard">
        <div class="dashboard-container">
            <div class="statistics">
                <div class="stat-item">
                    <h3>Total Products</h3>
                    <p>150</p>
                </div>
                <div class="stat-item">
                    <h3>Total Orders</h3>
                    <p>320</p>
                </div>
                <div class="stat-item">
                    <h3>Total Users</h3>
                    <p>500</p>
                </div>
            </div>
            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <table>
                    <tr>
                        <th>Activity</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>New product added: Jean Paul Gaultier So Scandal</td>
                        <td>2025-01-06</td>
                        <td>Success</td>
                    </tr>
                    <tr>
                        <td>Order #111 placed by user E...</td>
                        <td>2025-01-05</td>
                        <td>Completed</td>
                    </tr>
                    <tr>
                        <td>User E... updated profile</td>
                        <td>2025-01-03</td>
                        <td>Success</td>
                    </tr>
                </table>
            </div>
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