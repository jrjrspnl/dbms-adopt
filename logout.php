<?php
session_start();
session_unset();
session_destroy();

// Remove the loggedIn cookie
setcookie('loggedIn', '', time() - 3600, "/");

header("Location: login.php");
exit();
?>
