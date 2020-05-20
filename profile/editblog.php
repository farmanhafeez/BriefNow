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

$postid = isset($_POST['editpostid']) ? $_POST['editpostid'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Edit Blog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
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
                    <li class="active"><a href="blog.php"><i class="fab fa-blogger-b"></i>
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
                        <a class="navbar-brand">Blog</a>
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
                        <h5 class="card-title card-heading">Edit Blog</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger" role="alert" id="alert" style="display: none">
                            <div id="result"></div>
                        </div>
                        <div class="alert alert-success" role="alert" id="success" style="display: none">
                            <div id="successresult"></div>
                        </div>
                        <form action="" role="form" method="POST" autocomplete="off" id="update-blog" class="needs-validation" novalidate>
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM blog WHERE author = '" . $_SESSION['username'] . "' AND postid = ?");
                            $stmt->bind_param("s", $postid);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_array()) {
                            ?>
                                    <input type="hidden" name="hiddenid" value="<?php echo $row['postid']; ?>">
                                    <div class="form-group text-right">
                                        <input type="checkbox" name="listed" value="1" data-toggle="toggle" data-on="Published" data-off="Unpublished" data-onstyle="primary" data-offstyle="dark" <?php if ($row['listed'] == 1) { ?> checked <?php } ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" placeholder="Title" class="form-control" value="<?php echo $row['title']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" placeholder="Description" cols="30" rows="4" class="form-control" required><?php echo $row['description']; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Blog post</label>
                                        <textarea rows="12" name="body" id="body" class="form-control" placeholder="Blog post" required><?php echo $row['body']; ?></textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select class="form-control select2" id="category" name="category" aria-hidden="false" required>
                                                    <option disabled value="">Select category</option>
                                                    <option <?php if ($row['categories'] == 'Affiliate') echo 'selected'; ?> value="Affiliate">Affiliate</option>
                                                    <option <?php if ($row['categories'] == 'Animal') echo 'selected'; ?> value="Animal">Animal</option>
                                                    <option <?php if ($row['categories'] == 'Books') echo 'selected'; ?> value="Books">Books</option>
                                                    <option <?php if ($row['categories'] == 'Business') echo 'selected'; ?> value="Business">Business</option>
                                                    <option <?php if ($row['categories'] == 'DIY') echo 'selected'; ?> value="DIY">DIY</option>
                                                    <option <?php if ($row['categories'] == 'Education') echo 'selected'; ?> value="Education">Education</option>
                                                    <option <?php if ($row['categories'] == 'Fashion') echo 'selected'; ?> value="Fashion">Fashion</option>
                                                    <option <?php if ($row['categories'] == 'Finance') echo 'selected'; ?> value="Finance">Finance</option>
                                                    <option <?php if ($row['categories'] == 'Food') echo 'selected'; ?> value="Food">Food</option>
                                                    <option <?php if ($row['categories'] == 'Gaming') echo 'selected'; ?> value="Gaming">Gaming</option>
                                                    <option <?php if ($row['categories'] == 'Health') echo 'selected'; ?> value="Health">Health</option>
                                                    <option <?php if ($row['categories'] == 'Lifestyle') echo 'selected'; ?> value="Lifestyle">Lifestyle</option>
                                                    <option <?php if ($row['categories'] == 'Music') echo 'selected'; ?> value="Music">Music</option>
                                                    <option <?php if ($row['categories'] == 'Movie') echo 'selected'; ?> value="Movie">Movie</option>
                                                    <option <?php if ($row['categories'] == 'News') echo 'selected'; ?> value="News">News</option>
                                                    <option <?php if ($row['categories'] == 'Parenting') echo 'selected'; ?> value="Parenting">Parenting</option>
                                                    <option <?php if ($row['categories'] == 'Personal') echo 'selected'; ?> value="Personal">Personal</option>
                                                    <option <?php if ($row['categories'] == 'Politics') echo 'selected'; ?> value="Politics">Politics</option>
                                                    <option <?php if ($row['categories'] == 'Programming') echo 'selected'; ?> value="Programming">Programming</option>
                                                    <option <?php if ($row['categories'] == 'Review') echo 'selected'; ?> value="Review">Review</option>
                                                    <option <?php if ($row['categories'] == 'Sports') echo 'selected'; ?> value="Sports">Sports</option>
                                                    <option <?php if ($row['categories'] == 'Science') echo 'selected'; ?> value="Science">Science</option>
                                                    <option <?php if ($row['categories'] == 'Technology') echo 'selected'; ?> value="Technology">Technology</option>
                                                    <option <?php if ($row['categories'] == 'Travel') echo 'selected'; ?> value="Travel">Travel</option>
                                                    <option <?php if ($row['categories'] == 'Vehicle') echo 'selected'; ?> value="Vehicle">Vehicle</option>
                                                    <option <?php if ($row['categories'] == 'Other') echo 'selected'; ?> value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tag">Tag</label>
                                                <input type="text" name="tags" id="tag" placeholder="Tags" class="form-control" value="<?php echo $row['tags']; ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } else { ?>
                                Nothing found
                            <?php }
                            $stmt->close();
                            ?>
                            <button type="submit" class="btn btn-block btn-primary" id="updateblogbtn">
                                <div class="btn-text">Update</div>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Add new thumbnail</h5>
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
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="blogpostid" value="<?php echo $postid; ?>">
                                    <div class="form-group">
                                        <label>Add thumbnail</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="thumbnail" id="customFile" aria-describedby="passwordHelpBlock">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                            <small id="passwordHelpBlock" class="form-text text-muted">
                                                Image size should be less than 2MB and it should be in png or jpg or jpeg or gif format.
                                            </small>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" name="thumbnailbtn" id="thumbnail-btn">
                                        <div class="btn-text1">Change</div>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader1" style="display: none;"></span>
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

    <!--------------- JAVASCRIPT CODE --------------->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>

    <script src="js/main.js"></script>

    <!-- CKEDITOR -->
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('body', {
                height: 300,
                filebrowserUploadUrl: "post.php",
                filebrowserUploadMethod: "form"
            });

            $('.select2').select2();

            bsCustomFileInput.init();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                $('#updateblogbtn').click(function(event) {
                    for (instance in CKEDITOR.instances)
                        CKEDITOR.instances[instance].updateElement();
                    event.preventDefault();
                    $('.btn-text').hide();
                    $('#loader').show();
                    $('#alert').hide();
                    $('#success').hide();
                    var formData = $('#update-blog').serialize();
                    console.log(formData);
                    $.ajax({
                        url: 'post.php',
                        method: 'post',
                        data: formData + '&action=updateblog'
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
                            setTimeout(function() {
                                $('#success').show();
                                $('#successresult').html(data.msg);
                            }, 1000);
                            setTimeout(function() {
                                $('.btn-text').show();
                                $('#loader').hide();
                                window.location.href = "blog.php";
                            }, 3000);
                        }
                    })
                    form.classList.add('was-validated');
                })
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#thumbnail-btn').click(function() {
                $('.btn-text1').hide();
                $('#loader1').show();
            })
        })
    </script>

</body>

</html>