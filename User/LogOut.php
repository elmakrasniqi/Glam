<?php
session_start(); 
session_unset(); 
session_destroy(); 


if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', '', time() - 3600, "/"); 
}
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, "/"); 
}

header("Location: ../Main/Login.php"); // direct to login
exit();
?>
