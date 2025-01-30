<?php
require_once '../Backend/User.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User();

    // Check if all fields are set
    if (empty($_POST['first_name']) || empty($_POST['last_name']) || empty($_POST['email']) || empty($_POST['password'])) {
        echo "Please fill all fields!";
    } else {
        // Retrieve form data
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->role = isset($_POST['role']) ? $_POST['role'] : 0; // Default to user role (0)

        // Try to register the user
        if ($user->register()) {
            // Get user data after registration
            $userData = $user->getUserByEmail($user->email); // Implement this function in your User class

            if ($userData) {
                // Set session variables
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['role'] = $userData['role'];

                // Set cookies for persistent login
                setcookie('user_email', $user->email, time() + (86400 * 30), "/");
                setcookie('user_id', $userData['id'], time() + (86400 * 30), "/");

                // Redirect to dashboard based on role
                if ($userData['role'] == 1) {
                    header("Location: ../Admin/dashboard.php");
                } else {
                    header("Location: ../User/homeindex.php");
                }
                exit;
            }
        } else {
            echo "Registration failed. Email may already be in use.";
        }
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
</head>
<body>
    <nav>
        <input type="checkbox" id="checkbox">
        <label for="checkbox" class="checkbox">
            <i class="fas fa-bars"></i>
        </label>
        <label class="logo"><a href="index.php">Glam </a></label>
        <img src="../img/heart.png" alt="heart" class="heart">
        <ul class="list">
            <li><a href="index.php">Home</a></li>
            <li><a href="MakeUp.php">Make up</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
            <li><a class="active" href="Login.php">Login</a></li>
        </ul>
    </nav>

    <div class="wrapper">
        <div class="form-container">
            <h1>Sign up</h1>
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
                <img src="../img/map.png" alt="map">
            </div>
            <div class="row">
                <div class="footer-col">
                    <h4>Address</h4>
                    <ul>
                        <li><a href="#">At Bulevardi Bill Clinton <br> Prishtinë, Kosovë<br> +383 49 241 241 <br></a></li>
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
            <p style="color: rgb(119, 119, 119);">Copyright © 2024 Glam. All rights reserved!</p>
        </div>
    </footer>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const signupForm = document.querySelector('form[action="Signup.php"]');
        signupForm.addEventListener('submit', (event) => {
            const firstName = signupForm.querySelector('input[name="first_name"]').value.trim();
            const lastName = signupForm.querySelector('input[name="last_name"]').value.trim();
            const email = signupForm.querySelector('input[name="email"]').value.trim();
            const password = signupForm.querySelector('input[name="password"]').value.trim();

            // Regex for email validation
            const emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;

            // Regex for name validation (only letters, spaces, and dashes allowed)
            const nameRegex = /^[a-zA-Z\s-]+$/;

            // Validate first name
            if (!nameRegex.test(firstName)) {
                alert('First name can only contain letters, spaces, and dashes.');
                event.preventDefault();
                return;
            }

            // Validate last name
            if (!nameRegex.test(lastName)) {
                alert('Last name can only contain letters, spaces, and dashes.');
                event.preventDefault();
                return;
            }

            // Validate email
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                event.preventDefault();
                return;
            }

            // Validate password length
            if (password.length < 6) {
                alert('Password must be at least 6 characters long.');
                event.preventDefault();
                return;
            }
        });
    });
</script>
</body>
</html>

