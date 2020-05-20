<?php

require '../dbconfig.php';
require 'session.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>BriefNow | Contact</title>
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
                    <li class="active"><a href="contact.php"><i class="fas fa-address-book"></i>
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
                        <a class="navbar-brand">Contact</a>
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
                                    <a class="dropdown-item" href="contact.php?logout='1'"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <!-- Contact table -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title card-heading">Contact messages</h5>
                            </div>
                            <div class="card-body ">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">Contact ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Message</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $conn->prepare("SELECT * FROM contact");
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            while ($row = $result->fetch_array()) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $row['contactid']; ?></th>
                                                    <td><?php echo $row['contactname']; ?></td>
                                                    <td><?php echo $row['contactemail']; ?></td>
                                                    <td><?php $limit = 50;
                                                        $contactmessage = substr($row['contactmessage'], 0, $limit);
                                                        echo $contactmessage; ?>...</td>
                                                    <td><?php $date = $row['contactdate'];
                                                        $contactdate = date('d M Y', strtotime($date));
                                                        echo "$contactdate"; ?></td>
                                                    <td class="text-center">
                                                        <a class="text-muted" id="tableAction" data-toggle="dropdown" style="cursor:pointer;font-size:20px;"><i class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu" aria-labelledby="tableAction" style="box-shadow: 1px 2px 7px 1px rgba(0, 0, 0, 0.125);">
                                                            <a class="btn btn-link btn-sm dropdown-item view-contact-btn" name="<?php echo $row['contactname']; ?>" email="<?php echo $row['contactemail']; ?>" data-toggle="modal" data-target="#deleteContactModal<?php echo $row['contactid']; ?>">
                                                                <i class="fas fa-eye"></i> View
                                                            </a>
                                                            <form action="" method="post" id="delete-contact-form">
                                                                <input type="hidden" name="contactid" class="contactid">
                                                            </form>
                                                            <a class="btn btn-link btn-sm dropdown-item delete-contact-btn" contactid="<?php echo $row['contactid']; ?>">
                                                                <i class="fas fa-trash-alt"></i> Delete
                                                            </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    <!-- View contact message -->
                                                    <div class="modal fade" id="deleteContactModal<?php echo $row['contactid']; ?>" tabindex="-1" role="dialog" aria-labelledby="deletepostmodal" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Feedback</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php
                                                                    $contactid = $row['contactid']; ?>
                                                                    <?php
                                                                    $stmt1 = $conn->prepare("SELECT * FROM contact WHERE contactid = ?");
                                                                    $stmt1->bind_param("s", $contactid);
                                                                    $stmt1->execute();
                                                                    $result1 = $stmt1->get_result();
                                                                    $row1 = $result1->fetch_array() ?>
                                                                    <div class="row my-3">
                                                                        <div class="col-sm-3 font-weight-bold">Feedback ID</div>
                                                                        <div class="col-sm-9"><?php echo $row1['contactid']; ?></div>
                                                                    </div>
                                                                    <div class="row my-3">
                                                                        <div class="col-sm-3 font-weight-bold">Name</div>
                                                                        <div class="col-sm-9"><?php echo $row1['contactname']; ?></div>
                                                                    </div>
                                                                    <div class="row my-3">
                                                                        <div class="col-sm-3 font-weight-bold">Email</div>
                                                                        <div class="col-sm-9"><?php echo $row1['contactemail']; ?></div>
                                                                    </div>
                                                                    <div class="row my-3">
                                                                        <div class="col-sm-3 font-weight-bold">Feedback</div>
                                                                        <div class="col-sm-9"><?php echo $row1['contactmessage']; ?></div>
                                                                    </div>
                                                                    <div class="row my-3">
                                                                        <div class="col-sm-3 font-weight-bold">Date</div>
                                                                        <div class="col-sm-9">
                                                                            <?php $date = $row['contactdate'];
                                                                            $contactdate = date('d M Y', strtotime($date));
                                                                            echo "$contactdate"; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                                    <form action="email.php" method="post">
                                                                        <input type="hidden" name="name" class="contactname">
                                                                        <input type="hidden" name="email" class="contactemail">
                                                                        <button type="submit" class="btn btn-primary">Send message</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
            //View contact
            $(document).on('click', '.view-contact-btn', function() {
                var contactname = $(this).attr('name');
                var contactemail = $(this).attr('email');
                console.log(contactname);
                console.log(contactemail);
                $('.contactname').val(contactname);
                $('.contactemail').val(contactemail);
            })

            //Delete contact
            $(document).on('click', '.delete-contact-btn', function() {
                var tr = this;
                var contactid = $(this).attr('contactid');
                console.log(contactid);
                $(".contactid").val(contactid);
                var formData = $('#delete-contact-form').serialize();
                console.log(formData);
                $.ajax({
                    url: 'query.php',
                    method: 'post',
                    data: formData + '&action=deletecontact'
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