<?php

require '../dbconfig.php';

session_start();

// LOGIN USER
if (isset($_POST['action']) && $_POST['action'] == 'login') {

    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));
    $new_password = md5($password);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    if (empty($email) || empty($password)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> Please fill all the fields']);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> Enter valid email']);
    } elseif ($row['email'] != $email || $row['password'] != $new_password) {
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-exclamation-circle"></i> Email/Password does not match']);
    } else {
        $query = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
        $query->bind_param("ss", $email, $new_password);
        $query->execute();
        $result1 = $query->get_result();
        if ($result1->num_rows == 1) {
            $row1 = $result1->fetch_array();

            //Generates random alphanumeric token
            function random_strings($length_of_string)
            {
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                return substr(str_shuffle($str_result), 0, $length_of_string);
            }
            $token = random_strings(10);

            //Insert the token in admin table
            $insert = $conn->prepare("UPDATE admin SET token = ? WHERE email = ? AND password = ?");
            $insert->bind_param("sss", $token, $email, $new_password);
            $insert->execute();

            require '../vendor/mail/PHPMailerAutoload.php';
            $mail = new PHPMailer;
            $mail->SMTPDebug = 0;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'backend.emailservices@gmail.com';
            $mail->Password = 'qwerty123@';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('farmanhafeezj@gmail.com', 'BriefNow');
            $mail->addAddress($email, $row1['fullname']);
            $mail->addReplyTo('farmanhafeezj@gmail.com', 'BriefNow');
            $mail->isHTML(true);
            $mail->Subject = 'Login verification';
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
                    }
                    .container-fluid {
                        padding: 15px 0 15px 0;
                        background-color: #007bff;
                        background-image: linear-gradient(180deg, #007bff 10%, #224abe 100%);
                        background-size: cover;
                        border-radius: 6px;
                        overflow: hidden;
                    }
                    .container {
                        width: 70%;
                        margin: 0 auto;
                    }
                    @media screen and (max-width: 450px) { 
                        .container {
                            width: 90%;
                        }
                    }
                    .card {
                        border-radius: 6px;
                        overflow: hidden;
                        background-color: white;
                        margin-bottom: 15px;
                    }
                    .btn {
                        padding: 15px 25px 15px 25px;
                        background-color: #007bff;
                        color: white;
                        border: none;
                        font-size: 16px;
                        border-radius: 4px;
                        margin: 15px 0 15px 0;
                        cursor: pointer;
                    }
                    .btn:hover {
                        background-color: #224abe;
                    }
                    a {
                        text-decoration: none;
                    }
                </style>
            </head>
            <body>
                <div class="container-fluid">
                <div class="container">
                    <div class="card" style="background-color: #007bff;">
                        <div class="card-body" style="padding: 30px 0 30px 0;text-align: center;">
                            <h1 style="margin: 0;"><a href="http://localhost/BriefNow/" style="text-decoration: none;color: white;font-size: 35px;">BRIEFNOW</a></h1>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="padding: 15px;text-align: center;">
                            <img src="https://image.freepik.com/free-vector/secure-data-concept-illustration_114360-343.jpg" alt="Account verification" style="height: 250px;">
                            <h1 style="color: #007bff;font-size: 24px;letter-spacing: 2px;">Login verification</h1>
                            <p style="line-height: 28px;color: #9e9e9e;">Verification code for your login form</p>
                            <h3 style="margin: 40px 0 40px 0;"><a style="padding: 10px;border: 1px solid #9e9e9e;border-radius: 6px;color: #9e9e9e;letter-spacing: 3px;">' . $token . '</a></h3>
                            <p style="line-height: 28px;color: #9e9e9e;">All you have to do is copy the verification code and paste 
                            it to your form to complete the login verification process</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body" style="padding: 15px;text-align: center;color: #9e9e9e;font-size: 12px;">
                            <p style="line-height: 18px;">You received this email because you tried to login for admin panel. 
                                If you did not request to login you can ignore this email or 
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
            Login verification
            Please enter this verification pin in the modal box to login
      $token
      Regards,
      BrienNow
      © 2020 | BriefNow | All Rights Reserved.";

            if (!$mail->send()) {
                echo json_encode(["status" => 5, "msg" => '<i class="fas fa-exclamation-circle"></i> Email could not be sent']);
            } else {
                echo json_encode(["status" => 6, "msg" => '<i class="fas fa-check-circle"></i> Email has been sent']);
            }
        } else {
            echo json_encode(["status" => 4, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute!']);
        }
    }
}

//Login verification
if (isset($_POST['action']) && $_POST['action'] == 'loginverification') {

    $email = $_POST['email'];
    $token = trim(mysqli_real_escape_string($conn, $_POST['token']));

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_array();

    if (empty($token)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> Please enter your pin']);
    } elseif ($row['token'] != $token) {
        echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> ERROR: Could not able to execute!']);
    } else {
        $_SESSION['username'] = $row['username'];
        $_SESSION['token'] = $row['token'];
        echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> SUCCESS: You will be redirect to admin dashboard']);
    }
}

//Send email
if (isset($_POST['action']) && $_POST['action'] == 'sendemail') {
    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $subject = trim(mysqli_real_escape_string($conn, $_POST['subject']));
    $message = $_POST['message'];

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(["status" => 1, "msg" => '<i class="fas fa-exclamation-circle"></i> All the fields are required!']);
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
        $mail->addAddress($email, $name);
        $mail->addReplyTo('farmanhafeezj@gmail.com', 'BriefNow');
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message;

        if (!$mail->send()) {
            echo json_encode(["status" => 2, "msg" => '<i class="fas fa-exclamation-circle"></i> Email could not be sent']);
        } else {
            echo json_encode(["status" => 3, "msg" => '<i class="fas fa-check-circle"></i> Email has been sent']);
        }
    }
}
