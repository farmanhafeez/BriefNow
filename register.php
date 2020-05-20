<?php require('dbconfig.php'); ?>
<?php
session_start();

$fullname = "";
$username = "";
$email    = "";
$password = "";
$bio = "";
$question = "";
$answer = "";
$error = "";
$success = "";

// REGISTRATION
if (isset($_POST['action']) && $_POST['action'] == 'signup') {

    $fullname = filter_var(trim($_POST['fullname']),FILTER_SANITIZE_STRING);
    $username = filter_var(trim($_POST['username']),FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
    $password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
    $active = 0;
    $token = md5(uniqid(rand(), true));
    $profilepic = "img/apple-touch-icon.png";

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $fullname)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> Fullname can contain only letters']);
    } elseif (!preg_match("/^[a-zA-Z]*$/", $username)) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> Username can contain only letters']);
    } elseif (!preg_match("/^[a-z]+$/", $username)) {
        echo json_encode(["status" => 4, "msg" => '<i class="fas fa-exclamation-circle"></i> Username should be in lowercase']);
    } elseif ($row['username'] === $username) {
        echo json_encode(["status" => 5, "msg" => '<i class="fas fa-exclamation-circle"></i> Username already exists']);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => 6, "msg" => '<i class="fas fa-exclamation-circle"></i> Enter valid Email ID']);
    } elseif ($row['email'] === $email) {
        echo json_encode(["status" => 7, "msg" => '<i class="fas fa-exclamation-circle"></i> Email already exists']);
    } elseif (strlen($password) < 6) {
        echo json_encode(["status" => 8, "msg" => '<i class="fas fa-exclamation-circle"></i> Enter a strong password']);
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
        echo json_encode(["status" => 9, "msg" => '<i class="fas fa-exclamation-circle"></i> No special characters allowed in password']);
    } else {
        $new_password = md5($password);
        $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password, active, token, profilepic) 
              VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssss", $fullname, $username, $email, $new_password, $active, $token, $profilepic);

        require 'vendor/mail/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        $mail->SMTPDebug = 0;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'backend.emailservices@gmail.com';
        $mail->Password = 'qwerty123@';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('backend.emailservices@gmail.com', 'BriefNow');
        $mail->addAddress($email, $fullname);
        $mail->addReplyTo('backend.emailservices@gmail.com', 'BriefNow');
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Email Address';
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
                            <h1 style="margin: 0;"><a href="http://localhost/BriefNow/index.php" style="text-decoration: none;color: white;font-size: 35px;">BRIEFNOW</a></h1>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="padding: 15px;text-align: center;">
                            <img src="https://image.freepik.com/free-vector/security-concept-illustration_114360-417.jpg" alt="Account verification" style="height: 250px;">
                            <h1 style="color: #007bff;font-size: 24px;letter-spacing: 2px;">Hi, ' . $fullname . '</h1>
                            <p style="line-height: 28px;color: #9e9e9e;">Thank you for creating an account with BriefNow.<br>
                                Before we get started, Please click the button below to verify your email address.</p>
                            <a href="http://localhost/BriefNow/index.php?token=' . $token . '">
                                <button class="btn">Verify account</button></a>
                            <p style="font-size: 14px;color: #9e9e9e;">Or verify using this link:</p>
                            <a href="http://localhost/BriefNow/index.php?token=' . $token . '" style="word-wrap: break-word;font-size: 14px;">
                                http://localhost/BriefNow/index.php?token=' . $token . '</a>
                        </div>
                        <div class="card-footer" style="padding: 15px;text-align: center;">
                            <p style="line-height: 25px;">If you have any questions or concerns, we are here to help you.<br>
                                <a href="http://localhost/BriefNow/contact.php">Contact Us</a></p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="padding: 15px;text-align: center;color: #9e9e9e;font-size: 12px;">
                            <p style="line-height: 18px;">You received this email because you created an account on BriefNow. 
                                If you did not request to create account you can ignore this email or 
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
      Verify Your Email Address
      Thanks for creating an account. Please follow the link below to verify your email address.
      http://localhost/BriefNow/index.php?token=$token
      Regards,
      BrienNow
      © 2020 | BriefNow | All Rights Reserved.";

        if ($mail->send()) {
            if ($stmt->execute()) {
                echo json_encode(["status" => 10, "msg" => '<i class="fas fa-check-circle"></i> Please check your email to verify your account']);
            } else {
                echo json_encode(["status" => 11, "msg" => '<i class="fas fa-exclamation-circle"></i> Something went wrong, please try again']);
            }
        } else {
            echo json_encode(["status" => 12, "msg" => '<i class="fas fa-exclamation-circle"></i> Email could not be sent']);
        }
    }
}

// LOGIN USER
if (isset($_POST['action']) && $_POST['action'] == 'login') {

    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $new_password = md5($password);
    $remember = isset($_POST['remember']) ? $_POST['remember'] : '';

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> Enter valid email']);
    } elseif ($row['email'] != $email || $row['password'] != $new_password) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> Email/Password does not match']);
    } else {
        $query = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND active = '1'");
        $query->bind_param("ss", $email, $new_password);
        $query->execute();
        $result1 = $query->get_result();
        if ($result1->num_rows == 1) {
            $row1 = $result1->fetch_array();
            $_SESSION['username'] = $row1['username'];

            // Remember me option
            if ($remember == 'remember') {
                function random_strings($length_of_string)
                {
                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                    return substr(str_shuffle($str_result), 0, $length_of_string);
                }
                $token = random_strings(10);
                $insert = $conn->prepare("UPDATE users SET active_token = ? WHERE id = ?");
                $insert->bind_param("ss", $token, $row1['id']);
                if ($insert->execute()) {
                    setcookie("remember_me", $token, strtotime('+30 days'));
                }
            }

            if (isset($_SESSION['login_redirect'])) {
                $redirecturl = $_SESSION['login_redirect'];
                echo json_encode(["status" => 5, "msg" => $redirecturl]);
                unset($_SESSION["login_redirect"]);
            } else if (isset($_SESSION['url'])) {
                $url = $_SESSION['url'];
                echo json_encode(["status" => 6, "msg" => $url]);
            } else {
                echo json_encode(["status" => 7, "msg" => "./"]);
            }
            exit;
        } else {
            echo json_encode(["status" => 4, "msg" => '<i class="fas fa-exclamation-circle"></i> Your account is not activated yet, please check your email to activate your account!']);
        }
    }
}

// FORGOT PASSWORD
if (isset($_POST['action']) && $_POST['action'] == 'forgotpassword') {

    $email = filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND active = 1 LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    $token = $row['token'];

    if (empty($email)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> Email ID is required']);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> Enter valid email ID']);
    } elseif ($result->num_rows == 0) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> Email ID does not exist / You did not activate your account']);
    } else {
        require 'vendor/mail/PHPMailerAutoload.php';

        $mail = new PHPMailer;

        $mail->SMTPDebug = 0;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'backend.emailservices@gmail.com';
        $mail->Password = 'qwerty123@';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('backend.emailservices@gmail.com', 'BriefNow');
        $mail->addAddress($row['email']);
        $mail->addReplyTo('backend.emailservices@gmail.com', 'BriefNow');
        $mail->isHTML(true);

        $mail->Subject = 'Password recovery';
        $mail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                        <h1 style="margin: 0;"><a href="http://localhost/BriefNow/index.php" style="text-decoration: none;color: white;font-size: 35px;">BRIEFNOW</a></h1>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body" style="padding: 15px;text-align: center;">
                        <img src="https://image.freepik.com/free-vector/forgot-password-concept-illustration_114360-1123.jpg" alt="Forgot password" style="height: 250px;">
                        <h1 style="color: #007bff;font-size: 24px;">Forgot your password?</h1>
                        <p style="line-height: 25px;color: #9e9e9e;">Resetting your password is easy.<br>Just press the button below and follow the instructions.</p>
                        <a href="http://localhost/BriefNow/updatepassword.php?token=' . $token . '">
                            <button class="btn">Reset password</button></a>
                        <p style="font-size: 14px;color: #9e9e9e;">Or verify using this link:</p>
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
                        <p style="line-height: 18px;">You received this email because we received a request to reset password
                            for your account. If you did not request to reset password you can ignore this email or 
                            <a href="http://localhost/BriefNow/contact.php">Contact Us</a></p>
                        <p>&copy; 2020 | BRIEFNOW | All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>';
        $mail->AltBody = "BrienNow
        Update your password
        Please follow the link below to update your password.
        http://localhost/BriefNow/updatepassword.php?token=$token
        Regards,
        BrienNow
        © 2020 | BriefNow | All Rights Reserved.";

        if (!$mail->send()) {
            echo json_encode(["status" => 4, "msg" => '<i class="fas fa-exclamation-circle"></i> Email could not be sent']);
        } else {
            echo json_encode(["status" => 5, "msg" => '<i class="fas fa-check-circle"></i> Please check your email']);
        }
    }
}

// UPDATE PASSWORD
if (isset($_POST['action']) && $_POST['action'] == 'updatepassword') {

    $token = isset($_POST['token']) ? $_POST['token'] : '';
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $question = trim(mysqli_real_escape_string($conn, isset($_POST['question']) ? $_POST['question'] : ''));
    $answer = trim(mysqli_real_escape_string($conn, $_POST['answer']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

    $stmt = $conn->prepare("SELECT * FROM users WHERE token = ? AND active = 1");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    if (empty($email) || empty($question) || empty($answer) || empty($password)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required']);
    } elseif ($email != $row['email']) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> Email ID does not match / You did not activate your account']);
    } elseif ($question != $row['question'] || strtolower($answer) != strtolower($row['answer'])) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> Question and Answer pair does not match']);
    } elseif (strlen($password) < 6) {
        echo json_encode(["status" => 4, "msg" => '<i class="fas fa-exclamation-circle"></i> Enter a strong password']);
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
        echo json_encode(["status" => 5, "msg" => '<i class="fas fa-exclamation-circle"></i> No special characters allowed']);
    } else {
        $new_password = md5($password);
        $query = $conn->prepare("UPDATE users SET password = ? WHERE token = ? AND active = 1");
        $query->bind_param("ss", $new_password, $token);
        if ($query->execute()) {
            echo json_encode(["status" => 6, "msg" => '<i class="fas fa-check-circle"></i> Password updated successfully']);
        } else {
            echo json_encode(["status" => 7, "msg" => '<i class="fas fa-exclamation-circle"></i> Something went wrong!']);
        }
    }
}

// COMPLETE PROFILE
if (isset($_POST['update_btn'])) {

    $user = $_SESSION['username'];
    $filename = $_FILES['thumbnail']['name'];
    $tempname = $_FILES['thumbnail']['tmp_name'];
    $imgsize = $_FILES['thumbnail']['size'];
    $file_name_array = explode(".", $filename);
    $extension = end($file_name_array);
    $new_imagename = $user . '.' . $extension;
    $allowed_extension = array("jpg", "gif", "png", "jpeg");
    $maxsize    = 2097152;
    $bio = filter_var(trim($_POST['bio']), FILTER_SANITIZE_STRING);
    $question = trim(mysqli_real_escape_string($conn, isset($_POST['question']) ? $_POST['question'] : ''));
    $answer = trim(mysqli_real_escape_string($conn, $_POST['answer']));

    if (empty($filename) || empty($bio) || empty($question) || empty($answer)) {
        $error = "Please fill all the fields";
    } elseif (!in_array($extension, $allowed_extension)) {
        $error = "Please select png or jpg or jpeg or gif format";
    } elseif ($imgsize >= $maxsize || $imgsize == 0) {
        $error = "Image size should be less than or equal to 2MB";
    } else {
        $filelocation = 'upload/' . $new_imagename;
        move_uploaded_file($tempname, $filelocation);
        $query = $conn->prepare("UPDATE users SET profilepic = ?, bio = ?, question = ?, answer = ? WHERE username = ? AND active = 1");
        $query->bind_param("sssss", $filelocation, $bio, $question, $answer, $user);
        if ($query->execute()) {
            $success = "Information updated successfully";
        } else {
            $error = "Something wrong in updating, please check whether your account is active or not";
        }
    }
}
