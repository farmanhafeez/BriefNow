<?php

require '../dbconfig.php';
require 'session.php';

?>
<?php

$name = $_POST['name'];
$email = $_POST['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Email</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link href="css/admin.css" rel="stylesheet" />
</head>

<body>

    <div class="wrapper">
        <div class="sidebar bg-gradient-primary" data-active-color="white">
            <div class="logo text-center">
                <a href="../" class="simple-text logo-normal">BRIEFNOW</a>
            </div>
            <hr class="sidebar-divider">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li><a href="dashboard.php"><i class="fas fa-university"></i></i>
                            <p>Dashboard</p>
                        </a></li>
                    <hr class="sidebar-divider">
                    <li><a href="user.php"><i class="fas fa-users"></i>
                            <p>User</p>
                        </a></li>
                    <li><a href="blog.php"><i class="fab fa-blogger-b"></i>
                            <p>Blog</p>
                        </a></li>
                    <li><a href="comment.php"><i class="fas fa-comment-dots"></i>
                            <p>Comment</p>
                        </a></li>
                    <hr class="sidebar-divider">
                    <li><a href="contact.php"><i class="fas fa-address-book"></i>
                            <p>Contact</p>
                        </a></li>
                    <li><a href="feedback.php"><i class="fas fa-comment-alt"></i>
                            <p>Feedback</p>
                        </a></li>
                    <li><a href="pagevisitor.php"><i class="fas fa-eye"></i>
                            <p>Pagevisitor</p>
                        </a></li>
                    <hr class="sidebar-divider">
                    <li><a href="newsletter.php"><i class="fas fa-envelope-open"></i>
                            <p>Newsletter</p>
                        </a></li>
                </ul>
            </div>
        </div>

        <div class="main-panel" id="header">

            <a href="#" class="back-to-top"><i class="fas fa-angle-double-up"></i></a>

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top bg-white navbar-light">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand">Email</a>
                    </div>
                    <div class="justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND token = ?");
                                    $stmt->bind_param("ss", $_SESSION['username'], $_SESSION['token']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_array(); ?>
                                    <img src="../<?php echo $row['profilepic']; ?>" style="height: 30px;" class="rounded-circle img-fluid" />
                                    <?php $stmt->close(); ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="dashboard.php"><i class="fas fa-university fa-sm fa-fw mr-2"></i>Dashboard</a>
                                    <a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="email.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <!-- Email table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Send email</h5>
                            </div>
                            <div class="card-body ">
                                <div class="alert alert-danger" role="alert" id="alert" style="display: none">
                                    <div id="result"></div>
                                </div>
                                <div class="alert alert-success" role="alert" id="success" style="display: none">
                                    <div id="successresult"></div>
                                </div>
                                <form action="" id="send-email-form" method="post" class="needs-validation" novalidate>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?php echo $name; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" id="email-btn">
                                        <div class="btn-text">Send Email</div>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid text-center">
                    <div class="credits">
                        <span class="copyright">
                            ©
                            <?php echo $year; ?> | BriefNow | All Rights Reserved.
                        </span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <script src="ckeditor/ckeditor.js"></script>

    <script src="js/main.js"></script>

    <!-- CKEDITOR -->
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('message', {
                height: 300
            });
        });
    </script>

    <!-- Send email -->
    <script>
        $(document).ready(function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                $('#email-btn').click(function(event) {
                    for (instance in CKEDITOR.instances)
                        CKEDITOR.instances[instance].updateElement();
                    event.preventDefault();
                    $('.btn-text').hide();
                    $('#loader').show();
                    $('#alert').hide();
                    $('#success').hide();
                    var formData = $('#send-email-form').serialize();
                    console.log(formData);
                    $.ajax({
                        url: 'register.php',
                        method: 'post',
                        data: formData + '&action=sendemail'
                    }).done(function(result) {
                        console.log(result);
                        var data = JSON.parse(result);
                        if (data.status == 1 || data.status == 2) {
                            setTimeout(function() {
                                $('.btn-text').show();
                                $('#loader').hide();
                                $('#alert').show();
                                $('#result').html(data.msg);
                            }, 1000);
                        } else if (data.status == 3) {
                            $('.btn-text').show();
                            $('#loader').hide();
                            $('#success').show();
                            $('#successresult').html(data.msg);
                        }
                    })
                    form.classList.add('was-validated');
                })
            });
        })
    </script>

</body>

</html>