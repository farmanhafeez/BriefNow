<?php

session_start();

require 'dbconfig.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Register</title>
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
                        <h2 class="section-heading text-center mb-3">Create account</h2>
                        <p class="text-muted text-center mb-5">Enter your personal details and start journey with us</p>

                        <div class="alert alert-danger" role="alert" id="alert" style="display: none;border-radius: 25px;">
                            <div id="error-result" class="small"></div>
                        </div>
                        <div class="alert alert-success" role="alert" id="success" style="display: none;border-radius: 25px;">
                            <div id="success-result" class="small"></div>
                        </div>

                        <form id="signup-form" action="" role="form" method="POST" autocomplete="off" class="needs-validation" novalidate>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Full Name" name="fullname" style="border-radius: 20px;" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Username" name="username" style="border-radius: 20px;" required />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" style="border-radius: 20px;" required />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" style="border-radius: 20px;" required />
                            </div>
                            <span class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary my-3 w-50" style="border-radius: 20px;" id="signupbtn">
                                    <div class="btn-text">Register</div>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                </button>
                            </span>
                        </form>
                        <div class="text-center">
                            Already have account? <a href="login.php" class="text-primary">Login</a>
                        </div>
                    </div>
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

    <!-- SIGNUP -->
    <script type="text/javascript">
        $(document).ready(function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                $('#signupbtn').click(function(event) {
                    event.preventDefault();
                    $('.btn-text').hide();
                    $('#loader').show();
                    $('#alert').hide();
                    $('#success').hide();
                    var formData = $('#signup-form').serialize();
                    console.log(formData);
                    $.ajax({
                        url: 'register.php',
                        method: 'post',
                        data: formData + '&action=signup'
                    }).done(function(result) {
                        console.log(result);
                        var data = JSON.parse(result);
                        if (data.status == 1 || data.status == 2 || data.status == 3 || data.status == 4 || data.status == 5 || data.status == 6 ||
                            data.status == 7 || data.status == 8 || data.status == 9 || data.status == 11 || data.status == 12) {
                            setTimeout(function() {
                                $('#loader').hide();
                                $('.btn-text').show();
                                $('#alert').show();
                                $('#error-result').html(data.msg);
                            }, 1000)
                        } else if (data.status == 10) {
                            $('#loader').hide();
                            $('.btn-text').show();
                            $('#success').show();
                            $('#success-result').html(data.msg);
                        }
                    })
                    form.classList.add('was-validated');
                })
            });
        })
    </script>

</body>

</html>