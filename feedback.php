<?php

require 'dbconfig.php';
require 'session.php';
include 'footer.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Feedback</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <a href="#" class="back-to-top"><i class="fas fa-angle-double-up"></i></a>

    <!---------- NAVBAR ---------->

    <?php navbar(); ?>

    <!---------- HEADER ---------->

    <div class="hero-section" style="height: 70vh;background: 
		linear-gradient(to right,rgba(39, 70, 133, 0.9) 0%,rgba(61, 179, 197, 0.9) 100%),url('../img/hero-bg.jpg');">
        <div class="wave">
            <svg width="100%" height="250px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                        <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
                    </g>
                </g>
            </svg>
        </div>
        <div class="inner-page d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row m-0">
                    <div class="col-12 text-center px-0">
                        <h1 class="text-capitalize">Feedback</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---------- CONTAINER ---------->

    <div class="first-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="section-heading mb-2">Feedback form</h2>
                    <p class="text-muted mb-4">Help us improve our service by filling the form below...</p>
                    <div class="alert alert-danger" role="alert" id="error" style="display: none">
                        <div id="errorresult" class="small"></div>
                    </div>
                    <div class="alert alert-success" role="alert" id="success" style="display: none">
                        <div id="successresult" class="small"></div>
                    </div>
                    <form method="post" action="" id="feedback-form" class="needs-validation" novalidate autocomplete="off">
                        <?php if (!isset($_SESSION['username'])) : ?>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="feedname">Name <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="Name" name="feedname" id="feedname" required />
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="feedemail">Email <span style="color: red;">*</span></label>
                                    <input type="email" class="form-control" placeholder="Email" name="feedemail" id="feedemail" required />
                                </div>
                            </div>
                        <?php endif ?>

                        <div class="form-group">
                            <label for="feedmessage">Please provide your feedback <span style="color: red;">*</span></label>
                            <textarea rows="6" class="form-control" id="feedmessage" placeholder="Feedback" name="feedmessage" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>How do you rate our overall service? <span style="color: red;">*</span></label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio1" name="experience" value="Bad" class="custom-control-input" required>
                                <label class="custom-control-label" for="customRadio1">Bad</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio2" name="experience" value="Average" class="custom-control-input" required>
                                <label class="custom-control-label" for="customRadio2">Average</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadio3" name="experience" value="Good" class="custom-control-input" required>
                                <label class="custom-control-label" for="customRadio3">Good</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary" id="feedback-btn">
                            <div class="btn-text">Submit</div>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                        </button>
                    </form>
                    <span class="form-text text-danger mt-3 small">Fields marked as * are mandatory fields</span>
                </div>
            </div>
        </div>
    </div>

    <!---------- FOOTER ---------->

    <?php footer(); ?>

    <!--------------- JAVASCRIPT CODE --------------->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

    <script src="../js/main.js"></script>

    <!-- Newsletter Ajax code -->
    <?php scriptCode(); ?>

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init()
        })
    </script>

    <script>
        $(document).ready(function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                $('#feedback-btn').click(function(event) {
                    event.preventDefault();
                    $('.btn-text').hide();
                    $('#loader').show();
                    $('#error').hide();
                    $('#success').hide();
                    var formData = $('#feedback-form').serialize();
                    console.log(formData);
                    $.ajax({
                        url: '../query.php',
                        method: 'post',
                        data: formData + '&action=feedbackresponse'
                    }).done(function(result) {
                        console.log(result);
                        var data = JSON.parse(result);
                        if (data.status == 1 || data.status == 2) {
                            setTimeout(function() {
                                $('.btn-text').show();
                                $('#loader').hide();
                                $('#error').show();
                                $('#errorresult').html(data.msg);
                            }, 1000)
                        } else if (data.status == 3) {
                            setTimeout(function() {
                                $('.btn-text').show();
                                $('#loader').hide();
                                $('#success').show();
                                $('#successresult').html(data.msg);
                                $("#feedback-form")[0].reset();
                            }, 1000)
                        }
                    })
                    form.classList.add('was-validated');
                })
            });
        })
    </script>

</body>

</html>