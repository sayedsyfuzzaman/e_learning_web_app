<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Manager profile and acitvity log</title>
	<link href="../css/modern.css" rel="stylesheet">
	<script src="../js/settings.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>
<?php
session_start();
if (!isset($_SESSION['id'])) {
	session_destroy();
	header("location:../sign-in.php");
}

require_once 'controller/manager.php';

$manager = new Manager();

$managerInfo = array(
	'id' => "",
	'id' => "",
	'name' => "",
	'email' => "",
	'phone' => "",
	'nationality' => "",
	'nid' => "",
	'dob' => "",
	'gender' => "",
	'address' => "",
	'image' => "",
	'salary' => "",
	'created_at' => ""
);
if (isset($_GET['id']) && !empty($_GET['id'])) {
	$managerInfo = $manager->fetchManager($_GET["id"]);
	$activitylog = $manager->managerActivity($_GET["id"]);
}
?>

<body>
	<div class="wrapper">
		<?php
		include 'sidebar.php';
		?>
		<div class="main">
			<?php
			include 'navbar.php';
			?>
			<main class="content">
				<div class="container-fluid">
					<div class="header">
						<h1 class="header-title">
							<?php echo $managerInfo["name"]; ?>
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="manager-details.php">Manager Details</a></li>
								<li class="breadcrumb-item active" aria-current="page">Manager profile and acitvity log</li>
							</ol>
						</nav>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Manager Profile</h5>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 d-flex justify-content-center">
											<img alt="" src="<?php echo $managerInfo["image"]; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
										</div>
										<div class="col-md-12 d-flex justify-content-center">
											<h3><?php echo $managerInfo["name"]; ?></h3>
										</div>
										<div class="col-md-12 d-flex justify-content-center">
											<p><?php echo $managerInfo["id"]; ?></p>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-md-4 d-flex justify-content-center">

											<p><i class="ion ion-md-mail mr-2"></i><?php echo $managerInfo["email"]; ?></p>
										</div>
										<div class="col-md-4 d-flex justify-content-center">
											<p><i class="ion ion-md-call mr-2"></i><?php echo $managerInfo["phone"]; ?></p>
										</div>
										<div class="col-md-4 d-flex justify-content-center">
											<p><i class="fas fa-fw fa-address-book mr-2"></i><?php echo $managerInfo["nationality"]; ?></p>
										</div>
										<div class="col-md-4 d-flex justify-content-center">
											<p><i class="fas fa-fw fa-address-card mr-2"></i><?php echo $managerInfo["nid"]; ?></p>
										</div>
										<div class="col-md-4 d-flex justify-content-center">
											<p><i class="fas fa-fw fa-birthday-cake mr-2"></i><?php echo $managerInfo["dob"]; ?></p>
										</div>
										<div class="col-md-4 d-flex justify-content-center">
											<p><i class="ion ion-md-person mr-2"></i><?php echo $managerInfo["gender"]; ?></p>
										</div>
										<div class="col-md-4 d-flex justify-content-center">
											<p><i class="mr-2 fas fa-fw fa-ad"></i><?php echo $managerInfo["address"]; ?></p>
										</div>
										<div class="col-md-4 d-flex justify-content-center">
											<p><i class="fas fa-fw fa-dollar-sign"></i><?php echo $managerInfo["salary"]; ?></p>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Activity Log</h5>
								</div>
								<div class="card-body">
									<table id="datatables-buttons" class="table table-striped" style="width:100%">
										<thead>
											<td>Title</td>
										</thead>
										<tbody>
											<?php foreach ($activitylog as $row) : ?>
												<tr>
													<td>
														<div class="d-flex">
															<div class="col-md-8">
																<p><i class="fas fa-fw fa-newspaper mr-2"></i><?php echo $row["title"] ?></p>
															</div>
															<div class="col-md-4">
																<p><i class="ion ion-md-time mr-2"></i><?php echo $row["date"] ?></p>
															</div>

														</div>
														<div class="col-md-12">
															<p><?php echo $row["comment_one"]." ".$row["comment_two"]." ".$row["comment_three"]." ".$row["comment_four"] ?></p>
														</div>
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

			<?php
			include 'footer.php';
			?>

		</div>

	</div>

	<script src="../js/app.js"></script>
	<script>
		$(function() {
			var datatablesButtons = $('#datatables-buttons').DataTable({
				lengthChange: !1,
				buttons: ["csv", "print"],
				responsive: true
			});
			datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
		});
	</script>



</body>

</html>