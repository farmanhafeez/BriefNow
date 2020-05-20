<?php

require '../dbconfig.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link href="../css/style.css" rel="stylesheet" />
</head>

<body class="bg-light">

    <!---------- HEADER ---------->

    <div class="header" id="header">
        <nav class="navbar navbar-expand-md navbar-light justify-content-center" style="background-color:transparent;">
            <a class="navbar-brand" href="../">
                <img src="../img/favicon-32x32.png" class="d-inline-block align-top" alt="Logo">
                <span class="align-top">BriefNow</span>
            </a>
        </nav>
    </div>

    <!---------- CONTAINER ---------->

    <div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="col-md-5">
            <div class="card bg-white border-0 box-shadow">
                <div class="card-body">
                    <h2 class="section-heading text-center mt-3 mb-5">Login</h2>
                    <div class="alert alert-danger" id="alert" role="alert" style="display: none">
                        <div id="result" class="small"></div>
                    </div>
                    <form id="login-form" action="" role="form" method="POST" autocomplete="off">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" />
                        </div>
                        <span class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mt-3 mb-5 w-50" id="loginbtn">
                                <div class="btn-text">Login</div>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                            </button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tokenModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Login verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" id="alert1" style="display: none">
                        <div id="result1" class="small"></div>
                    </div>
                    <div class="alert alert-success" role="alert" id="success1" style="display: none">
                        <div id="successresult1" class="small"></div>
                    </div>
                    <p>Enter your verification pin that has been send to your email</p>
                    <form action="" method="post" id="login-verification">
                        <input type="hidden" name="email" id="verification-email">
                        <div class="form-group">
                            <input type="text" class="form-control" name="token" id="token" placeholder="Pin">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="verification-btn">Verify
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader1" style="display: none;"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- LOGIN -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#loginbtn').click(function(event) {
                var email = $('#email').val();
                console.log(email);
                $('#verification-email').val(email);
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
                    if (data.status == 1 || data.status == 2 || data.status == 3 || data.status == 4 || data.status == 5) {
                        setTimeout(function() {
                            $('.btn-text').show();
                            $('#loader').hide();
                            $('#alert').show();
                            $('#result').html(data.msg);
                        }, 1000);
                    } else if (data.status == 6) {
                        $('.btn-text').show();
                        $('#loader').hide();
                        $('#tokenModal').modal('show');
                    }
                })
            })

            //Login verification
            $('#verification-btn').click(function(event) {
                event.preventDefault();
                $('#loader1').show();
                var formData = $('#login-verification').serialize();
                console.log(formData);
                $.ajax({
                    url: 'register.php',
                    method: 'post',
                    data: formData + '&action=loginverification'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1 || data.status == 2) {
                        setTimeout(function() {
                            $('#loader1').hide();
                            $('#alert1').show();
                            $('#result1').html(data.msg);
                        }, 1000);
                    } else if (data.status == 3) {
                        setTimeout(function() {
                            $('#alert1').hide();
                            $('#success1').show();
                            $('#successresult1').html(data.msg);
                        }, 1000);
                        setTimeout(function() {
                            $('#loader1').hide();
                            document.location.href = "dashboard.php";
                        }, 3000);
                    }
                })
            })
        })
    </script>

</body>

</html>