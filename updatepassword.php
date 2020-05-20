<?php

require 'dbconfig.php';

$token = isset($_GET['token']) ? $_GET['token'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Update password</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="manifest" href="img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link href="vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLongTitle">Update password</h4>
                </div>
                <div class="modal-body">

                    <?php
                    if (empty($token)) { ?>
                        <div class="alert alert-danger small" role="alert" id="alert">
                            <i class="fas fa-exclamation-circle"></i> You cannot access this page without token ID!
                        </div>
                        <?php } else {
                        $session = $conn->prepare("SELECT * FROM users WHERE token = ?");
                        $session->bind_param("s", $token);
                        $session->execute();
                        $result = $session->get_result();
                        if ($result->num_rows == 1) { ?>
                            <p class="small"><b>Note:</b> You cannot update password without setting the security question and answer previously. If you have not added, please
                                <a href="contact.php">Contact us</a> to update your password
                            </p>
                            <div class="alert alert-danger" role="alert" id="alert" style="display: none">
                                <div id="result" class="small"></div>
                            </div>
                            <div class="alert alert-success" role="alert" id="success" style="display: none">
                                <div id="successresult" class="small"></div>
                            </div>

                            <form action="updatepassword.php" method="POST" id="update-password" autocomplete="off">
                                <input type="hidden" name="token" value="<?php echo $token; ?>">
                                <div class="form-group">
                                    <label for="emailForm">Email</label>
                                    <input type="email" name="email" class="form-control" id="emailForm" placeholder="Email">
                                </div>

                                <div class="form-group">
                                    <label for="selectmenu">Select a security question
                                        <span class="small" data-toggle="tooltip" data-placement="right" title="To protect your identity and your account, it is important to set secret question and answer pair"><i class="far fa-question-circle"></i></span>
                                    </label>
                                    <select class="custom-select" id="selectmenu" name="question">
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
                                    <input class="form-control" type="text" id="answer" name="answer">
                                </div>

                                <div class="form-group">
                                    <label for="new-password">New password</label>
                                    <input class="form-control" type="password" id="new-password" name="password">
                                </div>

                                <div class="text-right">
                                    <a href="homepage.php"><button type="button" class="btn btn-outline-dark">Home</button></a>
                                    <button type="submit" class="btn btn-primary" id="update-password-btn">Update
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                    </button>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="alert alert-danger small" role="alert" id="alert">
                                <i class="fas fa-exclamation-circle"></i> Something went wrong!
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
        $(document).ready(function() {
            $("#staticBackdrop").modal('show');
        });
    </script>

    <!-- UPDATE PASSWORD -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#update-password-btn').click(function(event) {
                event.preventDefault();
                $('#loader').show();
                var formData = $('#update-password').serialize();
                console.log(formData);
                $.ajax({
                    url: 'register.php',
                    method: 'post',
                    data: formData + '&action=updatepassword'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1 || data.status == 2 || data.status == 3 || data.status == 4 || data.status == 5 || data.status == 7) {
                        setTimeout(function() {
                            $('#alert').show();
                            $('#result').html(data.msg);
                        }, 1000);
                    } else if (data.status == 6) {
                        setTimeout(function() {
                            $('#alert').hide();
                            $('#success').show();
                            $('#successresult').html(data.msg);
                        }, 1000);
                    }
                })
            })
        })
    </script>

</body>

</html>