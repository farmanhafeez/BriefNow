<?php

require 'dbconfig.php';
require 'session.php';
include 'footer.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BriefNow | About Us</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
	<link rel="manifest" href="../img/site.webmanifest">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
	<link href="../vendor/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />
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
						<h1 class="text-capitalize">About Us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!---------- IDEA AND PERSPECTIVE ---------->

	<div class="first-section">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-5 mr-auto">
					<h2 class="section-heading mb-3">Ideas and perspectives you won't find anywhere else.</h2>
					<h4 class="font-weight-normal text-muted" style="line-height: 30px;">
						BriefNow taps into the brains of the worlds most insightful writers, thinkers, and
						storytellers to bring you the smartest takes on topics that matter. So whatever your
						interest, you can always find fresh thinking and unique perspectives.</h4>
				</div>
				<div class="col-md-6">
					<img src="../img/new_ideas.svg" alt="Ideas and perspectives you won't find anywhere else." class="img-fluid">
				</div>
			</div>
		</div>
	</div>

	<!---------- PLATFORM ---------->

	<div class="site-section category">
		<div class="container">
			<div class="col-12 text-center">
				<h2 class="section-heading mb-5">A platform built for</h2>
				<div class="row">
					<div class="col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-4"><span class="text-success"><i class="fas fa-users"></i></span></div>
									<div class="col-8 text-left">
										<h3 class="text-primary m-0">People</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-4"><span class="text-info"><i class="fas fa-clipboard-check"></i></span></div>
									<div class="col-8 text-left">
										<h3 class="text-primary m-0">Quality</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-4"><span class="text-danger"><i class="fas fa-lightbulb"></i></span></div>
									<div class="col-8 text-left">
										<h3 class="text-primary m-0">Original Ideas</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-4"><span class="text-warning"><i class="fas fa-book-reader"></i></span></div>
									<div class="col-8 text-left">
										<h3 class="text-primary m-0">Clean reading experience</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-4"><span class="text-dark"><i class="fas fa-ring"></i></span></div>
									<div class="col-8 text-left">
										<h3 class="text-primary m-0">Engagement and Depth</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 mb-4">
						<div class="card">
							<div class="card-body">
								<div class="row align-items-center">
									<div class="col-4"><span class="text-success"><i class="fas fa-eye"></i></span></div>
									<div class="col-8 text-left">
										<h3 class="text-primary m-0">Viewpoints</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!---------- FEATURES ---------->

	<div class="site-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<h2 class="section-heading">Why choose us?</h2>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card border-0 box-shadow h-100 text-center" style="border-radius: 20px;">
						<div class="card-body">
							<h1 class="text-primary my-3" style="font-size: 50px;"><i class="fas fa-palette"></i></h1>
							<h2>Design</h2>
							<p class="text-muted line-height" style="font-size: 15px;">
								Our blog layout is created in the focus for a publishers like you.
								Clean and easy navigate design the fits your style.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card border-0 box-shadow h-100 text-center" style="border-radius: 20px;">
						<div class="card-body">
							<h1 class="text-success my-3" style="font-size: 50px;"><i class="fas fa-rupee-sign"></i></h1>
							<h2>Free</h2>
							<p class="text-muted line-height" style="font-size: 15px;">
								BriefNow is completely a free CMS with no hidden charge.
								You can create N number of blogs for free.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card border-0 box-shadow h-100 text-center" style="border-radius: 20px;">
						<div class="card-body">
							<h1 class="text-warning my-3" style="font-size: 50px;"><i class="fas fa-layer-group"></i></h1>
							<h2>No domain / hosting</h2>
							<p class="text-muted line-height" style="font-size: 15px;">
								No need the buy a domain or buy hosting to publish your blog.
								we got everything you need, so you can blog easily.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card border-0 box-shadow h-100 text-center" style="border-radius: 20px;">
						<div class="card-body">
							<h1 class="text-danger my-3" style="font-size: 50px;"><i class="fas fa-university"></i></h1>
							<h2>Dashboard</h2>
							<p class="text-muted line-height" style="font-size: 15px;">
								Find out which posts are a hit with Blogger’s built-in analytics.
								You’ll see where your audience is coming from and what they’re interested in.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card border-0 box-shadow h-100 text-center" style="border-radius: 20px;">
						<div class="card-body">
							<h1 class="text-info my-3" style="font-size: 50px;"><i class="fas fa-users-cog"></i></h1>
							<h2>Admin panel</h2>
							<p class="text-muted line-height" style="font-size: 15px;">
								We have a powerful admin panel for you where you can manage your blog,
								profile or view analytics for your blog.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 mb-4">
					<div class="card border-0 box-shadow h-100 text-center" style="border-radius: 20px;">
						<div class="card-body">
							<h1 class="text-secondary my-3" style="font-size: 50px;"><i class="fas fa-shield-alt"></i></h1>
							<h2>Security</h2>
							<p class="text-muted line-height" style="font-size: 15px;">
								BriefNow created in a secure procedure. We have encrytion method to protect your data
								from hackers or cyberattacks. No need to worry about SQL Injection.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!---------- TESTIMONIAL ---------->

	<div class="site-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<div class="col-md-6">
					<h2 class="section-heading">Testimonials</h2>
				</div>
			</div>
			<div class="row justify-content-center text-center">
				<div class="col-md-7">
					<div class="owl-carousel testimonial-carousel">
						<?php
						$result = mysqli_query($conn, "SELECT * FROM feedback WHERE experience = 'Good' OR experience = 'Average' LIMIT 3");
						while ($row = mysqli_fetch_array($result)) {
						?>
							<div class="review text-center">
								<p class="stars">
									<span class="fa fa-star"></span>
									<?php
									if ($row['experience'] == 'Good') { ?>
										<span class="fa fa-star"></span>
										<span class="fa fa-star"></span>
									<?php } elseif ($row['experience'] == 'Average') { ?>
										<span class="fa fa-star"></span>
										<span class="fa fa-star muted"></span>
									<?php } elseif ($row['experience'] == 'Bad') { ?>
										<span class="fa fa-star muted"></span>
										<span class="fa fa-star muted"></span>
									<?php }
									?>
								</p>
								<h3><?php echo $row['experience']; ?>!</h3>
								<blockquote>
									<p><?php echo $row['feedmessage']; ?></p>
								</blockquote>

								<p class="review-user">
									<img src="../img/apple-touch-icon.png" alt="Image" class="img-fluid rounded-circle mb-3" />
									<span class="d-block">
										<span class="text-black"><?php echo $row['feedname']; ?></span>
									</span>
								</p>
							</div>
						<?php } ?>
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
	<script src="../vendor/owlcarousel/owl.carousel.min.js"></script>

	<script src="../js/main.js"></script>

	<!-- Newsletter Ajax code -->
	<?php scriptCode(); ?>

	<script>
		$(document).ready(function() {
			$('.testimonial-carousel').owlCarousel({
				center: true,
				items: 1,
				loop: true,
				margin: 0,
				autoplay: true,
				smartSpeed: 1000,
			});
		})
	</script>

</body>

</html>