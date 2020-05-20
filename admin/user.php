<?php

require '../dbconfig.php';
require 'session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Users</title>
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
                    <li class="active"><a href="user.php"><i class="fas fa-users"></i>
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
                        <a class="navbar-brand">User</a>
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
                                    <a class="dropdown-item" href="user.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="row">
                    <!-- Number of Users (Totally) -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-primary">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-primary">Users</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(id) as userid FROM users");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['userid'];
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

                    <!-- Number of Users (Monthly) -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-danger">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-danger">Users</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(id) as userid FROM users WHERE month(activationdate) = month(CURDATE())");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['userid'];
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

                    <!-- Number of Active Users post -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-success">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-success">Active users</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(id) as userid FROM users WHERE active = '1'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['userid'];
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

                    <!-- Number of Inactive Users post -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-warning">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-warning">Inactive users</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT count(id) as userid FROM users WHERE active = '0'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['userid'];
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

                <!-- User table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Users</h5>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Fullname</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Active</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Bio</th>
                                                <th scope="col">Question</th>
                                                <th scope="col">Answer</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM users");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_array()) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['id']; ?></th>
                                                    <td>
                                                        <img src="../<?php echo $row['profilepic']; ?>" style="height: 30px;" class="rounded-circle img-fluid" />
                                                    </td>
                                                    <td><?php echo $row['fullname']; ?></td>
                                                    <td>@<?php echo $row['username']; ?></td>
                                                    <td><?php echo wordwrap($row['email'], 25, "<br>\n", TRUE); ?></td>
                                                    <td><?php if ($row['active'] == 1) {
                                                            echo "Yes";
                                                        } else {
                                                            echo "No";
                                                        } ?>
                                                    </td>
                                                    <td><?php $date = $row['activationdate'];
                                                        $activationdate = date('d M Y', strtotime($date));
                                                        echo "$activationdate"; ?></td>
                                                    <td><?php $limit = 50;
                                                        $bio = substr($row['bio'], 0, $limit);
                                                        echo $bio; ?>...</td>
                                                    <td><?php if ($row['question'] == 1) {
                                                            echo "In what county were you born?";
                                                        } elseif ($row['question'] == 2) {
                                                            echo "What is your oldest cousin’s first name?";
                                                        } elseif ($row['question'] == 3) {
                                                            echo "What is the title of your favorite song?";
                                                        } elseif ($row['question'] == 4) {
                                                            echo "In what city or town you finished your school or college?";
                                                        } elseif ($row['question'] == 5) {
                                                            echo "What was your childhood nickname?";
                                                        } ?>
                                                    </td>
                                                    <td><?php echo $row['answer']; ?></td>
                                                    <td class="text-center">
                                                        <a class="text-muted" id="tableAction" data-toggle="dropdown" style="cursor:pointer;font-size:20px;"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="tableAction" style="box-shadow: 1px 2px 7px 1px rgba(0, 0, 0, 0.125);">
                                                            <a class="dropdown-item" href="../profile.php?@<?php echo $row['username']; ?>">
                                                                <i class="fas fa-eye"></i> View
                                                            </a>
                                                            <form action="" method="post" id="delete-user-form">
                                                                <input type="hidden" name="userid" class="userid">
                                                            </form>
                                                            <form action="email.php" method="post">
                                                                <input type="hidden" name="name" value="<?php echo $row['fullname']; ?>">
                                                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                                                <button type="submit" class="btn btn-link btn-sm dropdown-item"><i class="fas fa-envelope"></i> Send message</button>
                                                                <a class="btn btn-link btn-sm dropdown-item delete-user-btn" id="<?php echo $row['id']; ?>">
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
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
        $(document).ready(function() {
            //Delete user
            $(document).on('click', '.delete-user-btn', function() {
                var tr = this;
                var userid = $(this).attr('id');
                console.log(userid);
                $(".userid").val(userid);
                var formData = $('#delete-user-form').serialize();
                console.log(formData);
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: formData + '&action=deleteuser'
                }).done(function(result) {
                    console.log(result);
                    var data = JSON.parse(result);
                    if (data.status == 1) {
                        alert("Id is empty");
                    } else if (data.status == 2) {
                        alert("Something wrong!");
                    } else if (data.status == 3) {
                        setTimeout(function() {
                            $(tr).closest('tr').css('background', '#ccc');
                            $(tr).closest('tr').fadeOut(1000, function() {
                                $(this).remove();
                            });
                        }, 1000)
                    }
                })
            })
        })
    </script>

</body>

</html>