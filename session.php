<?php

require 'dbconfig.php';

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

//if user click login, he will be redirected to the same page
$_SESSION['url'] = $_SERVER['REQUEST_URI'];

//if user click logout, he will be redirected to the same page
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	setcookie('remember_me', $getrow['active_token'], 1);
	if (isset($_SERVER['HTTP_REFERER'])) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	} else {
		header('Location: index.php');
	}
}
