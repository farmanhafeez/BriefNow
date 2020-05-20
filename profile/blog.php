<?php

require '../dbconfig.php';
require 'session.php';

//Updating the comment count of this blog from comment table
mysqli_query($conn, "UPDATE blog SET blog.commentcount=(SELECT SUM(commentcount) FROM comment 
					WHERE blog.postid=comment.commentpostid GROUP BY comment.commentpostid);");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Blog</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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
                <div class="row">
                    <!-- Number of Blog post (Totally) -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-primary">
                                            <i class="fab fa-blogger-b"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-primary">Blog post</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(postid) as postid FROM blog WHERE author = '" . $_SESSION['username'] . "'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['postid'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    All time
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Number of Blog post (Monthly) -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-danger">
                                            <i class="fab fa-blogger-b"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-danger">Blog post</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(postid) as postid FROM blog WHERE author = '" . $_SESSION['username'] . "'
                                                AND month(blogdate) = month(CURDATE())");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['postid'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    This month
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Number of published post -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-success">
                                            <i class="fab fa-blogger-b"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-success">Published post</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(postid) as postid FROM blog WHERE author = '" . $_SESSION['username'] . "'
                                                AND listed = '1'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['postid'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    All time
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Number of unpublished post -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-warning">
                                            <i class="fab fa-blogger-b"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-warning">Unpublished post</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(postid) as postid FROM blog WHERE author = '" . $_SESSION['username'] . "'
                                                AND listed = '0'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['postid'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <hr>
                                <div class="stats">
                                    All time
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog table -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Blog</h5>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Views</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Comment</th>
                                                <th scope="col">Published?</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM blog WHERE author = '" . $_SESSION['username'] . "'");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_array()) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['postid']; ?></th>
                                                    <td><?php echo $row['title']; ?></td>
                                                    <td><?php echo $row['categories']; ?></td>
                                                    <td><?php echo $row['count']; ?></td>
                                                    <td><?php $date = $row['blogdate'];
                                                        $blogdate = date('d M Y', strtotime($date));
                                                        echo "$blogdate"; ?></td>
                                                    <td><?php echo $row['commentcount']; ?></td>
                                                    <td><?php if ($row['listed'] == 1) {
                                                            echo "Yes";
                                                        } else {
                                                            echo "No";
                                                        } ?></td>
                                                    <td class="text-center">
                                                        <a class="text-muted" id="tableAction" data-toggle="dropdown" style="cursor:pointer;font-size:20px;"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="tableAction" style="box-shadow: 1px 2px 7px 1px rgba(0, 0, 0, 0.125);">
                                                            <a class="dropdown-item" href="../post/<?= $row['author']; ?>-<?php echo $row['postid']; ?>-<?php echo $row['title']; ?>">
                                                                <i class="fas fa-eye"></i> View
                                                            </a>
                                                            <form action="editblog.php" method="post">
                                                                <input type="hidden" name="editpostid" value="<?php echo $row['postid']; ?>">
                                                                <button type="submit" class="btn btn-link btn-sm dropdown-item"><i class="fas fa-edit"></i> Edit</button>
                                                                <a class="btn btn-link btn-sm dropdown-item deletepostbtn" postid="<?php echo $row['postid']; ?>" data-toggle="modal" data-target="#deletepostmodal">
                                                                    <i class="fas fa-trash-alt"></i> Delete
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete post Modal -->
                <div class="modal fade" id="deletepostmodal" tabindex="-1" role="dialog" aria-labelledby="deletepostmodal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Delete post</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger" role="alert" id="alert" style="display: none">
                                    <div id="error-result"></div>
                                </div>
                                <div class="alert alert-success" role="alert" id="success" style="display: none">
                                    <div id="success-result"></div>
                                </div>
                                Are you sure that you want to delete this post?
                                <?php
                                $postid = $row['postid']; ?>
                                <form action="" method="post" id="delete-post-form">
                                    <input type="hidden" name="deletepostid" class="deletepostid">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                                <button type="button" class="btn btn-primary deletebtn">
                                    <div class="btn-text">Delete</div>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
                                </button>
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>

    <script src="js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>

    <script>
        //Delete post
        $(document).ready(function() {
            $(document).on('click', '.deletepostbtn', function() {
                var postid = $(this).attr('postid');
                console.log(postid);
                $('.deletepostid').val(postid);
            })
            $(document).on('click', '.deletebtn', function() {
                $('.btn-text').hide();
                $('#loader').show();
                $('#alert').hide();
                $('#success').hide();
                var formData = $('#delete-post-form').serialize();
                console.log(formData);
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: formData + '&action=deletepost'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1 || data.status == 2 || data.status == 3) {
                        setTimeout(function() {
                            $('.btn-text').show();
                            $('#loader').hide();
                            $('#alert').show();
                            $('#error-result').html(data.msg);
                        }, 1000)
                    } else if (data.status == 4) {
                        setTimeout(function() {
                            $('.btn-text').show();
                            $('#loader').hide();
                            $('#success').show();
                            $('#success-result').html(data.msg);
                        }, 1000)
                    }
                })
            })
        })
    </script>

</body>

</html>