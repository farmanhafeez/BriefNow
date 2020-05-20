<?php

require '../dbconfig.php';
require 'session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Setting</title>
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
                    <li><a href="profile.php"><i class="fas fa-user"></i>
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
                    <li class="active"><a href="setting.php"><i class="fas fa-cog"></i>
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
                        <a class="navbar-brand">Setting</a>
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
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title text-primary">Unpublish all post</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title text-primary"><i class="fas fa-folder-minus"></i></h3>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#unpublishblog">Unpublish</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="unpublishblog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Unpublish all post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert" id="alert" style="display: none">
                                            <div id="result"></div>
                                        </div>
                                        <div class="alert alert-success" role="alert" id="success" style="display: none">
                                            <div id="successresult"></div>
                                        </div>
                                        <b>Note: </b>Unpublished post will not appear in homepage or blog page.<br><br>
                                        Are you sure that you want to unpublish all post?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary" id="unpublishbtn">Unpublish
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title text-success">Publish all post</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title text-success"><i class="fas fa-folder-plus"></i></h3>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#publishblog">Publish</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="publishblog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Publish all post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert" id="alert1" style="display: none">
                                            <div id="result1"></div>
                                        </div>
                                        <div class="alert alert-success" role="alert" id="success1" style="display: none">
                                            <div id="successresult1"></div>
                                        </div>
                                        Are you sure that you want to Publish all post?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary" id="publishbtn">Publish
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader1" style="display: none;"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title text-warning">Delete all post</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title text-warning"><i class="fas fa-trash-alt"></i></h3>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#deleteblog">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteblog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete all post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert" id="alert2" style="display: none">
                                            <div id="result2"></div>
                                        </div>
                                        <div class="alert alert-success" role="alert" id="success2" style="display: none">
                                            <div id="successresult2"></div>
                                        </div>
                                        <b>Note: </b>Once deleted, your blog post will be deleted permanently. There's no undo option<br><br>
                                        Are you sure that you want to delete all post?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary" id="deleteblogbtn">Delete
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader2" style="display: none;"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title text-danger">Delete my account</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="card-title text-danger"><i class="fas fa-user-times"></i></h3>
                                    </div>
                                    <div class="col-6 text-right">
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteaccount">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Delete my account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="alert alert-danger" role="alert" id="alert3" style="display: none">
                                            <div id="result3"></div>
                                        </div>
                                        <div class="alert alert-success" role="alert" id="success3" style="display: none">
                                            <div id="successresult3"></div>
                                        </div>
                                        <b>Note: </b>Deleting your account will only delete account not your blog. But you can't make changes
                                        to those blog. If you want to delete the post also, you can choose "Delete all post" to delete your blog as well<br><br>
                                        Are you sure that you want to delete your account?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary" id="deletebtn">Delete
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader3" style="display: none;"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Update password</h5>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-danger" role="alert" id="alert4" style="display: none">
                                    <div id="result4"></div>
                                </div>
                                <div class="alert alert-success" role="alert" id="success4" style="display: none">
                                    <div id="successresult4"></div>
                                </div>
                                <form id="update-password" action="" method="post" class="needs-validation" novalidate>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmpassword">Confirm Password</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Re-enter your password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" id="updatepassbtn">
                                        <div class="btn-text">Update</div>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader4" style="display: none;"></span>
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

    <script src="js/main.js"></script>

    <!-- Unpublish all post -->
    <script>
        $(document).ready(function() {
            $('#unpublishbtn').click(function(event) {
                event.preventDefault();
                $('#loader').show();
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: 'action=unpublishpost'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        setTimeout(function() {
                            $('#loader').hide();
                            $('#alert').show();
                            $('#result').html(data.msg);
                        }, 1000);
                    } else if (data.status == 2) {
                        setTimeout(function() {
                            $('#loader').hide();
                            $('#alert').hide();
                            $('#success').show();
                            $('#successresult').html(data.msg);
                        }, 1000);
                    }
                })
            })
        })
    </script>

    <!-- Publish all post -->
    <script>
        $(document).ready(function() {
            $('#publishbtn').click(function(event) {
                event.preventDefault();
                $('#loader1').show();
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: 'action=publishpost'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        setTimeout(function() {
                            $('#loader1').hide();
                            $('#alert1').show();
                            $('#result1').html(data.msg);
                        }, 1000);
                    } else if (data.status == 2) {
                        setTimeout(function() {
                            $('#loader1').hide();
                            $('#alert1').hide();
                            $('#success1').show();
                            $('#successresult1').html(data.msg);
                        }, 1000);
                    }
                })
            })
        })
    </script>

    <!-- Delete all post -->
    <script>
        $(document).ready(function() {
            $('#deleteblogbtn').click(function(event) {
                event.preventDefault();
                $('#loader2').show();
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: 'action=deleteallpost'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        setTimeout(function() {
                            $('#loader2').hide();
                            $('#alert2').show();
                            $('#result2').html(data.msg);
                        }, 1000);
                    } else if (data.status == 2) {
                        setTimeout(function() {
                            $('#loader2').hide();
                            $('#alert2').hide();
                            $('#success2').show();
                            $('#successresult2').html(data.msg);
                        }, 1000);
                    }
                })
            })
        })
    </script>

    <!-- Delete account -->
    <script>
        $(document).ready(function() {
            $('#deletebtn').click(function(event) {
                event.preventDefault();
                $('#loader3').show();
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: 'action=deleteaccount'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        setTimeout(function() {
                            $('#loader3').hide();
                            $('#alert3').show();
                            $('#result3').html(data.msg);
                        }, 1000);
                    } else if (data.status == 2) {
                        setTimeout(function() {
                            $('#alert3').hide();
                            $('#success3').show();
                            $('#successresult3').html(data.msg);
                        }, 3000);
                        setTimeout(function() {
                            $('#loader3').hide();
                            window.location.href = "../?logout='1'";
                        }, 5000);
                    }
                })
            })
        })
    </script>

    <!-- Update password -->
    <script>
        $(document).ready(function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                $('#updatepassbtn').click(function(event) {
                    event.preventDefault();
                    $('.btn-text').hide();
                    $('#loader4').show();
                    $('#alert4').hide();
                    $('#success4').hide();
                    var formData = $('#update-password').serialize();
                    console.log(formData);
                    $.ajax({
                        url: 'query.php',
                        method: 'post',
                        data: formData + '&action=updatepassword'
                    }).done(function(result) {
                        console.log(result);
                        var data = JSON.parse(result);
                        if (data.status == 1 || data.status == 2 || data.status == 3 || data.status == 4 || data.status == 5) {
                            setTimeout(function() {
                                $('.btn-text').show();
                                $('#loader4').hide();
                                $('#alert4').show();
                                $('#result4').html(data.msg);
                            }, 1000);
                        } else if (data.status == 6) {
                            $('.btn-text').show();
                            $('#loader4').hide();
                            $("#update-password")[0].reset();
                            $('#alert4').hide();
                            $('#success4').show();
                            $('#successresult4').html(data.msg);
                        }
                    })
                    form.classList.add('was-validated');
                })
            });
        })
    </script>

</body>

</html>