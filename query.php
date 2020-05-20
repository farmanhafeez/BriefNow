<?php

require 'dbconfig.php';

session_start();

// PHP code for feedback page
if (isset($_POST['action']) && $_POST['action'] == 'feedbackresponse') {

	if (isset($_SESSION['username'])) {
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
		$row = mysqli_fetch_array($result);
		$feedname = $row['fullname'];
		$feedemail = $row['email'];
	} else {
		$feedname = filter_var(trim($_POST['feedname']), FILTER_SANITIZE_STRING);
		$feedemail = filter_var(trim($_POST['feedemail']), FILTER_SANITIZE_STRING);
	}
	$feedmessage = filter_var(trim($_POST['feedmessage']), FILTER_SANITIZE_STRING);
	$experience = isset($_POST['experience']) ? $_POST['experience'] : '';
	$feedbackdate = date("Y-m-d");

	if (empty($feedname) || empty($feedemail) || empty($feedmessage) || empty($experience)) {
		echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
	} elseif (!filter_var($feedemail, FILTER_VALIDATE_EMAIL)) {
		echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
	}  else {
		$stmt = $conn->prepare("INSERT INTO feedback (feedname, feedemail, feedmessage, experience, feedbackdate) 
			VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $feedname, $feedemail, $feedmessage, $experience, $feedbackdate);
		if (!$stmt->execute()) {
			echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
		} else {
			echo json_encode(["status" => 4, "msg" => '<i class="fas fa-check-circle"></i> Thank you for your feedback']);
		}
	}
}

// PHP code for contact page
if (isset($_POST['action']) && $_POST['action'] == 'contactresponse') {

	if (isset($_SESSION['username'])) {
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
		$row = mysqli_fetch_array($result);
		$contactname = $row['fullname'];
		$contactemail = $row['email'];
	} else {
		$contactname = filter_var(trim($_POST['contactname']), FILTER_SANITIZE_STRING);
		$contactemail = filter_var(trim($_POST['contactemail']), FILTER_SANITIZE_EMAIL);
	}
	$contactsubject = filter_var(trim($_POST['contactsubject']), FILTER_SANITIZE_STRING);
	$contactmessage = filter_var(trim($_POST['contactmessage']), FILTER_SANITIZE_STRING);
	$contactdate = date("Y-m-d");

	if (empty($contactname) || empty($contactemail || empty($contactsubject) || empty($contactmessage))) {
		echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
	} elseif (!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
		echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
	} else {
		$stmt = $conn->prepare("INSERT INTO contact (contactname, contactemail, contactsubject, contactmessage, contactdate) 
			VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $contactname, $contactemail, $contactsubject, $contactmessage, $contactdate);
		if (!$stmt->execute()) {
			echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
		} else {
			echo json_encode(["status" => 4, "msg" => '<i class="fas fa-check-circle"></i> We got your response, we will contact you ASAP!']);
		}
	}
}

// PHP code for Comment
if (isset($_POST['action']) && $_POST['action'] == 'commentbtn') {

	$commentpostid = $_POST['postid'];
	if (isset($_SESSION['username'])) {
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
		$row = mysqli_fetch_array($result);
		$commentname = $row['fullname'];
		$commentemail = $row['email'];
		$commentpic = $row['profilepic'];
	} else {
		$commentname = filter_var(trim($_POST['commentname']), FILTER_SANITIZE_STRING);
		$commentemail = filter_var(trim($_POST['commentemail']), FILTER_SANITIZE_EMAIL);
		$commentpic = "img/apple-touch-icon.png";
	}
	$comment = filter_var(trim($_POST['comment']), FILTER_SANITIZE_STRING);
	$commentdate = date("Y-m-d");
	$commentcount = 1;

	if (empty($commentpostid) || empty($commentname) || empty($commentemail) || empty($comment)) {
		echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
	} elseif (!filter_var($commentemail, FILTER_VALIDATE_EMAIL)) {
		echo json_encode(["status" => 2, "msg" => 'Enter valid email ID']);
	} else {
		$stmt = $conn->prepare("INSERT INTO comment (commentpostid, commentname, commentemail, commentpic, comment, commentcount, commentdate) 
								VALUES (?,?,?,?,?,?,?)");
		$stmt->bind_param("sssssss", $commentpostid, $commentname, $commentemail, $commentpic, $comment, $commentcount, $commentdate);
		$query = $stmt->execute();
		if ($query == false) {
			echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
		} else {
			echo json_encode(["status" => 4, "msg" => '<i class="fas fa-check-circle"></i> Comment added successfully']);
		}
	}
}

//Newsletter form
if (isset($_POST['action']) && $_POST['action'] == 'newsletter') {

	$name = filter_var(trim($_POST['newsname']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['newsemail']), FILTER_SANITIZE_EMAIL);
	$subscription = 1;
	$date = date("Y-m-d");

	if (empty($name) || empty($email)) {
		echo json_encode(["status" => 1, "msg" => 'All the fields are required']);
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo json_encode(["status" => 2, "msg" => 'Enter valid email ID']);
	} else {
		$stmt = $conn->prepare("INSERT INTO newsletter (subscription_name,subscription_email,subscription,subscription_date) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss", $name, $email, $subscription, $date);
		if ($stmt->execute()) {
			echo json_encode(["status" => 3, "msg" => 'Thank you for  subscribing']);
		} else {
			echo json_encode(["status" => 4, "msg" => 'Something went wrong!']);
		}
	}
}
