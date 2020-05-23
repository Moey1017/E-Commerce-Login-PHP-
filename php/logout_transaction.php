<?php
session_start();
// remove all session variables and destroy the session
session_unset();
session_destroy();

if (isset($_COOKIE['rememberme'])) {
    unset($_COOKIE['rememberme']);
    setcookie('rememberme', '', time() - 3600, '/'); // empty value and old timestamp
}

header("location: ../index.php");
?>

