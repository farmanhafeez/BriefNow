<?php

require '../dbconfig.php';

session_start();

// Remember me
if (isset($_COOKIE['remember_me']) && !isset($_SESSION['username'])) {
	$user = $conn->prepare("SELECT * FROM users WHERE active_token = ?");
	$user->bind_param("s", $_COOKIE['remember_me']);
	$user->execute();
	$getresult = $user->get_result();
	$getrow = $getresult->fetch_array();

	if ($_COOKIE['remember_me'] == $getrow['active_token']) {
		$_SESSION['username'] = $getrow['username'];
	}
}

//Destroy session
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    setcookie('remember_me', $getrow['active_token'], 1);
}

//if a user is not logedin, then he will be redirected to login page
if (!isset($_SESSION['username'])) {
    $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    header("Location: ../login");
    exit;
}

$month = date('F');
$year = date('Y');
