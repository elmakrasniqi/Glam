<?php
session_start();

class SessionHandler {
    
    // Check if user is logged in
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // Check if user is an admin
    public static function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] == 1; // Admin role is 1
    }

    // Log out user
    public static function logout() {
        session_unset();
        session_destroy();
    }
}

// Example of checking login and redirecting:
if (!SessionHandler::isLoggedIn()) {
    header("Location: Login.php");
    exit;
}
?>
