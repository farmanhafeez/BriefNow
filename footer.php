<?php

function navbar()
{
    require 'dbconfig.php';
?>
    <div class="header">
        <nav class="navbar fixed-top navbar-expand-md navbar-light bg-white" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="../">
                    <img src="../img/favicon-32x32.png" class="d-inline-block align-top" alt="Logo">
                    <span class="align-top">BriefNow</span>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active mr-3">
                            <a class="nav-link" href="../">Home</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="../blog/">Blog</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="../blog/category">Category</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link" href="../profile/publish.php">Publish</a>
                        </li>
                        <?php if (!isset($_SESSION['username'])) { ?>
                            <li class="nav-item mr-3">
                                <a class="nav-link" href="../login">Login</a>
                            </li>
                            <li class="nav-item">
                                <a href="../signup"><button type="button" class="btn btn-light">Register</button></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $row = $result->fetch_array(); ?>
                                    <img src="../<?php echo $row['profilepic']; ?>" style="height: 30px;" class="rounded-circle img-fluid" />
                                    <?php echo $_SESSION['username'];
                                    $stmt->close();
                                    ?>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="../profile/dashboard.php"><i class="fas fa-university fa-sm fa-fw mr-2"></i>Dashboard</a>
                                    <a class="dropdown-item" href="../profile/profile.php"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Profile</a>
                                    <a class="dropdown-item" href="../profile/blog.php"><i class="fab fa-blogger-b fa-sm fa-fw mr-2"></i>Blog</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
<?php }

function footer()
{
    $year = date("Y");
?>
    <footer class="bg-light">
        <div class="newsletter py-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                        <h2>Subscribe To Our Newsletter</h2>
                    </div>
                    <div class="col-md-6 text-center">
                        <form action="" method="post" autocomplete="off" class="newsletter-form">
                            <div class="row">
                                <div class="col-md-6 form-group pr-md-1">
                                    <input type="text" name="newsname" id="newsname" class="form-control border-0" placeholder="Name" required>
                                </div>
                                <div class="col-md-6 form-group pl-md-1">
                                    <input type="email" name="newsemail" id="newsemail" class="form-control border-0" placeholder="Email address" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" id="newsbtn">
                                <div id="btn-texts">Subscribe</div>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loaders" style="display: none;"></span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container py-5 foot">
            <div class="row text-md-left text-center align-items-center">
                <div class="col-md-4 col-12 mb-md-0 mb-5">
                    <h2><a class="text-dark" href="../">BriefNow</a></h2>
                    <h3 class="py-2">Read | Write | Share</h3>
                    <div class="row likeimage justify-content-md-left justify-content-center pt-1">
                        <div class="col-2"><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></div>
                        <div class="col-2"><a href="#" class="instagram"><i class="fab fa-instagram"></i></a></div>
                        <div class="col-2"><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></div>
                        <div class="col-2"><a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a></div>
                    </div>
                </div>
                <div class="col-md-2 col-12 mb-3 mb-md-0">
                    <p><a href="../">Home</a></p>
                    <p><a href="../blog/">Blog</a></p>
                    <p class="mb-0"><a href="../contact/">Contact</a></p>
                </div>
                <div class="col-md-2 col-12 mb-3 mb-md-0">
                    <p><a href="../about/">About</a></p>
                    <p><a href="../blog/category">Category</a></p>
                    <p class="mb-0"><a href="../profile/publish.php">Publish</a></p>
                </div>
                <div class="col-md-2 col-12 mb-3 mb-md-0">
                    <p><a href="../profile/profile.php">Profile</a></p>
                    <p><a href="../login">Login</a></p>
                    <p class="mb-0"><a href="../signup">Register</a></p>
                </div>
                <div class="col-md-2 col-12">
                    <p><a href="../feedback/">Feedback</a></p>
                    <p><a href="#">Privacy Policy</a></p>
                    <p class="mb-0"><a href="#">Terms & Condition</a></p>
                </div>
            </div>
        </div>
        <div class="text-center text-muted pb-3">
            <p class="m-0">&copy; <?php echo $year; ?> | BriefNow.in | All Rights Reserved.</p>
        </div>
    </footer>
<?php
}

function scriptCode()
{
?>
    <script>
        $(document).ready(function() {
            $('#newsbtn').click(function(event) {
                event.preventDefault();
                $('#btn-texts').hide();
                $('#loaders').show();
                var formData = $('.newsletter-form').serialize();
                $.ajax({
                    url: '../query.php',
                    method: 'post',
                    data: formData + '&action=newsletter'
                }).done(function(result) {
                    var data = JSON.parse(result);
                    $("#loaders").hide();
                    $("#btn-texts").show();
                    if (data.status == 1 || data.status == 2 || data.status == 4) {
                        alert(data.msg);
                    } else if (data.status == 3) {
                        alert(data.msg);
                        $('.newsletter-form')[0].reset();
                    }
                })
            })
        })
    </script>
<?php }
?>