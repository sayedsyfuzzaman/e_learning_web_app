<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
	<link href="css/modern.css" rel="stylesheet">
	<script src="js/settings.js"></script>
</head>

<?PHP
    session_start();
    $name=$picture= "";
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
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

			<!-- Start from here -->
			<main class="content">
				<div class="container-fluid">
				
				
					<div class="header">
						<h1 class="header-title">
							Dashboard
						</h1>
						<p class="header-subtitle"></p>
					</div>

					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Sales Today</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="truck"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">2.562</h1>
												<div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
													Less sales than usual
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Visitors Today</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="users"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">17.212</h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.50% </span>
													More visitors than usual
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Earnings</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="dollar-sign"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">$24.300</h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
													More earnings than usual
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Pending Orders</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="shopping-cart"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">43</h1>
												<div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
													Less orders than usual
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-xl-7 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="card-actions float-right">
										<a href="#" class="mr-1">
											<i class="align-middle" data-feather="refresh-cw"></i>
										</a>
										<div class="d-inline-block dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-vertical"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Latest Projects</h5>
								</div>
								<table id="datatables-dashboard-projects" class="table table-striped my-0">
									<thead>
										<tr>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Start Date</th>
											<th class="d-none d-xl-table-cell">End Date</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Assignee</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Project Apollo</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Carl Jenkins</td>
										</tr>
										<tr>
											<td>Project Fireball</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-danger">Cancelled</span></td>
											<td class="d-none d-md-table-cell">Bertha Martin</td>
										</tr>
										<tr>
											<td>Project Hades</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Stacie Hall</td>
										</tr>
										<tr>
											<td>Project Nitro</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">Carl Jenkins</td>
										</tr>
										<tr>
											<td>Project Phoenix</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Bertha Martin</td>
										</tr>
										<tr>
											<td>Project X</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Stacie Hall</td>
										</tr>
										<tr>
											<td>Project Romeo</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Ashley Briggs</td>
										</tr>
										<tr>
											<td>Project Wombat</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">Bertha Martin</td>
										</tr>
										<tr>
											<td>Project Zircon</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-danger">Cancelled</span></td>
											<td class="d-none d-md-table-cell">Stacie Hall</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Sales Today</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="truck"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">2.562</h1>
												<div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.65% </span>
													Less sales than usual
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Visitors Today</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="users"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">17.212</h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.50% </span>
													More visitors than usual
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Earnings</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="dollar-sign"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">$24.300</h1>
												<div class="mb-0">
													<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 8.35% </span>
													More earnings than usual
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Pending Orders</h5>
													</div>

													<div class="col-auto">
														<div class="avatar">
															<div class="avatar-title rounded-circle bg-primary-dark">
																<i class="align-middle" data-feather="shopping-cart"></i>
															</div>
														</div>
													</div>
												</div>
												<h1 class="display-5 mt-1 mb-3">43</h1>
												<div class="mb-0">
													<span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
													Less orders than usual
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>


						<div class="col-xl-7 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="card-actions float-right">
										<a href="#" class="mr-1">
											<i class="align-middle" data-feather="refresh-cw"></i>
										</a>
										<div class="d-inline-block dropdown show">
											<a href="#" data-toggle="dropdown" data-display="static">
												<i class="align-middle" data-feather="more-vertical"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Latest Projects</h5>
								</div>
								<table id="datatables-dashboard-projects1" class="table table-striped my-0">
									<thead>
										<tr>
											<th>Name</th>
											<th class="d-none d-xl-table-cell">Start Date</th>
											<th class="d-none d-xl-table-cell">End Date</th>
											<th>Status</th>
											<th class="d-none d-md-table-cell">Assignee</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Project Apollo</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Carl Jenkins</td>
										</tr>
										<tr>
											<td>Project Fireball</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-danger">Cancelled</span></td>
											<td class="d-none d-md-table-cell">Bertha Martin</td>
										</tr>
										<tr>
											<td>Project Hades</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Stacie Hall</td>
										</tr>
										<tr>
											<td>Project Nitro</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">Carl Jenkins</td>
										</tr>
										<tr>
											<td>Project Phoenix</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Bertha Martin</td>
										</tr>
										<tr>
											<td>Project X</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Stacie Hall</td>
										</tr>
										<tr>
											<td>Project Romeo</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-success">Done</span></td>
											<td class="d-none d-md-table-cell">Ashley Briggs</td>
										</tr>
										<tr>
											<td>Project Wombat</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-warning">In progress</span></td>
											<td class="d-none d-md-table-cell">Bertha Martin</td>
										</tr>
										<tr>
											<td>Project Zircon</td>
											<td class="d-none d-xl-table-cell">01/01/2018</td>
											<td class="d-none d-xl-table-cell">31/06/2018</td>
											<td><span class="badge badge-danger">Cancelled</span></td>
											<td class="d-none d-md-table-cell">Stacie Hall</td>
										</tr>
									</tbody>
								</table>
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

	<!-- Javascript Start from here -->
	<script src="js/app.js"></script>

	<script>
		$(function() {
			$('#datatables-dashboard-projects').DataTable({
				pageLength: 5,
				lengthChange: false,
				bFilter: false,
				autoWidth: false
			});
		});
		$(function() {
			$('#datatables-dashboard-projects1').DataTable({
				pageLength: 5,
				lengthChange: false,
				bFilter: false,
				autoWidth: false
			});
		});
	</script>

</body>

</html>