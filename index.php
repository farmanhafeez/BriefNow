<?php

require 'dbconfig.php';
require 'session.php';

unset($_SESSION['url']);
unset($_SESSION["login_redirect"]);

//Account verification
$token = isset($_GET['token']) ? $_GET['token'] : '';

$year = date("Y");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BriefNow | Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
	<link rel="manifest" href="img/site.webmanifest">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<a href="#" class="back-to-top"><i class="fas fa-angle-double-up"></i></a>

	<!---------- NAVBAR ---------->

	<div class="header">
		<nav class="navbar fixed-top navbar-expand-md navbar-light bg-white" id="navbar">
			<div class="container">
				<a class="navbar-brand" href="./">
					<img src="img/favicon-32x32.png" class="d-inline-block align-top" alt="Logo">
					<span class="align-top">BriefNow</span>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item active mr-3">
							<a class="nav-link" href="./">Home</a>
						</li>
						<li class="nav-item mr-3">
							<a class="nav-link" href="blog/">Blog</a>
						</li>
						<li class="nav-item mr-3">
							<a class="nav-link" href="blog/category">Category</a>
						</li>
						<li class="nav-item mr-3">
							<a class="nav-link" href="profile/publish.php">Publish</a>
						</li>
						<?php if (!isset($_SESSION['username'])) { ?>
							<li class="nav-item mr-3">
								<a class="nav-link" href="login">Login</a>
							</li>
							<li class="nav-item">
								<a href="signup"><button type="button" class="btn btn-light">Register</button></a>
							</li>
						<?php } else { ?>
							<li class="nav-item dropdown">
								<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php
									$stmt = $conn->prepare("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
									$stmt->execute();
									$result = $stmt->get_result();
									$row = $result->fetch_array(); ?>
									<img src="<?php echo $row['profilepic']; ?>" style="height: 30px;" class="rounded-circle img-fluid" />
									<?php echo $_SESSION['username'];
									$stmt->close();
									?>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="profile/dashboard.php"><i class="fas fa-university fa-sm fa-fw mr-2"></i>Dashboard</a>
									<a class="dropdown-item" href="profile/profile.php"><i class="fas fa-user fa-sm fa-fw mr-2"></i>Profile</a>
									<a class="dropdown-item" href="profile/blog.php"><i class="fab fa-blogger-b fa-sm fa-fw mr-2"></i>Blog</a>
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

	<!---------- HEADER ---------->

	<div class="hero-section" style="background: 
		linear-gradient(to right,rgba(39, 70, 133, 0.9) 0%,rgba(61, 179, 197, 0.9) 100%),url('img/hero-bg.jpg');">
		<div class="wave">
			<svg width="100%" height="300px" viewBox="0 0 1920 355" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
						<path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,757 L1017.15166,757 L0,757 L0,439.134243 Z" id="Path">
						</path>
					</g>
				</g>
			</svg>
		</div>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 text-md-left text-center">
					<h2><img src="img/favicon-32x32.png" class="d-inline-block align-top" alt="Logo">
						<span class="align-top">BriefNow</span></h2>
					<h1 class="py-3">Publish your passions, your way</h1>
					<h2 class="pb-3">A free portal for readers and publishers</h2>
					<a class="pt-3" href="signup"><button class="btn btn-lg btn-outline-light">Get started</button></a>
				</div>
				<div class="col-md-6 d-md-block d-sm-none">
					<img src="img/blogging.svg" alt="Briefnow" class="img-fluid">
				</div>
			</div>
		</div>
	</div>

	<!---------- CATEGORY ---------->

	<div class="first-section category">
		<div class="container">
			<div class="col-12 text-center">
				<h2 class="section-heading mb-3">Category</h2>
				<p class="text-muted mb-5">Select what you're into. We'll help you find great things to read.</p>
				<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Affiliate">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Animal">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Books">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Business">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/DIY">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Education">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Fashion">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Finance">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Food">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Gaming">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Fitness">
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
					<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="result/Lifestyle">
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
				</div>
				<div class="row justify-content-center">
					<div class="col-lg-3 col-md-4 col-sm-6">
						<div class="card">
							<div class="card-body">
								<a class="text-primary" href="blog/category">
									<div class="row align-items-center">
										<div class="col-8 text-right">
											<h3 class="m-0">Browse more</h3>
										</div>
										<div class="col-4 text-left"><span class="text-danger"><i class="fas fa-angle-double-right"></i></span></div>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!---------- POPULAR POST ---------->

	<div class="site-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<h2 class="section-heading">Popular post</h2>
			</div>
			<div class="row">
				<?php
				$stmt = $conn->prepare("SELECT * FROM blog WHERE listed = '1' ORDER BY count DESC LIMIT 4");
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_array()) {
					$description = substr($row['description'], 0, 100);
				?>
					<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
						<div class="card border-primary h-100">
							<div class="card-body text-primary">
								<a class="text-primary" href="post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>">
									<h4 class="card-title line-height"><?php echo $row['title']; ?></h4>
								</a>
								<p class="card-text text-primary"><?php echo $description . "..."; ?></p>
							</div>
							<div class="card-footer pt-0">
								<?php
								$result2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $row['author'] . "'");
								$row2 = mysqli_fetch_array($result2);
								?>
								<a class="small text-muted m-0 p-0" href="user/<?php echo $row['author']; ?>">
									<img src="<?php echo $row2['profilepic']; ?>" height="30" class="rounded-circle mr-1" />@<?php echo $row['author']; ?>
								</a>
							</div>
						</div>
					</div>
				<?php
				}
				$stmt->close();
				?>
			</div>
		</div>
	</div>

	<!---------- RECENT POST ---------->

	<div class="site-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<h2 class="section-heading">Recent post</h2>
			</div>
			<div class="row">
				<?php
				$stmt = $conn->prepare("SELECT * FROM blog WHERE listed = '1' ORDER by postid DESC LIMIT 4");
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_array()) {
					$description = substr($row['description'], 0, 100);
				?>
					<div class="col-sm-6 col-lg-3 mb-3 mb-lg-0">
						<div class="card text-white bg-primary h-100">
							<div class="card-body">
								<a class="text-white" href="post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>">
									<h4 class="card-title line-height"><?php echo $row['title']; ?></h4>
								</a>
								<p class="card-text"><?php echo $description . "..."; ?></p>
							</div>
							<div class="card-footer bg-primary pt-0">
								<?php
								$result2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $row['author'] . "'");
								$row2 = mysqli_fetch_array($result2);
								?>
								<a class="small text-white m-0 p-0" href="user/<?php echo $row['author']; ?>">
									<img src="<?php echo $row2['profilepic']; ?>" height="30" class="rounded-circle mr-1" />@<?php echo $row['author']; ?>
								</a>
							</div>
						</div>
					</div>
				<?php
				}
				$stmt->close();
				?>
			</div>
		</div>
	</div>

	<!---------- BLOG POST ---------->

	<div class="site-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<h2 class="section-heading">Blog post</h2>
			</div>
			<div class="row">
				<?php
				$stmt = $conn->prepare("SELECT * FROM blog WHERE listed = '1' ORDER BY postid DESC LIMIT 12");
				$stmt->execute();
				$result = $stmt->get_result();
				while ($row = $result->fetch_array()) {
					$date = $row['blogdate'];
					$blogdate = date('d M Y', strtotime($date));
				?>
					<div class="col-sm-6 col-lg-4 mb-3 mb-lg-0">
						<div class="card border-0 box-shadow">
							<img src="<?php echo $row['thumbnail']; ?>" class="card-img-top" alt="<?php echo $row['title']; ?>">
							<div class="card-body">
								<h4 class="card-title line-height">
									<a class="text-dark" href="post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a>
								</h4>
								<p class="card-text text-muted"><?php echo $row['description']; ?></p>
							</div>
							<div class="card-footer">
								<div class="d-flex justify-content-between">
									<?php
									$result2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $row['author'] . "'");
									$row2 = mysqli_fetch_array($result2);
									?>
									<a class="small text-muted m-0 p-0" href="user/<?php echo $row['author']; ?>">
										<img src="<?php echo $row2['profilepic']; ?>" height="30" class="rounded-circle mr-1" />@<?php echo $row['author']; ?>
									</a>
									<p class="card-text m-0"><small class="text-muted">Posted on: <?php echo $blogdate; ?></small></p>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				$stmt->close();
				?>
			</div>
			<div class="row justify-content-center">
				<a href="blog/">
					<button class="btn btn-light">Show all post <span class="ml-2"><i class="fas fa-angle-double-right"></i></span></button>
				</a>
			</div>
		</div>
	</div>

	<!---------- ACCOUNT VERIFICATION ---------->

	<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLongTitle">Accout Verification</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<?php
					if (!empty($token)) {
						$session = $conn->prepare("SELECT * FROM users WHERE token = ?");
						$session->bind_param("s", $token);
						$session->execute();
						$result = $session->get_result();
						if ($result->num_rows == 1) {
							$stmt = $conn->prepare("SELECT * FROM users WHERE token = ? AND active = 1");
							$stmt->bind_param("s", $token);
							$stmt->execute();
							$result1 = $stmt->get_result();
							if ($result1->num_rows == 1) { ?>
								<div class="alert alert-success" role="alert" id="success">
									<i class="fas fa-check-circle"></i> Your account is already activated
								</div>
								<?php } else {
								$activationdate = date("Y-m-d");
								$updateresult = $conn->prepare("UPDATE USERS SET active = 1, activationdate = '$activationdate' WHERE token = ?");
								$updateresult->bind_param("s", $token);
								if ($updateresult->execute()) { ?>
									<div class="alert alert-success" role="alert" id="success">
										<i class="fas fa-check-circle"></i> Your Account has been activated
									</div>
								<?php } else { ?>
									<div class="alert alert-danger" role="alert" id="alert">
										<i class="fas fa-exclamation-circle"></i> Account could not be activated
									</div>
							<?php }
							}
						} else { ?>
							<div class="alert alert-danger" role="alert" id="alert">
								<i class="fas fa-exclamation-circle"></i> Invalid token ID!
							</div>
					<?php }
					}
					?>
				</div>
				<div class="modal-footer">
					<a href="./"><button type="button" class="btn btn-outline-dark">Close</button></a>
					<a href="profile/profile.php"><button type="button" class="btn btn-primary">Complete your profile</button></a>
				</div>
			</div>
		</div>
	</div>

	<!---------- FOOTER ---------->

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
					<h2><a class="text-dark" href="">BriefNow</a></h2>
					<h3 class="py-2">Read | Write | Share</h3>
					<div class="row likeimage justify-content-md-left justify-content-center pt-1">
						<div class="col-2"><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></div>
						<div class="col-2"><a href="#" class="instagram"><i class="fab fa-instagram"></i></a></div>
						<div class="col-2"><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></div>
						<div class="col-2"><a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a></div>
					</div>
				</div>
				<div class="col-md-2 col-12 mb-3 mb-md-0">
					<p><a href="">Home</a></p>
					<p><a href="blog/">Blog</a></p>
					<p class="mb-0"><a href="contact/">Contact</a></p>
				</div>
				<div class="col-md-2 col-12 mb-3 mb-md-0">
					<p><a href="about/">About</a></p>
					<p><a href="blog/category">Category</a></p>
					<p class="mb-0"><a href="profile/publish.php">Publish</a></p>
				</div>
				<div class="col-md-2 col-12 mb-3 mb-md-0">
					<p><a href="profile/profile.php">Profile</a></p>
					<p><a href="login">Login</a></p>
					<p class="mb-0"><a href="signup">Register</a></p>
				</div>
				<div class="col-md-2 col-12">
					<p><a href="feedback/">Feedback</a></p>
					<p><a href="#">Privacy Policy</a></p>
					<p class="mb-0"><a href="#">Terms & Condition</a></p>
				</div>
			</div>
		</div>
		<div class="text-center text-muted pb-3">
			<p class="m-0">&copy; <?php echo $year; ?> | BriefNow.in | All Rights Reserved.</p>
		</div>
	</footer>

	<!--------------- JAVASCRIPT CODE --------------->

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="js/main.js"></script>

	<?php if (!empty($token)) { ?>
		<script>
			$(document).ready(function() {
				$("#staticBackdrop").modal('show');
			});
		</script>
	<?php } ?>

	<script>
		$(document).ready(function() {
			$('#newsbtn').click(function(event) {
				event.preventDefault();
				$('#btn-texts').hide();
				$('#loaders').show();
				var formData = $('.newsletter-form').serialize();
				$.ajax({
					url: 'query.php',
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

</body>

</html>