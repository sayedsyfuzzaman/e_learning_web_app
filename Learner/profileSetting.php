<!DOCTYPE html>
<html>

<?PHP
session_start();
$nameErr = $emailErr = $genderErr = $dobErr = $usernameErr = $passwordErr = $confirm_passwordErr = $highest_degreeErr = $pictureErr = $message = $error = "";
$name = $email = $gender = $dob = $username = $password = $confirm_password  = $highest_degree = $picture = "";
$data = [];
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if (!isset($_SESSION['username'])) {
	header("location:login.php");
}
if (isset($_SESSION['course_id'])){
    unset($_SESSION['course_id']);
}
require_once "Controller/receiceLearnerInfoController.php";
$obj = new student_info();
$learner = $obj->get_learner($_SESSION['username']);

if (!empty($learner)) {
	$name = $learner['name'];
	$picture = $learner['image'];
	$dob = $learner['dob'];
	$gender = $learner['gender'];
	$highest_degree = $learner['highest_degree'];
	$email = $learner['email'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['curr-pass'])) {
		$data = array(
			"username" => $_SESSION['username'],
			"password" => $_POST['curr-pass'],
			"new_password" => $_POST['new-pass'],
			"confirm_password" => $_POST['verify-pass'],
		);
		require_once 'Controller/change_passwordController.php';
		$obj = new passwordCon();
		$obj->password_change($data);
		$message = $obj->get_messege();
	} else {
		$name = test_input($_POST["name"]);
		$email = test_input($_POST["email"]);

		if (!empty($_POST["gender"])) {
			$gender = $_POST["gender"];
		}
		if (!empty($_POST["dob"])) {
			$dob = $_POST["dob"];
		}
		if (!empty($_POST["highest_degree"])) {
			$highest_degree = $_POST["highest_degree"];
		}
		$target_file = $_FILES["fileToUpload"]["name"];

		$data = array(
			'name' => $name,
			'username' => $_SESSION['username'],
			'email' => $email,
			'dob' => $dob,
			'gender' => $gender,
			'highest_degree' => $highest_degree
		);

		require_once "Controller/updateLearnerController.php";
		$learner = new update();

		$learner->update_learner($data);

		$error = $learner->get_error();
		$message = $learner->get_messege();

		$nameErr = $error["nameErr"];
		$emailErr = $error["emailErr"];
		$dobErr = $error["dobErr"];
		$genderErr = $error["genderErr"];
		$highest_degreeErr = $error["highest_degreeErr"];
	}
}
?>


<head>
	<meta charset="utf-8">
	<title>Dashboard</title>
	<link href="../css/modern.css" rel="stylesheet">
	<script src="../js/settings.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/jQuarrayValidation.js">
	</script>

	<link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
	<script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
	<script>
		$(document).ready(function() {
			$("#picture-error").hide();

			var $modal = $('#modal_crop');
			var crop_image = document.getElementById('sample_image');
			var cropper;
			$('#upload_image').change(function(event) {
				var files = event.target.files;
				var ext = $("#upload_image").val().split('.').pop();

				if (ext.match(/jpg/) || ext.match(/png/) || ext.match(/jpeg/) || ext.match(/JPG/)) {
					$("#picture-error").hide();
					var done = function(url) {
						crop_image.src = url;
						$modal.modal('show');
					};

					if (files && files.length > 0) {
						reader = new FileReader();
						reader.onload = function(event) {
							done(reader.result);
						};
						reader.readAsDataURL(files[0]);
					}
				} else {
					$("#picture-error").html("This field can contain only jpg, png and jpeg file.");
					$("#picture-error").show();
				}

			});
			$modal.on('shown.bs.modal', function() {
				cropper = new Cropper(crop_image, {
					aspectRatio: 1,
					viewMode: 3,
					preview: '.preview'
				});
			}).on('hidden.bs.modal', function() {
				cropper.destroy();
				cropper = null;
			});
			$('#crop_and_upload').click(function() {
				canvas = cropper.getCroppedCanvas({
					width: 400,
					height: 400
				});
				canvas.toBlob(function(blob) {
					url = URL.createObjectURL(blob);
					var reader = new FileReader();
					reader.readAsDataURL(blob);
					reader.onloadend = function() {
						var base64data = reader.result;
						$.ajax({
							url: 'Controller/image_upload.php',
							method: 'POST',
							data: {
								crop_image: base64data
							},
							success: function(data) {
								$modal.modal('hide');
								$(document).ajaxStop(function() {
									window.location.reload();
								});
							}
						});
					};
				});
			});
		});
	</script>
	<style>
		img {
			max-width: 100%;
		}

		.preview {
			overflow: hidden;
			width: 160px;
			height: 160px;
			margin: 10px;
			border: 1px solid red;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<?php
		include 'sidebar.php';
		?>
		<script>
			document.getElementById('home').className = "sidebar-item";
			document.getElementById('view_profile').className = "sidebar-item active";
		</script>
		<div class="main">
			<?php
			include 'navbar.php';
			?>

			<main class="content">
				<div class="container-fluid">

					<div class="header">
						<h1 class="header-title">
							Settings
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="viewProfile.php">View Profile</a></li>
								<li class="breadcrumb-item active" aria-current="page">Settings</li>
							</ol>
						</nav>
					</div>

					<div class="row">
						<div class="col-md-3 col-xl-2">

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Profile Settings</h5>
								</div>

								<div class="list-group list-group-flush" role="tablist">
									<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
										Account
									</a>
									<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
										Password
									</a>
								</div>
							</div>
						</div>

						<div class="col-md-9 col-xl-10">
							<div class="tab-content">
								<div class="tab-pane fade show active" id="account" role="tabpanel">

									<div class="card">
										<div class="card-header">
											<h1 class="card-title mb-8 text-success">
												<?php
												if (isset($message)) {
													echo $message;
												}
												?>
											</h1>
											<h5 class="card-title mb-0">Public info</h5>
										</div>
										<div class="card-body">
											<form name="primaryForm" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-8">
														<div class="form-group">
															<label for="inputUsername">Username</label>
															<input type="text" class="form-control text-dark" id="username" name="username" placeholder="Username" disabled value="<?php echo $_SESSION['username']; ?>">
														</div>
														<div class="form-group">
															<label for="inputUsername">Name</label>
															<input type="text" class="form-control text-dark" placeholder="First name" disabled value="<?php echo $name; ?>">
														</div>
													</div>
													<div class="col-md-4">
														<div class="text-center">
															<img id="picture" name="picture" id="picture" src="<?php echo $picture; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
															<div class="mt-2">
																<span class="btn btn-primary">
																	<label class="fas fa-upload" for="upload_image" id="LblBrowse">
																		Change Image
																	</label>
																</span>

																<form method="post">
																	<input type="file" name="crop_image" class="crop_image form-control" id="upload_image" style="display: none" />
																</form>
																<label id="picture-error" class="error validation-error small form-text invalid-feedback"></label>
															</div>
														</div>
													</div>
												</div>
											</form>

										</div>
									</div>

									<div class="modal fade" id="modal_crop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Crop Image Before Upload</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">×</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="img-container">
														<div class="row">
															<div class="col-md-8">
																<img src="" id="sample_image" />
															</div>
															<div class="col-md-4">
																<div class="preview"></div>
															</div>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" id="crop_and_upload" class="btn btn-primary">Upload</button>
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
												</div>
											</div>
										</div>
									</div>

									<div class="card">
										<div class="card-header">
											<h5 class="card-title mb-0">Private info</h5>
										</div>
										<div class="card-body">
											<form name="regForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
												<input type="file" id="fileToUpload" name="fileToUpload" style="display: none;" />
												<div class="form-group">
													<label for="name">Name</label>
													<input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="First name" value="<?php echo $name; ?>">
													<label id="name-error" class="error validation-error small form-text invalid-feedback">
														<?php
														if (isset($nameErr)) {
															echo $nameErr;
														}
														?>
													</label>
												</div>

												<div class="form-group">
													<label for="email">Email</label>
													<input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>">
													<label id="email-error" class="error validation-error small form-text invalid-feedback">
														<?php
														if (isset($emailErr)) {
															echo $emailErr;
														}
														?>
													</label>
												</div>

												<div class="form-row">
													<div class="form-group col-md-4">
														<label>Highest Degree</label>
														<select class="form-control form-control-lg" id="highest_degree" name="highest_degree">
															<option value="">Select degree...</option>
															<option value="ssc" <?php if (isset($highest_degree) && $highest_degree == "ssc") echo "selected"; ?>>SSC</option>
															<option value="hsc" <?php if (isset($highest_degree) && $highest_degree == "hsc") echo "selected"; ?>>HSC</option>
															<option value="graduate" <?php if (isset($highest_degree) && $highest_degree == "graduate") echo "selected"; ?>>Graduate</option>
															<option value="postgraduate" <?php if (isset($highest_degree) && $highest_degree == "postgraduate") echo "selected"; ?>>Postgraduate</option>
														</select>
														<label id="highest_degree-error" class="error validation-error small form-text invalid-feedback">
															<?php
															if (isset($highest_degreeErr)) {
																echo $highest_degreeErr;
															}
															?>
														</label>
													</div>

													<div class="form-group col-md-4">
														<label for="dob">Date of Birth</label>
														<input type="date" class="form-control form-control-lg" name="dob" id="dob" max="<?= date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" placeholder="dd/mm/yyyy" value="<?php echo $dob; ?>">
														<label id="dob-error" class="error validation-error small form-text invalid-feedback">
															<?php
															if (isset($dobErr)) {
																echo $dobErr;
															}
															?>
														</label>
													</div>


													<div class="form-group col-md-4">
														<label>Gender</label>
														<select class="form-control form-control-lg" id="gender" name="gender">
															<option value="">Select gender...</option>
															<option value="male" <?php if (isset($gender) && $gender == "male") echo "selected"; ?>>Male</option>
															<option value="female" <?php if (isset($gender) && $gender == "female") echo "selected"; ?>>Female</option>
															<option value="other" <?php if (isset($gender) && $gender == "other") echo "selected"; ?>>Other</option>
														</select>
														<label id="gender-error" class="error validation-error small form-text invalid-feedback">
															<?php
															if (isset($genderErr)) {
																echo $genderErr;
															}
															?>
														</label>
													</div>
												</div>
												<button type="submit" class="btn btn-primary">Save changes</button>
											</form>

										</div>
									</div>

								</div>
								<div class="tab-pane fade" id="password" role="tabpanel">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">Password</h5>

											<form id="changePass" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
												<div class="form-group">
													<label for="inputPasswordCurrent">Current password</label>
													<input type="password" class="form-control form-control-lg" id="curr-pass" name="curr-pass">
													<label id="curr-pass-error" class="error validation-error small form-text invalid-feedback"></label>
													<small><a href="#">Forgot your password?</a></small>
												</div>
												<div class="form-group">
													<label for="inputPasswordNew">New password </label>
													<input type="password" class="form-control form-control-lg" id="new-pass" name="new-pass">
													<label id="new-pass-error" class="error validation-error small form-text invalid-feedback"></label>
													<label class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" onclick="showPass()">
														<span class="custom-control-label">Show Password</span>

													</label>
												</div>
												<div class="form-group">
													<label for="inputPasswordNew2">Verify password</label>
													<input type="password" class="form-control form-control-lg" id="verify-pass" name="verify-pass">
													<label id="verify-pass-error" class="error validation-error small form-text invalid-feedback"></label>
												</div>
												<button id="change" type="submit" class="btn btn-primary">Save changes</button>
											</form>
										</div>
									</div>
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

	<!-- Javascript Start from here -->
	<script src="../js/app.js"></script>
	<script>
		function showPass() {
			var x = document.getElementById("new-pass");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>

</body>

</html>