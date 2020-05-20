<?php
session_start();

//Destroy session
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
}

//if a user is not logedin, then he will be redirected to login page
if (!isset($_SESSION['username'])) {
    $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    header("Location: login.php");
    exit;
}

$month = date('F');
$year = date('Y');
