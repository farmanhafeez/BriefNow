<?php

include 'query.php';
require '../dbconfig.php';

//Destroy session
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    setcookie('remember_me', $getrow['active_token'], 1);
}

//if a user is not logedin, then he will be redirected to login page
if (!isset($_SESSION['username'])) {
    $_SESSION["login_redirect"] = $_SERVER["PHP_SELF"];
    header("Location: ../login.php");
    exit;
}

$month = date('F');
$year = date('Y');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link href="css/profile.css" rel="stylesheet" />
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
                    <li class="active"><a href="profile.php"><i class="fas fa-user"></i>
                            <p>Profile</p>
                        </a></li>
                    <li><a href="blog.php"><i class="fab fa-blogger-b"></i>
                            <p>Blog</p>
                        </a></li>
                    <li><a href="comment.php"><i class="fas fa-comment-dots"></i>
                            <p>Comment</p>
                        </a></li>
                    <li><a href="publish.php"><i class="fas fa-upload"></i>
                            <p>Publish</p>
                        </a></li>
                    <hr class="sidebar-divider">
                    <li><a href="../"><i class="fas fa-fw fa-home"></i>
                            <p>Home</p>
                        </a></li>
                    <li><a href="../about/"><i class="fas fa-fw fa-address-card"></i>
                            <p>About</p>
                        </a></li>
                    <li><a href="../contact/"><i class="fas fa-fw fa-address-book"></i>
                            <p>Contact</p>
                        </a></li>
                    <hr class="sidebar-divider">
                    <li><a href="setting.php"><i class="fas fa-cog"></i>
                            <p>Setting</p>
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
                        <a class="navbar-brand">Profile</a>
                    </div>
                    <div class="justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM users WHERE username='" . $_SESSION['username'] . "'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_array(); ?>
                                    <img src="../<?php echo $row['profilepic']; ?>" style="height: 30px;" class="rounded-circle img-fluid" />
                                    <?php $stmt->close(); ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="dashboard.php"><i class="fas fa-university fa-sm fa-fw mr-2"></i>Dashboard</a>
                                    <a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Profile</a>
                                    <a class="dropdown-item" href="blog.php"><i class="fab fa-blogger-b fa-sm fa-fw mr-2"></i>Blog</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Change picture</h5>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($error)) { ?>
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                                    </div>
                                <?php }
                                if (!empty($success)) { ?>
                                    <div class="alert alert-success" role="alert" id="success">
                                        <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                                    </div>
                                <?php } ?>
                                <form action="profile.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="thumbnail" id="customFile" aria-describedby="passwordHelpBlock">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                Image size should be less than 2MB and it should be in png or jpg or jpeg or gif format.
                                            </small>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary btn-block" name="profilepicbtn" id="profile-pic-btn">Change
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader1" style="display: none;"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Edit Profile</h5>
                            </div>
                            <div class="card-body">
                                <?php
                                $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
                                $row = mysqli_fetch_array($result);
                                ?>
                                <div class="alert alert-danger" role="alert" id="alert" style="display: none">
                                    <div id="error-result"></div>
                                </div>
                                <div class="alert alert-success" role="alert" id="success" style="display: none">
                                    <div id="success-result"></div>
                                </div>
                                <form id="update-profile" action="" method="post" autocomplete="off" class="needs-validation" novalidate>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="fullname">Fullname</label>
                                            <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $row['fullname']; ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control" value="@<?php echo $row['username']; ?>" disabled required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control" value="<?php echo $row['email']; ?>" disabled required>
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea name="bio" id="bio" rows="5" class="form-control" maxlength="200" required><?php echo $row['bio']; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="selectmenu">Select a security question
                                                <span class="small" data-toggle="tooltip" data-placement="right" title="To protect your identity and your account, it is important to set secret question and answer pair"><i class="far fa-question-circle"></i></span>
                                            </label>
                                            <select class="custom-select" id="selectmenu" name="question" required>
                                                <option value="1" <?php if ($row['question'] == 1) { ?> selected <?php } ?>>In what county were you born?</option>
                                                <option value="2" <?php if ($row['question'] == 2) { ?> selected <?php } ?>>What is your oldest cousin’s first name?</option>
                                                <option value="3" <?php if ($row['question'] == 3) { ?> selected <?php } ?>>What is the title of your favorite song?</option>
                                                <option value="4" <?php if ($row['question'] == 4) { ?> selected <?php } ?>>In what city or town you finished your school or college?</option>
                                                <option value="5" <?php if ($row['question'] == 5) { ?> selected <?php } ?>>What was your childhood nickname?</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="answer">Answer</label>
                                            <input class="form-control" type="text" id="answer" name="answer" value="<?php echo $row['answer']; ?>" required>
                                        </div>
                                    </div>
                                    <h5 class="card-title card-heading my-3">Add social link</h5>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="facebook">Facebook</label>
                                            <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Add url" value="<?php echo $row['facebook']; ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Add url" value="<?php echo $row['instagram']; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="twitter">Twitter</label>
                                            <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Add url" value="<?php echo $row['twitter']; ?>">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="linkedin">Linkedin</label>
                                            <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="Add url" value="<?php echo $row['linkedin']; ?>">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" id="updateprofilebtn">
                                        <div class="btn-text">Update</div>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
                        $row = mysqli_fetch_array($result);
                        ?>
                        <div class="card">
                            <div class="card-body profilebg d-flex align-items-center justify-content-center">
                                <img src="../<?php echo $row['profilepic']; ?>" class="img-fluid rounded-circle profileimg" />
                            </div>
                            <div class="card-body text-center profilebody">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-12">
                                        <h4><?php echo $row['fullname']; ?></h4>
                                        <a href="../profile.php?@<?= $row['username']; ?>">
                                            <h6 class="">@<?php echo $row['username']; ?></h6>
                                        </a>
                                        <p class="font-italic text-muted">"<?php echo $row['bio']; ?>"</p>
                                        <div class="card-footer">
                                            <div class="row justify-content-center">
                                                <div class="col-2">
                                                    <a href="<?= $row['facebook']; ?>" target="blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                                </div>
                                                <div class="col-2">
                                                    <a href="<?= $row['instagram']; ?>" target="blank" class="instagram"><i class="fab fa-instagram"></i></a>
                                                </div>
                                                <div class="col-2">
                                                    <a href="<?= $row['twitter']; ?>" target="blank" class="twitter"><i class="fab fa-twitter"></i></a>
                                                </div>
                                                <div class="col-2">
                                                    <a href="<?= $row['linkedin']; ?>" target="blank" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Update profile -->
    <script>
        $(document).ready(function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                $('#updateprofilebtn').click(function(event) {
                    event.preventDefault();
                    $('.btn-text').hide();
                    $('#loader').show();
                    $('#alert').hide();
                    $('#success').hide();
                    var formData = $('#update-profile').serialize();
                    console.log(formData);
                    $.ajax({
                        url: 'query.php',
                        method: 'post',
                        data: formData + '&action=updateprofile'
                    }).done(function(result) {
                        console.log(result);
                        var data = JSON.parse(result);
                        if (data.status == 1 || data.status == 2) {
                            setTimeout(function() {
                                $('.btn-text').show();
                                $('#loader').hide();
                                $('#alert').show();
                                $('#error-result').html(data.msg);
                            }, 1000);
                        } else if (data.status == 3) {
                            setTimeout(function() {
                                $('#success').show();
                                $('#success-result').html(data.msg);
                            }, 1000);
                            setTimeout(function() {
                                $('.btn-text').show();
                                $('#loader').hide();
                                window.location.href = "profile.php";
                            }, 2500);
                        }
                    })
                    form.classList.add('was-validated');
                })
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#profile-pic-btn').click(function() {
                $('#loader1').show();
            })
        })
    </script>

</body>

</html>