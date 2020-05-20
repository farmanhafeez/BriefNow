<?php

require 'dbconfig.php';
require 'session.php';
include 'footer.php';

// Date conversion
function returnDate($date)
{
    $blogdate = date('d M Y', strtotime($date));
    return $blogdate;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Category</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <a href="#" class="back-to-top"><i class="fas fa-angle-double-up"></i></a>

    <!---------- NAVBAR ---------->

    <?php navbar(); ?>

    <!---------- HEADER ---------->

    <div class="hero-section" style="height: 70vh;background: 
		linear-gradient(to right,rgba(39, 70, 133, 0.9) 0%,rgba(61, 179, 197, 0.9) 100%),url('../img/hero-bg.jpg');">
        <div class="wave">
            <svg width="100%" height="250px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
                        <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
                    </g>
                </g>
            </svg>
        </div>
        <div class="inner-page d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row m-0">
                    <div class="col-12 text-center px-0">
                        <h1 class="text-capitalize">Category</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---------- CONTAINER ---------->

    <div class="first-section ">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="category col-lg-8 pt-0">
                    <h2 class="section-heading mb-2">Category</h2>
                    <p class="text-muted mb-4">Select what you're into. We'll help you find great things to read.</p>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Affiliate">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-success"><i class="fas fa-hand-holding-usd"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Affiliate</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Animal">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-info"><i class="fas fa-paw"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Animal</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Books">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-danger"><i class="fas fa-book"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Books</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Business">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-warning"><i class="fas fa-briefcase"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Business</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/DIY">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-dark"><i class="fas fa-drafting-compass"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">DIY</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Education">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-success"><i class="fas fa-university"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Education</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Fashion">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-info"><i class="fas fa-tshirt"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Fashion</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Finance">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-danger"><i class="fas fa-piggy-bank"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Finance</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Food">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-warning"><i class="fas fa-hamburger"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Food</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Gaming">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-dark"><i class="fas fa-headset"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Gaming</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Fitness">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-success"><i class="fas fa-heartbeat"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Health</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Lifestyle">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-info"><i class="fas fa-hand-holding-heart"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Lifestyle</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Music">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-danger"><i class="fas fa-music"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Music</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Movie">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-warning"><i class="fas fa-film"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Movie</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/News">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-dark"><i class="fas fa-newspaper"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">News</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Parenting">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-success"><i class="fas fa-users"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Parenting</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Personal">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-info"><i class="fas fa-male"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Personal</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Politics">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-danger"><i class="fas fa-balance-scale"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Politics</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Programming">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-warning"><i class="fas fa-laptop-code"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Programming</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Review">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-dark"><i class="fas fa-microphone"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Review</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Sports">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-success"><i class="fas fa-swimmer"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Sports</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Science">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-info"><i class="fas fa-microscope"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Science</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Technology">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-danger"><i class="fas fa-desktop"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Technology</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Travel">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-warning"><i class="fas fa-route"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Travel</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Vehicle">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-dark"><i class="fas fa-car"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Vehicle</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <a class="text-primary" href="../result/Other">
                                        <div class="row align-items-center">
                                            <div class="col-4"><span class="text-success"><i class="fas fa-quote-right"></i></span></div>
                                            <div class="col-8 text-left">
                                                <h3 class="m-0">Other</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!---------- RIGHT COLUMN ---------->

                <div class="rightcolumn col-lg-3">

                    <!----- SEARCH BOX ----->

                    <div class="card mb-3 border-0">
                        <div class="card-body bg-light">
                            <form action="../searchresult.php" method="get">
                                <input type="search" name="search" id="search" class="form-control" placeholder="Search blog..." required>
                            </form>
                        </div>
                    </div>

                    <!----- RECENT POST ----->

                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="card mb-2 border-0">
                                <h3 class="card-header text-primary">Recent posts</h3>
                                <div class="card-body pt-2">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM blog ORDER by postid DESC LIMIT 5");
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <p class="text-dark text-capitalize"><small><i class="fas fa-chevron-right"></i></small>
                                            <a class="text-dark" href="../post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a><br>
                                            <small class="text-muted">Posted on: <?php echo returnDate($row['blogdate']); ?></small></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <!----- POPULAR POST ----->

                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="card mb-2 border-0">
                                <h3 class="card-header text-primary">Popular posts</h3>
                                <div class="card-body pt-2">
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM blog ORDER by count DESC LIMIT 5");
                                    while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <p class="text-dark text-capitalize"><small><i class="fas fa-chevron-right"></i></small>
                                            <a class="text-dark" href="../post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a><br>
                                            <small class="text-muted">Posted on: <?php echo returnDate($row['blogdate']); ?></small></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!---------- FOOTER ---------->

    <?php footer(); ?>

    <!--------------- JAVASCRIPT CODE --------------->

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c49c7cca2f48abe"></script>

    <script src="../js/main.js"></script>

    <!-- Newsletter Ajax code -->
    <?php scriptCode(); ?>

</body>

</html>