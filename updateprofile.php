<?php

require 'dbconfig.php';
require 'register.php';

//if a user is not logedin, then he will be redirected to login page
if (!isset($_SESSION['username'])) {
    $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Complete your profile</title>
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

    <div class="container d-flex align-items-center justify-content-center pb-5" style="min-height: 80vh;">
        <div class="card bg-white border-0 box-shadow">
            <h4 class="card-header">Complete your profile</h4>
            <div class="card-body">
                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger small" role="alert" id="alert">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                <?php } ?>
                <?php if (!empty($success)) { ?>
                    <div class="alert alert-success small" role="alert" id="success">
                        <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                    </div>
                <?php } ?>

                <form action="updateprofile.php" method="POST" enctype="multipart/form-data" autocomplete="off" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="customfile">Profile picture:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="thumbnail" id="customFile customfile" required>
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <small class="form-text text-muted">Image size should be less than 2MB and only png, jpg, gif, jpeg is supported</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Bio
                            <span class="small" data-toggle="tooltip" data-placement="right" title="Add bio from 100 to 200 character long">
                                <i class="far fa-question-circle"></i></span>
                        </label>
                        <textarea class="form-control" id="message-text" name="bio" rows="4" minlength="100" maxlength="200" required><?php echo $bio; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="selectmenu">Select a security question
                            <span class="small" data-toggle="tooltip" data-placement="right" title="To protect your identity and your account, it is important to set secret question and answer pair">
                                <i class="far fa-question-circle"></i></span>
                        </label>
                        <select class="custom-select" id="selectmenu" name="question" required>
                            <option selected disabled value="">Open this select menu</option>
                            <option value="1">In what county were you born?</option>
                            <option value="2">What is your oldest cousin’s first name?</option>
                            <option value="3">What is the title of your favorite song?</option>
                            <option value="4">In what city or town you finished your school or college?</option>
                            <option value="5">What was your childhood nickname?</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer:</label>
                        <input class="form-control" type="text" id="answer" name="answer" value="<?php echo $answer; ?>" required>
                    </div>

                    <div class="text-right">
                        <a href="./">
                            <button type="button" class="btn btn-outline-dark">
                                <?php if (empty($success)) { ?>
                                    Skip for now
                                <?php } else { ?>
                                    Home
                                <?php } ?>
                            </button>
                        </a>
                        <button type="submit" class="btn btn-primary" name="update_btn" id="update-btn">
                            <div class="btn-text">Update</div>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--------------- JAVASCRIPT CODE --------------->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()
        })
    </script>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script>
        $(document).ready(function() {
            $('#update-btn').click(function() {
                $('.btn-text').hide();
                $('#loader').show();
            })
        })
    </script>

</body>

</html>