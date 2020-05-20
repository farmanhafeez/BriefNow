<?php

require '../dbconfig.php';
require 'session.php';

$error = "";
$success = "";

//Delete blog post
if (isset($_POST['action']) && $_POST['action'] == 'deletepost') {
    $postid = $_POST['deletepostid'];
    if (empty($postid)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
    } else {
        //Delete post thumbnail image
        $stmt3 = $conn->prepare("SELECT * FROM blog WHERE postid = ?");
        $stmt3->bind_param("s", $postid);
        $stmt3->execute();
        $result = $stmt3->get_result();
        $row = $result->fetch_array();
        $thumbnail = '../' . $row['thumbnail'];
        chmod('../upload', 0777);
        if (!unlink($thumbnail)) {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> Image cannot be deleted']);
        } else {
            $stmt = $conn->prepare("DELETE FROM blog WHERE postid = ?");
            $stmt->bind_param("s", $postid);
            if (!$stmt->execute()) {
                echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
            } else {
                //Delete post comments
                $stmt1 = $conn->prepare("DELETE FROM comment WHERE commentpostid = ?");
                $stmt1->bind_param("s", $postid);
                $stmt1->execute();
                //Delete post comments reply
                $stmt2 = $conn->prepare("DELETE FROM commentreply WHERE postid = ?");
                $stmt2->bind_param("s", $postid);
                $stmt2->execute();
                echo json_encode(["status" => 4, "msg" => '<i class="fas fa-check-circle"></i> Post deleted successfully']);
            }
            //echo json_encode(["status" => 2, "msg" => '<i class="fas fa-check-circle"></i> Post deleted successfully']);
        }
    }
}

//Delete comment
if (isset($_POST['action']) && $_POST['action'] == 'deletecomment') {
    $commentid = $_POST['dcommentid'];
    if (empty($commentid)) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
    } else {
        $stmt = $conn->prepare("DELETE FROM comment WHERE commentid = ?");
        $stmt->bind_param("s", $commentid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
        } else {
            $stmt1 = $conn->prepare("DELETE FROM commentreply WHERE commentid = ?");
            $stmt1->bind_param("s", $commentid);
            $stmt1->execute();
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-check-circle"></i> Comment deleted successfully']);
        }
    }
}

//Delete reply
if (isset($_POST['action']) && $_POST['action'] == 'deletereply') {
    $replyid = $_POST['dreplyid'];
    if (empty($replyid)) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
    } else {
        $stmt = $conn->prepare("DELETE FROM commentreply WHERE replyid = ?");
        $stmt->bind_param("s", $replyid);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
        } else {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-check-circle"></i> Reply deleted successfully']);
        }
    }
}

//Reply comment
if (isset($_POST['action']) && $_POST['action'] == 'replycomment') {

    $postid = $_POST['rpostid'];
    $commentid = $_POST['rcommentid'];
    $commentname = $_SESSION['username'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '$commentname'");
    $row = mysqli_fetch_array($sql);
    $commentemail = $row['email'];
    $commentpic = $row['profilepic'];
    $replycomment = trim(mysqli_real_escape_string($conn, $_POST['replycomment']));
    $commentdate = date("Y-m-d");
    $commentcount = 1;
    if (empty($replycomment)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
    } else {
        $stmt = $conn->prepare("INSERT INTO commentreply (postid, commentid, commentname, commentemail, commentpic, replycomment, commentcount, commentdate) 
			VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $postid, $commentid, $commentname, $commentemail, $commentpic, $replycomment, $commentcount, $commentdate);
        $query = $stmt->execute();
        if ($query == false) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Reply added successfully']);
        }
    }
}

//Update profile
if (isset($_POST['action']) && $_POST['action'] == 'updateprofile') {

    $fullname = trim(mysqli_real_escape_string($conn, $_POST['fullname']));
    $bio = trim($_POST['bio']);
    $question = trim(mysqli_real_escape_string($conn, isset($_POST['question']) ? $_POST['question'] : ''));
    $answer = trim(mysqli_real_escape_string($conn, $_POST['answer']));
    $facebook = filter_var(trim($_POST['facebook']), FILTER_SANITIZE_URL);
    $instagram = filter_var(trim($_POST['instagram']), FILTER_SANITIZE_URL);
    $twitter = filter_var(trim($_POST['twitter']), FILTER_SANITIZE_URL);
    $linkedin = filter_var(trim($_POST['linkedin']), FILTER_SANITIZE_URL);

    if (empty($fullname) || empty($bio) || empty($question) || empty($answer)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
    } else {
        $stmt = $conn->prepare("UPDATE users SET fullname = ?, bio = ?, question = ?, answer = ?, facebook = ?, instagram = ?, twitter = ?, linkedin = ? 
        WHERE username = '" . $_SESSION['username'] . "'");
        $stmt->bind_param("ssssssss", $fullname, $bio, $question, $answer, $facebook, $instagram, $twitter, $linkedin);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Profile updated successfully']);
        }
    }
}

//Update profile pic
if (isset($_POST['profilepicbtn'])) {

    $user = $_SESSION['username'];
    $filename = $_FILES['thumbnail']['name'];
    $tempname = $_FILES['thumbnail']['tmp_name'];
    $imgsize = $_FILES['thumbnail']['size'];
    $file_name_array = explode(".", $filename);
    $extension = end($file_name_array);
    $new_imagename = $user . '.' . $extension;
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
        $query = "UPDATE users SET profilepic = '$fileurl' WHERE username = '$user' AND active = 1";
        if (mysqli_query($conn, $query)) {
            $success = "Profile picture changed successfully";
            header("refresh:3;url=profile.php");
        } else {
            $error = "ERROR: Could not able to execute" . mysqli_error($conn);
        }
    }
}

//Unpublish all post
if (isset($_POST['action']) && $_POST['action'] == 'unpublishpost') {
    $user = $_SESSION['username'];
    $stmt = $conn->prepare("UPDATE blog SET listed = '0' WHERE author = ?");
    $stmt->bind_param("s", $user);
    if (!$stmt->execute()) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
    } else {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-check-circle"></i> Post unpublished successfully']);
    }
}

//Publish all post
if (isset($_POST['action']) && $_POST['action'] == 'publishpost') {
    $user = $_SESSION['username'];
    $stmt = $conn->prepare("UPDATE blog SET listed = '1' WHERE author = ?");
    $stmt->bind_param("s", $user);
    if (!$stmt->execute()) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
    } else {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-check-circle"></i> Post published successfully']);
    }
}

//Delete all post
if (isset($_POST['action']) && $_POST['action'] == 'deleteallpost') {
    $user = $_SESSION['username'];
    $stmt = $conn->prepare("DELETE FROM blog WHERE author = ?");
    $stmt->bind_param("s", $user);
    if (!$stmt->execute()) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
    } else {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-check-circle"></i> Blog deleted successfully']);
    }
}

//Delete my account
if (isset($_POST['action']) && $_POST['action'] == 'deleteaccount') {
    $user = $_SESSION['username'];
    $stmt = $conn->prepare("DELETE FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    if (!$stmt->execute()) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
    } else {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-check-circle"></i> Your account deleted successfully, Thank you for being with us']);
    }
}

//Update password
if (isset($_POST['action']) && $_POST['action'] == 'updatepassword') {

    $user = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    $fullname = $row['fullname'];
    $token = $row['token'];
    $email = $row['email'];
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $confirmpassword = trim(mysqli_real_escape_string($conn, $_POST['confirmpassword']));

    if (empty($password) || empty($confirmpassword)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> Please fill all the fields']);
    } elseif (strlen($password) < 6) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> Enter a strong password']);
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> No special characters allowed']);
    } elseif ($password != $confirmpassword) {
        echo json_encode(["status" => 4, "msg" => '<i class="fas fa-exclamation-circle"></i> Password do not match']);
    } else {
        $new_password = md5($password);
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
        $stmt->bind_param("ss", $new_password, $user);
        if (!$stmt->execute()) {
            echo json_encode(["status" => 5, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute' . mysqli_error($conn)]);
        } else {
            require '../mail/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->SMTPDebug = 0;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'farmanhafeezj@gmail.com';
            $mail->Password = 'ibhss3696';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('farmanhafeezj@gmail.com', 'BriefNow');
            $mail->addAddress($email, $fullname);
            $mail->addReplyTo('farmanhafeezj@gmail.com', 'BriefNow');
            $mail->isHTML(true);
            $mail->Subject = 'Account activity';
            $mail->Body    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <style>
                    body {
                        margin: 0;
                        font-family: sans-serif;
                        background-color: white;
                    } .container-fluid {
                        padding: 15px 0 15px 0;
                        background-color: #007bff;
                        background-image: linear-gradient(180deg, #007bff 10%, #224abe 100%);
                        background-size: cover;
                        border-radius: 6px;
                        overflow: hidden;
                    } .container {
                        width: 70%;
                        margin: 0 auto;
                    } @media screen and (max-width: 450px) { 
                        .container {
                            width: 90%;
                        }
                    } .card {
                        border-radius: 6px;
                        overflow: hidden;
                        background-color: white;
                        margin-bottom: 15px;
                    } .btn {
                        padding: 15px 25px 15px 25px;
                        background-color: #007bff;
                        color: white;
                        border: none;
                        font-size: 16px;
                        border-radius: 4px;
                        margin: 15px 0 15px 0;
                        cursor: pointer;
                    } .btn:hover {
                        background-color: #224abe;
                    } a {
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
                <div class="container-fluid">
                <div class="container">
                    <div class="card" style="background-color: #007bff;">
                        <div class="card-body" style="padding: 30px 0 30px 0;text-align: center;">
                            <h1 style="margin: 0;"><a href="http://localhost/BriefNow/homepage.php" style="text-decoration: none;color: white;font-size: 35px;">BRIEFNOW</a></h1>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="padding: 15px;text-align: center;">
                            <img src="https://image.freepik.com/free-vector/mobile-login-concept-illustration_114360-83.jpg" alt="Account verification" style="height: 250px;">
                            <h1 style="color: #007bff;font-size: 24px;letter-spacing: 2px;">Hi, ' . $fullname . '</h1>
                            <p style="line-height: 28px;color: #9e9e9e;">We encounter that you have updated your password recently.<br>
                                You are getting this email to let you know about the changes you made in your account.<br>
                                If this was not you, please update your password ASAP!</p>
                            <a href="http://localhost/BriefNow/updatepassword.php?token=' . $token . '">
                                <button class="btn">Change password</button></a>
                            <p style="font-size: 14px;color: #9e9e9e;">Or try using this link:</p>
                            <a href="http://localhost/BriefNow/updatepassword.php?token=' . $token . '" style="word-wrap: break-word;font-size: 14px;">
                                http://localhost/BriefNow/updatepassword.php?token=' . $token . '</a>
                        </div>
                        <div class="card-footer" style="padding: 15px;text-align: center;">
                            <p style="line-height: 25px;">If you have any questions or concerns, we are here to help you.<br>
                                <a href="http://localhost/BriefNow/contact.php">Contact Us</a></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="padding: 15px;text-align: center;color: #9e9e9e;font-size: 12px;">
                            <p style="line-height: 18px;">You received this email to let you know about important changes to your BriefNow Account and services. 
                                If you did not request to update password you can ignore this email or 
                                <a href="http://localhost/BriefNow/contact.php">Contact Us</a>
                            </p>
                            <p>&copy; 2020 | BRIEFNOW | All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
            </body>
            </html>';
            $mail->AltBody = "BrienNow
            Account activity
            Hi, $fullname
            We encounter that you have updated your password recently.
            You're getting this email to let you know about the changes in your account.
            If this wasn't you, please update your password ASAP!
            http://localhost/BriefNow/updatepassword.php?token=$token
            Regards,
            BrienNow
            © 2020 | BriefNow | All Rights Reserved.";

            if (!$mail->send()) {
                echo json_encode(["status" => 5, "msg" => '<i class="fas fa-exclamation-circle"></i> Email could not be sent']);
            } else {
                echo json_encode(["status" => 6, "msg" => '<i class="fas fa-check-circle"></i> Password changed successfully']);
            }
        }
    }
}

mysqli_close($conn);
