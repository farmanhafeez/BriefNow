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

$search = isset($_GET['search']) ? $_GET['search'] : '';

$results = mysqli_query($conn, "SELECT * FROM blog WHERE listed = '1' AND (categories='$search' OR tags LIKE '%$search%') ORDER by postid DESC");

if (empty($search)) {
	header('Location: ../404.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>BriefNow | Result</title>
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
														<img src="../<?php echo $row['thumbnail']; ?>" class="card-img h-100" alt="<?php echo $row['title']; ?>">
													</div>
													<div class="col-md-7 d-flex align-content-between flex-column">
														<div class="card-body">
															<h3 class="card-title line-height">
																<a class="text-dark" href="../post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a>
															</h3>
															<p class="card-text text-muted" style="font-size: 15px;"><?php echo $row['description']; ?></p>
														</div>
														<div class="card-footer">
															<div class="d-flex justify-content-between">
																<?php
																$result2 = mysqli_query($conn, "SELECT * FROM users WHERE username = '" . $row['author'] . "'");
																$row2 = mysqli_fetch_array($result2);
																?>
																<a class="small text-muted m-0 p-0" href="../user/<?php echo $row['author']; ?>">
																	<img src="../<?php echo $row2['profilepic']; ?>" height="30" class="rounded-circle mr-1" />@<?php echo $row['author']; ?>
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
									$result = mysqli_query($conn, "SELECT * FROM blog WHERE listed = '1' ORDER by count DESC LIMIT 5");
									while ($row = mysqli_fetch_array($result)) {
									?>
										<p class="text-dark text-capitalize"><small><i class="fas fa-chevron-right"></i></small>
											<a class="text-dark" href="../post/<?= $row['author']; ?>-<?= $row['postid']; ?>-<?= $row['title']; ?>"><?php echo $row['title']; ?></a><br>
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
										<a href="<?php echo $row['categories']; ?>">
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

	<?php footer(); ?>

	<!--------------- JAVASCRIPT CODE --------------->

	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

	<script src="../js/main.js"></script>

	<!-- Newsletter Ajax code -->
	<?php scriptCode(); ?>

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