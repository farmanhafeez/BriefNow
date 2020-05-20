<?php

session_start();

require 'dbconfig.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

    <!---------- HEADER ---------->

    <div class="header" id="header">
        <nav class="navbar navbar-expand-md navbar-light justify-content-center" style="background-color:transparent;">
            <a class="navbar-brand" href="./">
                <img src="img/favicon-32x32.png" class="d-inline-block align-top" alt="Logo">
                <span class="align-top">BriefNow</span>
            </a>
        </nav>
    </div>

    <!---------- CONTAINER ---------->

    <div class="container d-flex align-items-center pb-5" style="min-height: 80vh;">
        <div class="card bg-white border-0 box-shadow w-100">
            <div class="row align-items-center" style="min-height: 80vh;">
                <div class="col-md-7 d-md-block d-none">
                    <div class="card-body">
                        <img src="img/login.svg" alt="login image" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <h2 class="section-heading text-center mb-3">Welcome Back!</h2>
                        <p class="text-muted text-center mb-4">To keep connected with us please login with your personal info</p>

                        <div class="alert alert-danger" id="alert" role="alert" style="display: none;border-radius: 25px;">
                            <div id="error-result" class="small"></div>
                        </div>

                        <form id="login-form" action="" method="POST" autocomplete="off" class="needs-validation" novalidate>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" style="border-radius: 20px;" required />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" style="border-radius: 20px;" required />
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="remember" value="remember">
                                    <label class="custom-control-label" for="customCheck1">Remember me?</label>
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <a href="#" class="text-primary" data-toggle="modal" data-target="#passwordmodal">Forgot your password?</a>
                            </div>
                            <span class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary mb-4 w-50" style="border-radius: 20px;" id="loginbtn">
                                    <div class="btn-text">Login</div>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                </button>
                            </span>
                        </form>
                        <div class="text-center">
                            <a href="signup.php" class="text-primary">Create your account!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Forgot password -->

    <div class="modal fade" id="passwordmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterTitle">Forgot password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" id="alert1" style="display: none">
                        <div id="error-result1" class="small"></div>
                    </div>
                    <div class="alert alert-success" role="alert" id="success1" style="display: none">
                        <div id="success-result1" class="small"></div>
                    </div>
                    <div class="modal-text">Enter your registered email address</div>

                    <form id="forgot-password" action="" role="form" method="POST" autocomplete="off">
                        <div class="form-group mt-3 mb-4">
                            <input type="email" class="form-control" placeholder="Email" name="email" />
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary w-50" id="forgotbtn">
                                <div class="btn-text1">Send email</div>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader1" style="display: none;"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Already logged in -->

    <?php if (isset($_SESSION['username'])) { ?>
        <div class="modal fade" id="loggedin" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="staticBackdropLabel"><i class="fas fa-exclamation-circle"></i> Already logged in</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">Looks like you are already logged in, please go back or logout to login with different account!</p>
                        <?php
                        if (isset($_SESSION['url'])) { ?>
                            <a href="<?= $_SESSION['url']; ?>"><button class="btn btn-primary">Go back</button></a>
                        <?php } else { ?>
                            <a href="./"><button class="btn btn-primary">Go back</button></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!--------------- JAVASCRIPT CODE --------------->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <?php if (isset($_SESSION['username'])) { ?>
        <script>
            $(document).ready(function() {
                $("#loggedin").modal('show');
            });
        </script>
    <?php } ?>

    <!-- LOGIN -->
    <script type="text/javascript">
        $(document).ready(function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                $('#loginbtn').click(function(event) {
                    event.preventDefault();
                    $('.btn-text').hide();
                    $('#loader').show();
                    $('#alert').hide();
                    var formData = $('#login-form').serialize();
                    console.log(formData);
                    $.ajax({
                        url: 'register.php',
                        method: 'post',
                        data: formData + '&action=login'
                    }).done(function(result) {
                        console.log(result);
                        var data = JSON.parse(result);
                        if (data.status == 1 || data.status == 2 || data.status == 3 || data.status == 4) {
                            setTimeout(function() {
                                $('#loader').hide();
                                $('.btn-text').show();
                                $('#alert').show();
                                $('#error-result').html(data.msg);
                            }, 1000);
                        } else if (data.status == 5 || data.status == 6) {
                            setTimeout(function() {
                                document.location.href = data.msg;
                            }, 2000);
                        } else if (data.status == 7) {
                            setTimeout(function() {
                                document.location.href = "./";
                            }, 2000);
                        }
                    })
                    form.classList.add('was-validated');
                })
            });
        })
    </script>

    <!-- FORGOT PASSWORD -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#forgotbtn').click(function(event) {
                event.preventDefault();
                $('.btn-text1').hide();
                $('#loader1').show();
                $('#alert1').hide();
                $('#success1').hide();
                var formData = $('#forgot-password').serialize();
                console.log(formData);
                $.ajax({
                    url: 'register.php',
                    method: 'post',
                    data: formData + '&action=forgotpassword'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1 || data.status == 2 || data.status == 3 || data.status == 4 || data.status == 6) {
                        setTimeout(function() {
                            $('#loader1').hide();
                            $('.btn-text1').show();
                            $('#alert1').show();
                            $('#error-result1').html(data.msg);
                        }, 1000)
                    } else if (data.status == 5) {
                        $('#loader1').hide();
                        $('.btn-text1').show();
                        $('#success1').show();
                        $('#success-result1').html(data.msg);
                    }
                })
            })
        })
    </script>

</body>

</html>