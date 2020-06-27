<?php

require 'dbconfig.php';
include 'vendor/UserInformation.php';
require 'session.php';
include 'footer.php';

$postid = isset($_GET['postid']) ? $_GET['postid'] : '';
$title = isset($_GET['title']) ? $_GET['title'] : '';
$author = isset($_GET['user']) ? $_GET['user'] : '';

// Date conversion
function returnDate($date)
{
	$blogdate = date('d M Y', strtotime($date));
	return $blogdate;
}

if (!empty($postid) || !empty($title)) {
	$stmt = $conn->prepare("SELECT * FROM blog WHERE listed = '1' AND postid = ? AND title = ?");
	$stmt->bind_param("ss", $postid, $title);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_array();

	if ($result->num_rows > 0) {
		$ip = "157.50.70.2";
		$device = UserInfo::get_device();
		$browser = UserInfo::get_browser();
		$ipcountry = @unserialize(file_get_contents("http://ip-api.com/php/" . $ip));
		date_default_timezone_set("Asia/Kolkata");
		$country =  $ipcountry['country'];
		$viewmonth = date("F");
		$viewyear = date("Y");
		$pageviews  = 1;

		$visitor_result = mysqli_query($conn, "SELECT * FROM pagevisitor 
						WHERE blogpostid = '$postid' AND visitorip = '$ip' AND visitordevice = '$device' AND visitorcountry = '$country' 
						AND visitorbrowser = '$browser' AND visitormonth = '$viewmonth' AND visitoryear = '$viewyear'");
		if (mysqli_num_rows($visitor_result) > 0) {
			//Update the pageviews if blogpostid and visitorip is already available
			mysqli_query($conn, "UPDATE pagevisitor SET pageviews = (pageviews+1) 
						WHERE blogpostid = '$postid' AND visitorip = '$ip' AND visitordevice = '$device' AND visitorcountry = '$country' 
						AND visitorbrowser = '$browser' AND visitormonth = '$viewmonth' AND visitoryear = '$viewyear'");
		} else {
			//Insert the record if blogpostid and visitorip is not available
			mysqli_query($conn, "INSERT INTO pagevisitor (blogpostid, visitorip, visitordevice, visitorbrowser, visitorcountry, visitormonth, visitoryear, pageviews) 
						VALUES ('$postid', '$ip', '$device', '$browser', '$country', '$viewmonth', '$viewyear', '$pageviews')");
		}

		//Traffic source
		if (isset($_SERVER['HTTP_REFERER'])) {
			$referer = $_SERVER['HTTP_REFERER'];
			$explode = explode("/", $referer);
			$url = ($explode)[2];
			$pageviews = 1;
			if ($url != 'localhost') {
				$traffic_source = mysqli_query($conn, "SELECT * FROM trafficsource WHERE postid = '$postid' AND referer = '$url'");
				if (mysqli_num_rows($traffic_source) > 0) {
					mysqli_query($conn, "UPDATE trafficsource SET pageviews = (pageviews+1) WHERE postid = '$postid' AND referer = '$url'");
				} else {
					mysqli_query($conn, "INSERT INTO trafficsource (postid, referer, pageviews) VALUES ('$postid','$url','$pageviews')");
				}
			}
		}

		//Updating page count
		mysqli_query($conn, "UPDATE blog SET count = (count+1) WHERE postid='$postid'");
	} else {
		header('Location: 404.php');
	}
} else {
	header('Location: 404.php');
}

//Updating the comment count of this blog from comment table
mysqli_query($conn, "UPDATE blog SET blog.commentcount=(SELECT SUM(commentcount) FROM comment 
					WHERE blog.postid=comment.commentpostid GROUP BY comment.commentpostid);");

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BriefNow | <?php echo "" . $row['title'] . ""; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="description" content="<?php echo "" . $row['description'] . ""; ?>">
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

	<?php
	$stmt = $conn->prepare("SELECT * FROM blog, users WHERE username = ? AND postid = ? AND title = ?");
	$stmt->bind_param("sss", $author, $postid, $title);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_array()) {
	?>
		<div class="hero-section" style="height: 70vh;background: 
		linear-gradient(to right,rgba(39, 70, 133, 0.9) 0%,rgba(61, 179, 197, 0.9) 100%),url(../<?php echo $row['thumbnail']; ?>);">
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
							<h1 class="text-capitalize blog-h1"><?php echo $row['title']; ?></h1>
						</div>
					</div>
					<div class="row justify-content-center pt-2">
						<div class="col-10 col-md-8 col-lg-6">
							<div class="row justify-content-around">
								<div>
									<img src="../<?php echo $row['profilepic']; ?>" height="30" class="rounded-circle mr-1" /> <?php echo $row['author']; ?>
								</div>
								<div>|</div>
								<div>
									<small><i class="fas fa-hashtag mr-1"></i><?php echo $row['categories']; ?></small>
								</div>
								<div>|</div>
								<div>
									<small><i class="fas fa-eye mr-1"></i><?php echo $row['count']; ?> Views</small>
								</div>
								<div>|</div>
								<div>
									<small><i class="fas fa-calendar-alt mr-1"></i><?php echo returnDate($row['blogdate']); ?></small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php }
	$stmt->close();
	?>

	<!---------- CONTAINER ---------->

	<div class="container-fluid first-section">
		<div class="row justify-content-center">
			<div class="leftcolumn col-lg-8 pb-3 pb-md-0">

				<!---------- BLOG ARTICLE ---------->

				<div class="card mb-3 border-0">
					<?php
					$stmt = $conn->prepare("SELECT * FROM blog WHERE listed = '1' AND postid = ? AND title = ?");
					$stmt->bind_param("ss", $postid, $title);
					$stmt->execute();
					$result = $stmt->get_result();
					while ($row = $result->fetch_array()) {
					?>
						<img src="../<?php echo "" . $row['thumbnail'] . ""; ?>" alt="<?php echo "" . $row['title'] . ""; ?>" class="img-fluid card-img-top rounded" width="100%" height="auto" />
						<div class="card-body article text-muted px-0">
							<?php
							$body = $row['body'];
							$newbody = str_replace("../", "", "$body");
							echo $newbody;
							?>
						</div>
						<div class="card-footer pt-0 px-0">
							<?php
							$labels = $row['tags'];
							$label_replace = str_replace(" ", "", $labels);
							$label_array = explode(",", $label_replace);
							foreach ($label_array as $label_each) { ?>
								<?php echo "<a href='../result/" . $label_each . "'>"; ?><button class="btn btn-sm btn-outline-primary mb-1"><small><i class="fas fa-hashtag"></i></small> <?php echo $label_each; ?></button></a>
							<?php } ?>
						</div>
					<?php }
					$stmt->close();
					?>
				</div>

				<!---------- SHARE BUTTON ---------->

				<div class="card border-0">
					<h3 class="card-header text-primary px-0">Share</h3>
					<div class="card-body px-0">
						<div class="addthis_inline_share_toolbox"></div>
					</div>
				</div>

				<!---------- AUTHOR SECTION ---------->

				<div class="card mb-3 border-0 bg-light">
					<?php
					$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
					$stmt->bind_param("s", $author);
					$stmt->execute();
					$result = $stmt->get_result();
					while ($row = $result->fetch_array()) {
					?>
						<h3 class="card-header text-primary px-0">Author</h3>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-3">
									<img src="../<?php echo $row['profilepic']; ?>" alt="user-profile" class="img-fluid rounded-circle">
								</div>
								<div class="col-sm-9 text-center text-md-left">
									<h4 class="text-capitalize"><?php echo $row['fullname']; ?></h4>
									<a class="text-dark" href="../user/<?php echo $row['username']; ?>">
										<p class="my-1">@<?php echo $row['username']; ?></p>
									</a>
									<p class="text-muted font-italic">"<?php echo $row['bio']; ?>"</p>
									<div class="row justify-content-md-left justify-content-center">
										<div class="col-1">
											<a href="<?= $row['facebook']; ?>" target="blank" class="facebook text-dark"><i class="fab fa-facebook-f"></i></a>
										</div>
										<div class="col-1">
											<a href="<?= $row['instagram']; ?>" target="blank" class="instagram text-dark"><i class="fab fa-instagram"></i></a>
										</div>
										<div class="col-1">
											<a href="<?= $row['twitter']; ?>" target="blank" class="twitter text-dark"><i class="fab fa-twitter"></i></a>
										</div>
										<div class="col-1">
											<a href="<?= $row['linkedin']; ?>" class="linkedin text-dark"><i class="fab fa-linkedin-in"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					}
					$stmt->close();
					?>
				</div>

				<!---------- COMMENT ---------->

				<div class="card mb-3 border-0" id="comment">
					<h3 class="card-header text-primary px-0">Comment</h3>
					<?php
					$stmt = $conn->prepare("SELECT * FROM blog WHERE postid = ? AND title = ?");
					$stmt->bind_param("ss", $postid, $title);
					$stmt->execute();
					$result = $stmt->get_result();
					while ($row = $result->fetch_array()) { ?>
						<div class="card-body px-1">
							<div class="alert alert-danger" role="alert" id="error" style="display: none">
								<div id="errorresult" class="small"></div>
							</div>
							<div class="alert alert-success" role="alert" id="success" style="display: none">
								<div id="successresult" class="small"></div>
							</div>
							<form action="" method="post" id="comment-form" autocomplete="off" class="needs-validation" novalidate>
								<?php if (!isset($_SESSION['username'])) { ?>
									<div class="row">
										<div class="col-md-6 form-group">
											<label for="commentname">Name <span style="color: red;">*</span></label>
											<input type="text" class="form-control" placeholder="Name" name="commentname" id="commentname" required />
										</div>
										<div class="col-md-6 form-group">
											<label for="commentemail">Email <span style="color: red;">*</span></label>
											<input type="email" class="form-control" placeholder="Email" name="commentemail" id="commentemail" required />
										</div>
									</div>
								<?php } ?>

								<div class="form-group">
									<label for="comment">Comment <span style="color: red;">*</span></label>
									<textarea rows="8" class="form-control" id="comment" name="comment" placeholder="Comment" required></textarea>
								</div>

								<input type="hidden" name="postid" value="<?php echo $row['postid'] ?>">

								<button type="submit" class="btn btn-primary btn-md btn-block" id="commentbtn">
									<div class="btn-text">Submit</div>
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loader" style="display: none;"></span>
								</button>
							</form>
						</div>
					<?php }
					$stmt->close();
					?>
				</div>

				<!-- DISPLAY COMMENT -->
				<div id="display-comment">
					<?php
					$stmt = $conn->prepare("SELECT * FROM comment WHERE commentpostid = ? ORDER BY commentid DESC");
					$stmt->bind_param("s", $postid);
					$stmt->execute();
					$result = $stmt->get_result();
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_array()) { ?>
							<div class="card mb-2 border-0 px-0" id="<?php echo $row['commentid']; ?>">
								<h4 class="card-header border-0 px-3 pb-0">
									<img src="../<?php echo $row['commentpic'] ?>" style="height: 30px;" alt="User image" class="img-fluid rounded-circle mr-1" />
									<?php echo "" . $row['commentname'] . ""; ?>
								</h4>
								<div class="card-body p-3">
									<p class="card-text mb-1"><?php echo "" . $row['comment'] . ""; ?></p>
									<p class="card-text"><small class="text-muted">Posted on: <?php echo returnDate($row['commentdate']); ?></small></p>
								</div>
								<!-- DISPLAY COMMENT REPLY -->
								<?php
								$stmt1 = $conn->prepare("SELECT * FROM commentreply WHERE postid = ? AND commentid = ? ORDER BY replyid DESC");
								$stmt1->bind_param("ss", $postid, $row['commentid']);
								$stmt1->execute();
								$result1 = $stmt1->get_result();
								if ($result1->num_rows > 0) {
									while ($row1 = $result1->fetch_array()) { ?>
										<div class="card mb-2 reply-comment ml-auto border-0" style="box-shadow: none;" id="<?php echo $row1['replyid']; ?>">
											<div class="card-header border-0 px-0 pt-0 pb-1">
												<h5 class="card-title m-0">
													<img src="../<?php echo $row1['commentpic'] ?>" style="height: 30px;" alt="User image" class="img-fluid rounded-circle" />
													<?php echo "" . $row1['commentname'] . ""; ?>
												</h5>
											</div>
											<div class="card-body py-0 pl-0 pr-2">
												<p class="card-text mb-0"><?php echo "" . $row1['replycomment'] . ""; ?></p>
												<p class="card-text"><small class="text-muted">Posted on: <?php echo returnDate($row1['commentdate']); ?></small></p>
											</div>
										</div>
									<?php } ?>
								<?php }
								?>
								<hr>
							</div>
						<?php } ?>
					<?php } else { ?>
						<div class="card mb-3 border-0 px-0">
							<h4 class="card-body">No comments yet</h4>
						</div>
					<?php }
					$stmt->close();
					?>
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
								$result = mysqli_query($conn, "SELECT * FROM blog WHERE listed = '1' ORDER by postid DESC LIMIT 5");
								while ($row = mysqli_fetch_array($result)) {
								?>
									<p class="text-dark text-capitalize"><small><i class="fas fa-chevron-right"></i></small>
										<a class="text-dark" href="<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a><br>
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
										<a class="text-dark" href="<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a><br>
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
									<a href="../result/<?php echo $row['categories']; ?>">
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

	<!----- RELATED POST ----->

	<div class="container-fluid pb-5">
		<div class="col-12 text-center mb-5">
			<h2 class="section-heading">More from the author</h2>
		</div>
		<div class="row">
			<?php
			$stmt = $conn->prepare("SELECT * FROM blog WHERE author = ? AND postid != ? AND title != ? AND listed = '1' 
			ORDER BY count DESC LIMIT 4");
			$stmt->bind_param("sss", $author, $postid, $title);
			$stmt->execute();
			$result = $stmt->get_result();
			while ($row = $result->fetch_array()) {
			?>
				<div class="col-lg-3 col-md-6 mb-3">
					<div class="card h-100 border-0 box-shadow">
						<img src="../<?php echo $row['thumbnail']; ?>" class="card-img-top" alt="<?= $row['title']; ?>">
						<div class="card-body">
							<h4 class="card-title line-height">
								<a class="text-dark" href="<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?= $row['title']; ?></a>
							</h4>
							<p class="card-text text-muted" style="font-size: 15px;"><?php echo $row['description']; ?></p>
						</div>
						<div class="card-footer">
							<div class="d-flex justify-content-between">
								<a class="text-dark" href="../user/<?= $row['author']; ?>">
									<?php
									$result2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $row['author'] . "'");
									$row2 = mysqli_fetch_array($result2);
									?>
									<p class="card-text small text-muted m-0">
										<img src="../<?php echo $row2['profilepic']; ?>" height="30" class="rounded-circle mr-1" /> <?php echo $row['author']; ?>
									</p>
								</a>
								<div>
									<p class="card-text m-0"><small class="text-muted">Posted on: <?php echo returnDate($row['blogdate']); ?></small></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			$stmt->close();
			?>
		</div>
	</div>

	<!---------- FOOTER ---------->

	<?php footer(); ?>

	<!--------------- JAVASCRIPT CODE --------------->

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c49c7cca2f48abe"></script>

	<script src="../js/main.js"></script>

	<!-- COMMENT -->
	<script type="text/javascript">
		$(document).ready(function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				$('#commentbtn').click(function(event) {
					event.preventDefault();
					$('.btn-text').hide();
					$('#loader').show();
					$('#error').hide();
					$('#success').hide();
					var formData = $('#comment-form').serialize();
					console.log(formData);
					$.ajax({
						url: '../query.php',
						method: 'post',
						data: formData + '&action=commentbtn'
					}).done(function(result) {
						console.log(result);
						var data = JSON.parse(result);
						if (data.status == 1 || data.status == 2 || data.status == 3) {
							setTimeout(function() {
								$('.btn-text').show();
								$('#loader').hide();
								$('#error').show();
								$('#errorresult').html(data.msg);
							}, 1000);
						} else if (data.status == 4) {
							setTimeout(function() {
								$('.btn-text').show();
								$('#loader').hide();
								$("#comment-form")[0].reset();
								$('#success').show();
								$('#successresult').html(data.msg);
								$("#display-comment").load(location.href + " #display-comment");
							}, 1000);
						}
					})
					form.classList.add('was-validated');
				})
			});
		})
	</script>

	<!-- Newsletter Ajax code -->
	<?php scriptCode(); ?>

</body>

</html>