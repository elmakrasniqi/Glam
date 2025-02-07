<?php
session_start();

class SessionHandler {
    
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }


    public static function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] == 1; 
    }


    public static function logout() {
        session_unset();
        session_destroy();
    }
}

if (!SessionHandler::isLoggedIn()) {
    header("Location: Login.php");
    exit;
}
?>
