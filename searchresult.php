<?php

require 'dbconfig.php';
require 'session.php';

// Date conversion
function returnDate($date)
{
	$blogdate = date('d M Y', strtotime($date));
	return $blogdate;
}

$search = isset($_GET['search']) ? $_GET['search'] : '';

$results = mysqli_query($conn, "SELECT * FROM blog WHERE MATCH(title,author,categories,tags) AGAINST('$search*' IN BOOLEAN MODE) AND listed = '1' ORDER by postid DESC");

if (empty($search)) {
	header('Location: ../404.php');
}

$year = date("Y");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BriefNow | Search Result</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
	<link rel="manifest" href="img/site.webmanifest">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
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

	<div class="hero-section" style="height: 70vh;background: 
	linear-gradient(to right,rgba(39, 70, 133, 0.9) 0%,rgba(61, 179, 197, 0.9) 100%),url('img/hero-bg.jpg');">
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
						<h1>Showing Results for "<?php echo $search; ?>"</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!---------- BLOG POST ---------->

	<div class="first-section">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-lg-8 pb-3 pb-md-0 px-0">

					<!----- SEARCH BOX ----->

					<div class="card mb-3 border-0">
						<div class="card-body bg-light">
							<form action="searchresult.php" method="get">
								<input type="search" name="search" id="search" class="form-control" placeholder="Search blog..." required>
							</form>
						</div>
					</div>

					<!----- BLOG ----->

					<div class="table-responsive">
						<table class="table">
							<thead class="d-none">
								<tr>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php
								while ($row = mysqli_fetch_array($results)) { ?>
									<tr>
										<td class="border-0">
											<div class="card border-0 box-shadow">
												<div class="row no-gutters">
													<div class="col-md-5">
														<img src="<?php echo $row['thumbnail']; ?>" class="card-img h-100" alt="<?php echo $row['title']; ?>">
													</div>
													<div class="col-md-7 d-flex align-content-between flex-column">
														<div class="card-body">
															<h3 class="card-title line-height">
																<a class="text-dark" href="post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a>
															</h3>
															<p class="card-text text-muted" style="font-size: 15px;"><?php echo $row['description']; ?></p>
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
																<p class="card-text m-0"><small class="text-muted">Posted on: <?php echo returnDate($row['blogdate']); ?></small></p>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

				<!---------- RIGHT COLUMN ---------->

				<div class="col-lg-3">

					<!----- RECENT POST ----->

					<div class="row">
						<div class="col-12 col-md-6 col-lg-12">
							<div class="card mb-2 border-0">
								<h3 class="card-header text-primary">Recent posts</h3>
								<div class="card-body pt-2">
									<?php
									$result = mysqli_query($conn, "SELECT * FROM blog WHERE listed = '1' ORDER by postid DESC LIMIT 5");
									while ($row = mysqli_fetch_array($result)) {
									?>
										<p class="text-dark text-capitalize"><small><i class="fas fa-chevron-right"></i></small>
											<a class="text-dark" href="post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a><br>
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
									$result = mysqli_query($conn, "SELECT * FROM blog WHERE listed = '1' ORDER by count DESC LIMIT 5");
									while ($row = mysqli_fetch_array($result)) {
									?>
										<p class="text-dark text-capitalize"><small><i class="fas fa-chevron-right"></i></small>
											<a class="text-dark" href="post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a><br>
											<small class="text-muted">Posted on: <?php echo returnDate($row['blogdate']); ?></small></p>
									<?php } ?>
								</div>
							</div>
						</div>

						<!----- CATEGORY ----->

						<div class="col-12 col-md-6 col-lg-12">
							<div class="card mb-2 border-0">
								<h3 class="card-header text-primary">Category</h3>
								<div class="card-body pt-2">
									<?php
									$result = mysqli_query($conn, "SELECT distinct(categories) FROM blog WHERE listed = '1' ORDER by categories ASC");
									while ($row = mysqli_fetch_array($result)) {
										$result1 = mysqli_query($conn, "SELECT count(categories) as count FROM blog WHERE listed = '1' AND categories = '" . $row['categories'] . "'");
										$row1 = mysqli_fetch_array($result1);
									?>
										<a href="result/<?php echo $row['categories']; ?>">
											<button class="btn btn-light btn-sm mb-2">
												<?php echo $row['categories']; ?><span class="badge badge-primary ml-1"><?php echo $row1['count']; ?></span>
											</button>
										</a>
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
					<h2><a class="text-dark" href="./">BriefNow</a></h2>
					<h3 class="py-2">Read | Write | Share</h3>
					<div class="row likeimage justify-content-md-left justify-content-center pt-1">
						<div class="col-2"><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></div>
						<div class="col-2"><a href="#" class="instagram"><i class="fab fa-instagram"></i></a></div>
						<div class="col-2"><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></div>
						<div class="col-2"><a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a></div>
					</div>
				</div>
				<div class="col-md-2 col-12 mb-3 mb-md-0">
					<p><a href="./">Home</a></p>
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
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

	<script src="js/main.js"></script>

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

	<script>
		$(document).ready(function() {
			$('.table').DataTable({
				stateSave: true,
				"searching": false,
				"order": [
					[0, "desc"]
				]
			});
		});
	</script>

</body>

</html>