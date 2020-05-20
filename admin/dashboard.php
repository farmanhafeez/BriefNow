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
                    <li class="active"><a href="dashboard.php"><i class="fas fa-university"></i></i>
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
                        <a class="navbar-brand">Dashboard</a>
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
                                    <a class="dropdown-item" href="dashboard.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
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
                                                $result = mysqli_query($conn, "SELECT sum(pageviews) as pageview FROM pagevisitor");
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
                                                $result = mysqli_query($conn, "SELECT sum(pageviews) as pageview FROM pagevisitor 
                                                WHERE visitormonth = '$previousmonth' AND visitoryear = '$year'");
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
                                                $result = mysqli_query($conn, "SELECT sum(pageviews) as pageview FROM pagevisitor
                                                 WHERE visitormonth = '$month' AND visitoryear = '$year'");
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
                                                $result = mysqli_query($conn, "SELECT COUNT(DISTINCT visitorip) as visitor FROM pagevisitor");
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

                <!-- Pageview by month -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header">
                                <h6 class="card-title card-heading">Pageview of <?php echo $month; ?> <?php echo $year; ?></h6>
                            </div>
                            <div class="card-body ">
                                <?php
                                $resultmonth = mysqli_query($conn, "SELECT b.postid as postid,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                WHERE visitormonth = '$month' AND visitoryear = '$year' AND p.blogpostid = b.postid 
                                GROUP BY blogpostid ORDER BY blogpostid DESC LIMIT 10");
                                $jsonmonth = [];
                                $jsonmonth2 = [];
                                while ($rowmonth = mysqli_fetch_array($resultmonth)) {
                                    $jsonmonth[] = $rowmonth['postid'];
                                    $jsonmonth2[] = $rowmonth['pageview'];
                                }
                                ?>
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Pageview by device -->
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-header ">
                                <h6 class="card-title card-heading">Pageview by device</h6>
                            </div>
                            <div class="card-body ">
                                <?php
                                $resultdevice = mysqli_query($conn, "SELECT visitordevice as device,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                WHERE p.blogpostid = b.postid GROUP BY visitordevice");
                                $jsondevice = [];
                                $jsondevice2 = [];
                                while ($rowdevice = mysqli_fetch_array($resultdevice)) {
                                    $jsondevice[] = $rowdevice['device'];
                                    $jsondevice2[] = $rowdevice['pageview'];
                                }
                                ?>
                                <canvas id="myChartdevice"></canvas>
                            </div>
                            <div class="card-footer text-muted">
                                Overall
                            </div>
                        </div>
                    </div>

                    <!-- Pageview by country -->
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h6 class="card-title card-heading">Pageview by country</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                $resultcountry = mysqli_query($conn, "SELECT visitorcountry as country,sum(pageviews) as pageview FROM pagevisitor p, blog b
                                WHERE p.blogpostid = b.postid GROUP BY visitorcountry");
                                $jsoncountry = [];
                                $jsoncountry2 = [];
                                while ($rowcountry = mysqli_fetch_array($resultcountry)) {
                                    $jsoncountry[] = $rowcountry['country'];
                                    $jsoncountry2[] = $rowcountry['pageview'];
                                }
                                ?>
                                <canvas id="myChartcountry"></canvas>
                            </div>
                            <div class="card-footer text-muted">
                                Overall
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visitor by month -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card ">
                            <div class="card-header ">
                                <h6 class="card-title card-heading">Visitor of <?php echo $month; ?> <?php echo $year; ?></h6>
                            </div>
                            <div class="card-body ">
                                <?php
                                $resultvisitor = mysqli_query($conn, "SELECT b.postid as postid,count(visitorip) as visitor FROM pagevisitor p, blog b 
                                WHERE visitormonth = '$month' AND visitoryear = '$year' AND p.blogpostid = b.postid 
                                GROUP BY blogpostid ORDER BY blogpostid DESC LIMIT 10");
                                $jsonvisitor = [];
                                $jsonvisitor2 = [];
                                while ($rowvisitor = mysqli_fetch_array($resultvisitor)) {
                                    $jsonvisitor[] = $rowvisitor['postid'];
                                    $jsonvisitor2[] = $rowvisitor['visitor'];
                                }
                                ?>
                                <canvas id="myChartvisitor"></canvas>
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
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <script src="js/paper-dashboard.min.js?v=2.0.0" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    <script src="js/main.js"></script>

    <script>
        //Pageview by month
        var ctxmonth = document.getElementById('myAreaChart').getContext('2d');
        var myChartmonth = new Chart(ctxmonth, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($jsonmonth); ?>,
                datasets: [{
                    label: 'Pageview of <?php echo $month; ?> <?php echo $year; ?>',
                    data: <?php echo json_encode($jsonmonth2); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
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

        //Pageview by device
        var ctxdevice = document.getElementById('myChartdevice').getContext('2d');
        var myChartdevice = new Chart(ctxdevice, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($jsondevice); ?>,
                datasets: [{
                    label: 'Pageview by device',
                    data: <?php echo json_encode($jsondevice2); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            display: false
                        }
                    }]
                }
            }
        });

        //Pageview by country
        var ctxcountry = document.getElementById('myChartcountry').getContext('2d');
        var myChartcountry = new Chart(ctxcountry, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($jsoncountry); ?>,
                datasets: [{
                    label: 'Pageview by country',
                    data: <?php echo json_encode($jsoncountry2); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            display: false
                        },
                        ticks: {
                            beginAtZero: true,
                            display: false
                        }
                    }]
                }
            }
        });

        //Visitor by month
        var ctxvisitor = document.getElementById('myChartvisitor').getContext('2d');
        var myChartvisitor = new Chart(ctxvisitor, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($jsonvisitor); ?>,
                datasets: [{
                    label: 'Visitor of <?php echo $month; ?> <?php echo $year; ?>',
                    data: <?php echo json_encode($jsonvisitor2); ?>,
                    backgroundColor: [
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
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