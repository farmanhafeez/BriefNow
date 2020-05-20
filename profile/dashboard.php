<?php

require '../dbconfig.php';
require 'session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Dashboard</title>
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

        <div class="sidebar bg-gradient-primary">
            <div class="logo text-center">
                <a href="../" class="simple-text logo-normal">BRIEFNOW</a>
            </div>
            <hr class="sidebar-divider">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active"><a href="dashboard.php"><i class="fas fa-university"></i></i>
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
                        <a class="navbar-brand">Dashboard</a>
                    </div>
                    <div class="justify-content-end">
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='" . $_SESSION['username'] . "'");
                                    $row = mysqli_fetch_array($result); ?>
                                    <img src="../<?php echo $row['profilepic']; ?>" style="height: 30px;" class="rounded-circle img-fluid" />
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
                    <!-- Pageviews (All time) -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-primary">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-primary">Pageviews</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT sum(pageviews) as pageview FROM pagevisitor p, blog b 
                                                WHERE p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['pageview'];
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

                    <!-- Pageviews (Last month) -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-success">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-success">Pageviews</p>
                                            <p class="card-title">
                                                <?php
                                                $previousmonth = date('F', strtotime('previous month'));
                                                $result = mysqli_query($conn, "SELECT sum(pageviews) as pageview FROM pagevisitor p, blog b WHERE visitormonth = '$previousmonth' 
                                                AND visitoryear = '$year' AND p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['pageview'];
                                                ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <hr>
                                <div class="stats">
                                    Last month
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pageviews (This month) -->
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5 col-md-4">
                                        <div class="icon-big text-center text-warning">
                                            <i class="fas fa-eye"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-md-8">
                                        <div class="numbers">
                                            <p class="card-category text-warning">Pageviews</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT sum(pageviews) as pageview FROM pagevisitor p, blog b WHERE visitormonth = '$month' 
                                                AND visitoryear = '$year' AND p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['pageview'];
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

                    <!--Visitors (All time) -->
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
                                            <p class="card-category text-danger">Visitors</p>
                                            <p class="card-title">
                                                <?php
                                                $result = mysqli_query($conn, "SELECT COUNT(DISTINCT visitorip) as visitor FROM pagevisitor p, blog b 
                                                WHERE p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "'");
                                                $row = mysqli_fetch_array($result);
                                                echo $row['visitor'];
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
                </div>

                <!-- Comparison chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Pageviews comparison</h5>
                            </div>
                            <div class="card-body ">
                                <?php
                                //Previous month
                                $previousmonth = date('F', strtotime('previous month'));
                                $lastmonth = mysqli_query($conn, "SELECT blogpostid as postid,sum(pageviews) as pageview FROM pagevisitor 
                                WHERE visitormonth = '$previousmonth' AND visitoryear = '$year' AND 
                                blogpostid IN (SELECT postid FROM blog WHERE author = '" . $_SESSION['username'] . "' ORDER BY count DESC) GROUP BY blogpostid LIMIT 10");
                                $lastjson = [];
                                $lastjson1 = [];
                                while ($lastrow = mysqli_fetch_array($lastmonth)) {
                                    $lastjson[] = $lastrow['postid'];
                                    $lastjson1[] = $lastrow['pageview'];
                                }
                                //This month
                                $thismonth = mysqli_query($conn, "SELECT blogpostid as postid,sum(pageviews) as pageview FROM pagevisitor 
                                WHERE visitormonth = '$month' AND visitoryear = '$year' AND 
                                blogpostid IN (SELECT postid FROM blog WHERE author = '" . $_SESSION['username'] . "' ORDER BY count DESC) GROUP BY blogpostid LIMIT 10");
                                $thisjson = [];
                                $thisjson1 = [];
                                while ($thisrow = mysqli_fetch_array($thismonth)) {
                                    $thisjson[] = $thisrow['postid'];
                                    $thisjson1[] = $thisrow['pageview'];
                                }
                                ?>
                                <canvas id="comparisonChart"></canvas>
                            </div>
                            <div class="card-footer text-muted">
                                *Comparison of previous month vs this month pageviews for the top 10 popular post
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Pageview by month -->
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Pageview of <?php echo $month; ?> <?php echo $year; ?></h5>
                            </div>
                            <div class="card-body ">
                                <?php
                                $resultmonth = mysqli_query($conn, "SELECT b.postid as postid,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                WHERE visitormonth = '$month' AND visitoryear = '$year' AND p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "'
                                GROUP BY blogpostid ORDER BY blogpostid DESC");
                                $jsonmonth = [];
                                $jsonmonth2 = [];
                                while ($rowmonth = mysqli_fetch_array($resultmonth)) {
                                    $jsonmonth[] = $rowmonth['postid'];
                                    $jsonmonth2[] = $rowmonth['pageview'];
                                }
                                ?>
                                <canvas id="myAreaChart"></canvas>
                            </div>
                            <div class="card-footer text-muted">
                                *This chart will show you the views you got in this month
                            </div>
                        </div>
                    </div>
                    <!-- Visitor by month -->
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header ">
                                <h5 class="card-title card-heading">Visitor of <?php echo $month; ?> <?php echo $year; ?></h5>
                            </div>
                            <div class="card-body ">
                                <?php
                                $resultvisitor = mysqli_query($conn, "SELECT b.postid as postid,count(visitorip) as visitor FROM pagevisitor p, blog b 
                                WHERE visitormonth = '$month' AND visitoryear = '$year' AND p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "'
                                GROUP BY blogpostid ORDER BY blogpostid DESC");
                                $jsonvisitor = [];
                                $jsonvisitor2 = [];
                                while ($rowvisitor = mysqli_fetch_array($resultvisitor)) {
                                    $jsonvisitor[] = $rowvisitor['postid'];
                                    $jsonvisitor2[] = $rowvisitor['visitor'];
                                }
                                ?>
                                <canvas id="myChartvisitor"></canvas>
                            </div>
                            <div class="card-footer text-muted">
                                *This chart will show you the number of visitors visited in this month
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Monthly pageviews -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Pageviews by month</h5>
                            </div>
                            <div class="card-body ">
                                <?php
                                $totalviews = mysqli_query($conn, "SELECT p.visitormonth as month,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                WHERE visitoryear = '$year' AND p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "'
                                GROUP BY p.visitormonth LIMIT 12");
                                $totaljson = [];
                                $totaljson1 = [];
                                while ($totalrow = mysqli_fetch_array($totalviews)) {
                                    $totaljson[] = $totalrow['month'];
                                    $totaljson1[] = $totalrow['pageview'];
                                }
                                ?>
                                <canvas id="totalPageviewsChart"></canvas>
                            </div>
                            <div class="card-footer text-muted">
                                *Monthwise total pageviews you got for your post
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Post pageviews and visitors</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover data-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Post ID</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Pageviews</th>
                                                <th scope="col">Visitors</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT b.postid as postid,b.title as title,sum(p.pageviews) as pageview,COUNT(DISTINCT p.visitorip) as visitor FROM blog b, pagevisitor p 
                                            WHERE b.postid = p.blogpostid AND b.author = '" . $_SESSION['username'] . "' GROUP BY p.blogpostid");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_array()) { ?>
                                                    <tr>
                                                        <th><?php echo $row['postid']; ?></th>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['pageview']; ?></td>
                                                        <td><?php echo $row['visitor']; ?></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>No data</td>
                                                </tr>
                                            <?php }
                                            $stmt->close(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Pageview by device -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Pageviews by device</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 350px;">
                                    <table class="table table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Device</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT visitordevice as device,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                            WHERE p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "' GROUP BY visitordevice");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_array()) { ?>
                                                    <tr>
                                                        <th><?php echo $row['device']; ?></th>
                                                        <td><?php echo $row['pageview']; ?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>No data</td>
                                                </tr>
                                            <?php }
                                            $stmt->close(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Pageview by country -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Pageviews by country</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 350px;">
                                    <table class="table table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Country</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT visitorcountry as country,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                            WHERE p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "' GROUP BY visitorcountry");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_array()) { ?>
                                                    <tr>
                                                        <th><?php echo $row['country']; ?></th>
                                                        <td><?php echo $row['pageview']; ?></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>No data</td>
                                                </tr>
                                            <?php }
                                            $stmt->close(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Pageview by browser -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Pageviews by browser</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 350px;">
                                    <table class="table table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">Browser</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT visitorbrowser as browser,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                            WHERE p.blogpostid = b.postid AND b.author = '" . $_SESSION['username'] . "' GROUP BY visitorbrowser");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_array()) { ?>
                                                    <tr>
                                                        <th><?php echo $row['browser']; ?></th>
                                                        <td><?php echo $row['pageview']; ?></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>No data</td>
                                                </tr>
                                            <?php }
                                            $stmt->close(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Traffic sources -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Traffic sources</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" style="max-height: 400px;">
                                    <table class="table table-hover m-0">
                                        <thead>
                                            <tr>
                                                <th scope="col">URL</th>
                                                <th scope="col">Pageviews</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT t.referer as url,sum(t.pageviews) as pageview FROM trafficsource t, blog b
                                            WHERE t.postid = b.postid AND b.author = '" . $_SESSION['username'] . "' GROUP BY t.referer");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_array()) { ?>
                                                    <tr>
                                                        <th><?php echo $row['url']; ?></th>
                                                        <td><?php echo $row['pageview']; ?></td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr>
                                                    <td>No data</td>
                                                </tr>
                                            <?php }
                                            $stmt->close(); ?>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    <script src="js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('.data-table').DataTable({
                "order": [
                    [0, "desc"]
                ]
            });
        });
    </script>

    <script>
        function blueBG() {
            return "rgba(54, 162, 235, 0.5)";
        }

        function blueBorder() {
            return "rgba(54, 162, 235, 1)";
        }

        function pinkBG() {
            return "rgba(255, 99, 132, 0.5)";
        }

        function pinkBorder() {
            return "rgba(255, 99, 132, 1)";
        }
        //Comparison chart
        var ctx = document.getElementById('comparisonChart').getContext('2d');
        var mixedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($lastjson); ?>,
                datasets: [{
                    label: 'Previous month',
                    data: <?php echo json_encode($lastjson1); ?>,
                    backgroundColor: pinkBG(),
                    borderColor: pinkBorder(),
                    borderWidth: 2
                }, {
                    label: 'This month',
                    data: <?php echo json_encode($thisjson1); ?>,
                    type: 'bar',
                    backgroundColor: blueBG(),
                    borderColor: blueBorder(),
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Blog post ID'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Pageviews'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //Pageview by month
        var ctxmonth = document.getElementById('myAreaChart').getContext('2d');
        var myChartmonth = new Chart(ctxmonth, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($jsonmonth); ?>,
                datasets: [{
                    label: 'Views',
                    data: <?php echo json_encode($jsonmonth2); ?>,
                    backgroundColor: blueBG(),
                    borderColor: blueBorder(),
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Blog post ID'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Pageviews'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //Monthly pageviews
        var ctx = document.getElementById('totalPageviewsChart').getContext('2d');
        var mixedChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($totaljson); ?>,
                datasets: [{
                    label: 'Views',
                    data: <?php echo json_encode($totaljson1); ?>,
                    backgroundColor: pinkBG(),
                    borderColor: pinkBorder(),
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Pageviews'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        //Visitor by month
        var ctxvisitor = document.getElementById('myChartvisitor').getContext('2d');
        var myChartvisitor = new Chart(ctxvisitor, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($jsonvisitor); ?>,
                datasets: [{
                    label: 'Visitors',
                    data: <?php echo json_encode($jsonvisitor2); ?>,
                    backgroundColor: blueBG(),
                    borderColor: blueBorder(),
                    borderWidth: 2
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Blog post ID'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Visitors'
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>

</html>