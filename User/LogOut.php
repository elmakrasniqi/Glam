<?php
session_start(); // Start the session to destroy it
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Delete cookies by setting their expiration time in the past
if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', '', time() - 3600, "/"); // Clear email cookie
}
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, "/"); // Clear ID cookie
}

// Redirect to the login page after successful logout
header("Location: ../Main/Login.php");
exit();
?>
