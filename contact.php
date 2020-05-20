<?php

require 'dbconfig.php';
require 'session.php';
include 'footer.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BriefNow | Contact Us</title>
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
						<h1 class="text-capitalize">Contact Us</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!---------- CONTAINER ---------->

	<div class="container first-section">
		<div class="row justify-content-around">
			<div class="col-md-7 mb-5 mb-md-0">
				<h2 class="section-heading mb-2">Get in Touch</h2>
				<p class="text-muted mb-4">Please fill out the quick form and we will be in touch with lightning speed.</p>
				<div class="alert alert-danger" role="alert" id="alert" style="display: none">
					<div id="error-result" class="small"></div>
				</div>
				<div class="alert alert-success" role="alert" id="success" style="display: none">
					<div id="success-result" class="small"></div>
				</div>
				<form method="post" action="" id="contact-form" autocomplete="off" class="needs-validation" novalidate>
					<?php if (!isset($_SESSION['username'])) : ?>
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="contactname">Name <span style="color: red;">*</span></label>
								<input type="text" class="form-control" placeholder="Name" name="contactname" id="contactname" required />
							</div>
							<div class="col-md-6 form-group">
								<label for="contactemail">Email <span style="color: red;">*</span></label>
								<input type="email" class="form-control" placeholder="Email" name="contactemail" id="contactemail" required />
							</div>
						</div>
					<?php endif ?>

					<div class="form-group">
						<label for="contactsubject">Subject <span style="color: red;">*</span></label>
						<input type="text" class="form-control" placeholder="Subject" id="contactsubject" name="contactsubject" required>
					</div>

					<div class="form-group">
						<label for="contactmessage">Message <span style="color: red;">*</span></label>
						<textarea rows="8" class="form-control" placeholder="Message" id="contactmessage" name="contactmessage" required></textarea>
					</div>

					<button type="submit" class="btn btn-block btn-primary" id="contact-btn">
						<div class="btn-text">Send message</div>
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
					</button>
				</form>
				<span class="form-text text-danger mt-3 small">Fields marked as * are mandatory fields</span>
			</div>
			<div class="col-md-4">
				<h2 class="section-heading mb-5">Connect with us</h2>
				<h4><i class="fas fa-map-marker-alt"></i> Address</h4>
				<p class="ml-3 mb-4 text-muted">12/31, Thahir Street, Pernambut, Tamilnadu, India - 635810</p>
				<h4><i class="fas fa-mobile-alt"></i> Lets Talk</h4>
				<p class="ml-3 mb-4 text-muted">+91 9092173696</p>
				<h4><i class="fas fa-envelope"></i> General Support</h4>
				<p class="ml-3 text-muted">farmanhafeezj@gmail.com</p>
			</div>
		</div>
	</div>

	<!---------- FOOTER ---------->

	<?php footer(); ?>

	<!--------------- JAVASCRIPT CODE --------------->

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<script src="../js/main.js"></script>

	<!-- Newsletter Ajax code -->
	<?php scriptCode(); ?>

	<script>
		$(document).ready(function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				$('#contact-btn').click(function(event) {
					event.preventDefault();
					$('.btn-text').hide();
					$('#loader').show();
					$('#alert').hide();
					$('#success').hide();
					var formData = $('#contact-form').serialize();
					console.log(formData);
					$.ajax({
						url: '../query.php',
						method: 'post',
						data: formData + '&action=contactresponse'
					}).done(function(result) {
						console.log(result);
						var data = JSON.parse(result);
						if (data.status == 1 || data.status == 2 || data.status == 3) {
							setTimeout(function() {
								$('.btn-text').show();
								$('#loader').hide();
								$('#alert').show();
								$('#error-result').html(data.msg);
							}, 1000)
						} else if (data.status == 4) {
							setTimeout(function() {
								$('.btn-text').show();
								$('#loader').hide();
								$('#success').show();
								$('#success-result').html(data.msg);
								$("#contact-form")[0].reset();
							}, 1000)
						}
					})
					form.classList.add('was-validated');
				})
			});
		})
	</script>

</body>

</html>