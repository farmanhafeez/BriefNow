<?php

include 'post.php';
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
    <title>BriefNow | Publish</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/select.css" rel="stylesheet" />
    <link href="css/profile.css" rel="stylesheet" />
    <script src="../ckeditor/ckeditor.js"></script>
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
                    <li><a href="profile.php"><i class="fas fa-user"></i>
                            <p>Profile</p>
                        </a></li>
                    <li><a href="blog.php"><i class="fab fa-blogger-b"></i>
                            <p>Blog</p>
                        </a></li>
                    <li><a href="comment.php"><i class="fas fa-comment-dots"></i>
                            <p>Comment</p>
                        </a></li>
                    <li class="active"><a href="publish.php"><i class="fas fa-upload"></i>
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
                        <a class="navbar-brand">Publish</a>
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
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title card-heading">Blog post</h5>
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
                        <form method="post" action="publish.php" autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="form-group">
                                <label for="title">Title
                                    <span class="small" data-toggle="tooltip" data-placement="right" title="Your title should not be very long or very short and keep keyword centric title for better result"><i class="fas fa-info-circle"></i></span>
                                </label>
                                <input type="text" name="title" id="title" placeholder="Title" class="form-control" value="<?php echo $title; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description
                                    <span class="small" data-toggle="tooltip" data-placement="right" title="Search description plays a major role in Goolge search engine. 
                                    So keep your description keyword centric and it should be in between 150 - 250 characters long"><i class="fas fa-info-circle"></i></span>
                                </label>
                                <textarea name="description" id="description" placeholder="Description" minlength="150" maxlength="250" rows="4" class="form-control" required><?php echo $description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="body">Blog post
                                    <span class="small" data-toggle="tooltip" data-placement="right" title="Blog post are the heart of your blog. Write clean and understandable post. 
                                    Use images when necessary"><i class="fas fa-info-circle"></i></span>
                                </label>
                                <textarea rows="12" name="body" id="body" class="form-control" placeholder="Blog post" required><?php echo $body; ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Category
                                            <span class="small" data-toggle="tooltip" data-placement="right" title="Select category from the dropdown list"><i class="fas fa-info-circle"></i></span>
                                        </label>
                                        <select class="form-control select2" id="category" name="category" aria-hidden="false" required>
                                            <option selected disabled value="">Select category</option>
                                            <option value="Affiliate">Affiliate</option>
                                            <option value="Animal">Animal</option>
                                            <option value="Books">Books</option>
                                            <option value="Business">Business</option>
                                            <option value="DIY">DIY</option>
                                            <option value="Education">Education</option>
                                            <option value="Fashion">Fashion</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Food">Food</option>
                                            <option value="Gaming">Gaming</option>
                                            <option value="Health">Health</option>
                                            <option value="Lifestyle">Lifestyle</option>
                                            <option value="Music">Music</option>
                                            <option value="Movie">Movie</option>
                                            <option value="News">News</option>
                                            <option value="Parenting">Parenting</option>
                                            <option value="Personal">Personal</option>
                                            <option value="Politics">Politics</option>
                                            <option value="Programming">Programming</option>
                                            <option value="Review">Review</option>
                                            <option value="Sports">Sports</option>
                                            <option value="Science">Science</option>
                                            <option value="Technology">Technology</option>
                                            <option value="Travel">Travel</option>
                                            <option value="Vehicle">Vehicle</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Add thumbnail
                                            <span class="small" data-toggle="tooltip" data-placement="right" title="Thumbnail image should be in image supported format and it should not exceed more than 2MB"><i class="fas fa-info-circle"></i></span>
                                        </label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="thumbnail" id="customFile" required>
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tag">Tag
                                    <span class="small" data-toggle="tooltip" data-placement="right" title="Add comma seperated tags to categorize your blog. Note: Inserting tags without comma will be taken as single tag"><i class="fas fa-info-circle"></i></span>
                                </label>
                                <input type="text" name="tags" id="tag" placeholder="Tags" class="form-control" value="<?php echo $tags; ?>" required>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-5 mb-2">
                                    <button type="submit" class="btn btn-block btn-primary" name="publish_btn" id="publish-btn">
                                        <div class="btn-text">Publish</div>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-link">Or</button>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <button type="submit" class="btn btn-block btn-outline-dark" name="draft_btn" id="draft-btn">
                                        <div class="btn-text1">Save As Draft</div>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader1" style="display: none;"></span>
                                    </button>
                                </div>
                            </div>
                        </form>
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

    <!--------------- JAVASCRIPT CODE --------------->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

    <script src="js/main.js"></script>

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

    <!-- CKEDITOR -->
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('body', {
                height: 300,
                filebrowserUploadUrl: "post.php",
                filebrowserUploadMethod: "form"
            });

            $('.select2').select2();

            $('#publish-btn').click(function() {
                $('.btn-text').hide();
                $('#loader').show();
                setTimeout(function() {
                    $('#btn-text').show();
                    $('#loader').hide();
                }, 5000)
            });

            $('#draft-btn').click(function() {
                $('.btn-text1').hide();
                $('#loader1').show();
                setTimeout(function() {
                    $('#btn-text1').show();
                    $('#loader1').hide();
                }, 5000)
            });
        });
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

</body>

</html>