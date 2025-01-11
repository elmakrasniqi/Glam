<?php
session_start();
session_unset();
session_destroy();

// Delete cookies if set
setcookie('user_email', '', time() - 3600, "/");
setcookie('user_id', '', time() - 3600, "/");

header("Location: ../Main/Login.php");
exit();
?>
