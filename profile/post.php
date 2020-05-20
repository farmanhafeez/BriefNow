<?php
require('../dbconfig.php');
require('session.php');

$title = "";
$description = "";
$body = "";
$categories = "";
$tags = "";
$error = "";
$success = "";

// if user click publish button
if (isset($_POST['publish_btn'])) {

	$title = trim(mysqli_real_escape_string($conn, $_POST['title']));
	$author = $_SESSION['username'];
	$description = trim(mysqli_real_escape_string($conn, $_POST['description']));
	$body = trim($_POST['body']);
	$categories = mysqli_real_escape_string($conn, isset($_POST['category']) ? $_POST['category'] : '');
	$tags = trim(mysqli_real_escape_string($conn, $_POST['tags']));
	$count = 0;
	$blogdate = date("Y-m-d");
	$commentcount = 0;
	$listed = 1;
	$filename = $_FILES['thumbnail']['name'];
	$tempname = $_FILES['thumbnail']['tmp_name'];
	$imgsize = $_FILES['thumbnail']['size'];
	$file_name_array = explode(".", $filename);
	$extension = end($file_name_array);
	$allowed_extension = array("jpg", "gif", "png", "jpeg");
	$new_filename = rand() . '.' . $extension;
	$maxsize    = 2097152;

	if (empty($title) || empty($description) || empty($body) || empty($categories) || empty($tags) || empty($filename)) {
		$error = "Please fill all the fields!";
	} elseif (!in_array($extension, $allowed_extension)) {
		$error = "Please select png or jpg or jpeg or gif format";
	} elseif ($imgsize > $maxsize || $imgsize == 0) {
		$error = "Image size should be less than or equal to 2MB";
	} else {
		chmod('../upload', 0777);
		$filelocation = '../upload/' . $new_filename;
		move_uploaded_file($tempname, $filelocation);
		$fileurl = 'upload/' . $new_filename;
		$stmt = $conn->prepare("INSERT INTO blog (title, author, description, body, categories, tags, thumbnail, count, blogdate, commentcount, listed) 
			VALUES ('$title', '$author', '$description', '$body', '$categories', '$tags', '$fileurl', '$count', '$blogdate', '$commentcount', '$listed')");
		if (!$stmt->execute()) {
			$error = "ERROR: Could not able to execute" . mysqli_error($conn);
		} else {
			$success =  "Your blog post is successfully published";
			header("refresh:3;url=blog.php");
		}
	}
}

// if user click draft button
if (isset($_POST['draft_btn'])) {

	$title = trim(mysqli_real_escape_string($conn, $_REQUEST['title']));
	$author = $_SESSION['username'];
	$description = trim(mysqli_real_escape_string($conn, $_REQUEST['description']));
	$body = trim($_POST['body']);
	$categories = mysqli_real_escape_string($conn, isset($_POST['category']) ? $_POST['category'] : '');
	$tags = trim(mysqli_real_escape_string($conn, $_REQUEST['tags']));
	$count = 0;
	$blogdate = date("Y-m-d");
	$commentcount = 0;
	$listed = 0;
	$filename = $_FILES['thumbnail']['name'];
	$tempname = $_FILES['thumbnail']['tmp_name'];
	$imgsize = $_FILES['thumbnail']['size'];
	$file_name_array = explode(".", $filename);
	$extension = end($file_name_array);
	$allowed_extension = array("jpg", "gif", "png", "jpeg");
	$new_filename = rand() . '.' . $extension;
	$maxsize    = 2097152;

	if (empty($title) || empty($description) || empty($body) || empty($categories) || empty($tags) || empty($filename)) {
		$error = "Please fill all the fields!";
	} elseif (!in_array($extension, $allowed_extension)) {
		$error = "Please select png or jpg or jpeg or gif format";
	} elseif ($imgsize > $maxsize || $imgsize == 0) {
		$error = "Image size should be less than or equal to 2MB";
	} else {
		chmod('../upload', 0777);
		$filelocation = '../upload/' . $new_filename;
		move_uploaded_file($tempname, $filelocation);
		$fileurl = 'upload/' . $new_filename;
		$stmt = $conn->prepare("INSERT INTO blog (title, author, description, body, categories, tags, thumbnail, count, blogdate, commentcount, listed) 
			VALUES ('$title', '$author', '$description', '$body', '$categories', '$tags', '$fileurl', '$count', '$blogdate', '$commentcount', '$listed')");
		if (!$stmt->execute()) {
			$error = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		} else {
			$success =  "Your blog post is successfully published";
			header("refresh:3;url=blog.php");
		}
	}
}

//Update blog post
if (isset($_POST['action']) && $_POST['action'] == 'updateblog') {

	$postid = $_POST['hiddenid'];
	if (isset($_POST['listed'])) {
		$listed = 1;
	} else {
		$listed = 0;
	}
	$title = trim(mysqli_real_escape_string($conn, $_POST['title']));
	$description = trim(mysqli_real_escape_string($conn, $_POST['description']));
	$body = trim($_POST['body']);
	$categories = mysqli_real_escape_string($conn, isset($_POST['category']) ? $_POST['category'] : '');
	$tags = trim(mysqli_real_escape_string($conn, $_POST['tags']));

	if (empty($title) || empty($description) || empty($body) || empty($categories) || empty($tags)) {
		echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> Please fill all the fields']);
	} else {
		$stmt = $conn->prepare("UPDATE blog SET title = ?, description = ?, body = ?, categories = ?, tags = ?, listed = ? 
        WHERE author = '" . $_SESSION['username'] . "' AND postid = '$postid'");
		$stmt->bind_param("ssssss", $title, $description, $body, $categories, $tags, $listed);
		$result = $stmt->execute();
		if ($result == false) {
			echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> There is a problem in updating blog!']);
		} else {
			echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Blog has been successfully updated']);
		}
		$stmt->close();
	}
}

//Update thumbnail
if (isset($_POST['thumbnailbtn'])) {

	$postid = $_POST['blogpostid'];
	$user = $_SESSION['username'];

	$stmt = $conn->prepare("SELECT * FROM blog WHERE author = ? AND postid = ?");
	$stmt->bind_param("ss", $user, $postid);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_array();
	$thumbnailurl = $row['thumbnail'];
	$filename_array = explode("/", $thumbnailurl);
	$end_filename = end($filename_array);
	$profilename = explode(".", $end_filename);
	$endname = ($profilename)[0];

	$filename = $_FILES['thumbnail']['name'];
	$tempname = $_FILES['thumbnail']['tmp_name'];
	$imgsize = $_FILES['thumbnail']['size'];
	$file_name_array = explode(".", $filename);
	$extension = end($file_name_array);
	$new_imagename = $endname . '.' . $extension;
	$allowed_extension = array("jpg", "gif", "png", "jpeg");
	$maxsize    = 2097152;

	if (empty($filename)) {
		$error = "Please select an image";
	} elseif (!in_array($extension, $allowed_extension)) {
		$error = "Please select png or jpg or jpeg or gif format";
	} elseif ($imgsize >= $maxsize || $imgsize == 0) {
		$error = "Image size should be less than or equal to 2MB";
	} else {
		chmod('../upload', 0777);
		$filelocation = '../upload/' . $new_imagename;
		move_uploaded_file($tempname, $filelocation);
		$fileurl = 'upload/' . $new_imagename;
		$query = "UPDATE blog SET thumbnail = '$fileurl' WHERE author = '$user' AND postid = '$postid'";
		if (mysqli_query($conn, $query)) {
			$success = "Thumbnail changed successfully";
			header("refresh:3;url=blog.php");
		} else {
			$error = "ERROR: Could not able to execute" . mysqli_error($conn);
		}
	}
}

//Image upload
if (isset($_FILES['upload']['name'])) {
	$file = $_FILES['upload']['tmp_name'];
	$file_name = $_FILES['upload']['name'];
	$file_name_array = explode(".", $file_name);
	$extension = end($file_name_array);
	$new_image_name = rand() . '.' . $extension;
	chmod('../upload', 0777);
	$allowed_extension = array("jpg", "gif", "png", "jpeg");
	if (in_array($extension, $allowed_extension)) {
		move_uploaded_file($file, '../upload/' . $new_image_name);
		$function_number = $_GET['CKEditorFuncNum'];
		$url = '../upload/' . $new_image_name;
		$message = '';
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
	}
}

mysqli_close($conn);
