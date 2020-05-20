<?php

require '../dbconfig.php';
require 'session.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Page visitor</title>
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
        <div class="sidebar bg-gradient-primary">
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
                    <li class="active"><a href="pagevisitor.php"><i class="fas fa-eye"></i>
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
                        <a class="navbar-brand">Page visitor</a>
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
                                    <a class="dropdown-item" href="pagevisitor.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <!-- Pagevisitor table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Page visitors</h5>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">VisitorID</th>
                                                <th scope="col">PostID</th>
                                                <th scope="col">IP</th>
                                                <th scope="col">Device</th>
                                                <th scope="col">Browser</th>
                                                <th scope="col">Country</th>
                                                <th scope="col">Month</th>
                                                <th scope="col">Year</th>
                                                <th scope="col">Pageviews</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM pagevisitor");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_array()) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['visitorid']; ?></th>
                                                    <td><?php echo $row['blogpostid']; ?></td>
                                                    <td><?php echo $row['visitorip']; ?></td>
                                                    <td><?php echo $row['visitordevice']; ?></td>
                                                    <td><?php echo $row['visitorbrowser']; ?></td>
                                                    <td><?php echo $row['visitorcountry']; ?></td>
                                                    <td><?php echo $row['visitormonth']; ?></td>
                                                    <td><?php echo $row['visitoryear']; ?></td>
                                                    <td><?php echo $row['pageviews']; ?></td>
                                                    <td class="text-center">
                                                        <form action="" method="post" id="delete-visitor-form">
                                                            <input type="hidden" name="visitorid" class="visitorid">
                                                        </form>
                                                        <a class="text-danger btn btn-sm btn-link delete-btn" visitorid="<?php echo $row['visitorid']; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
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

                <!-- Traffic source table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Traffic source</h5>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">PostID</th>
                                                <th scope="col">Referer</th>
                                                <th scope="col">Pageviews</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM trafficsource");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_array()) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['id']; ?></th>
                                                    <td><?php echo $row['postid']; ?></td>
                                                    <td><?php echo $row['referer']; ?></td>
                                                    <td><?php echo $row['pageviews']; ?></td>
                                                    <td class="text-center">
                                                        <form action="" method="post" id="delete-traffic-form">
                                                            <input type="hidden" name="trafficid" class="trafficid">
                                                        </form>
                                                        <a class="text-danger btn btn-sm btn-link delete-traffic-btn" trafficid="<?php echo $row['id']; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
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
        //Delete table data
        $(document).ready(function() {
            $(document).on('click', '.delete-btn', function() {
                var tr = this;
                var visitorid = $(this).attr('visitorid');
                console.log(visitorid);
                $(".visitorid").val(visitorid);
                var formData = $('#delete-visitor-form').serialize();
                console.log(formData);
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: formData + '&action=deletevisitor'
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

    <script>
        //Delete table data
        $(document).ready(function() {
            $(document).on('click', '.delete-traffic-btn', function() {
                var tr = this;
                var trafficid = $(this).attr('trafficid');
                console.log(trafficid);
                $(".trafficid").val(trafficid);
                var formData = $('#delete-traffic-form').serialize();
                console.log(formData);
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: formData + '&action=deletetraffic'
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