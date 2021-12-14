<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Settings</title>
	<link href="../css/modern.css" rel="stylesheet">
	<script src="../js/settings.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		document.getElementById('home').className = "sidebar-item";
		document.getElementById('view_profile').className = "sidebar-item active";
	</script>
	<script src="js/jQuarrayValidation.js"></script>

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
							url: 'controller/image_upload.php',
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
<?php
session_start();
if (!isset($_SESSION['id'])) {
	session_destroy();
	header("location:../sign-in.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$data = array(
		'id' => $_SESSION["id"],
		'password' => "",
		'name' => "",
		'email' => "",
		'phone' => "",
		'nationality' => "",
		'nid' => "",
		'dob' => "",
		'gender' => "",
		'address' => "",
		'image' => "",
	);
	$password = array(
		'id' => $_SESSION["id"],
		'current' => "",
		'new' => "",
		'verify' => ""
	);

	if (isset($_POST['fname'])) {
		$data["name"] = $_POST['fname'];
		$data["email"] = $_POST['email'];
		$data["phone"] = $_POST['phone'];
		$data["nationality"] = $_POST['nationality'];
		$data["nid"] = $_POST['nid'];
		$data["dob"] = $_POST['dob'];

		if (!empty($_POST["gender"])) {
			$data["gender"] = $_POST["gender"];
		}

		$data["address"] = $_POST['address'];
		require_once 'controller/Manager.php';
		$manager = new Manager();
		$manager->updateProfile($data);
	} 
	elseif (isset($_POST['curr-pass'])) {
		$password["current"] = $_POST['curr-pass'];
		$password["new"] = $_POST['new-pass'];
		$password["verify"] = $_POST['verify-pass'];

		require_once 'controller/Manager.php';
		$manager = new Manager();
		$manager->changePassword($password);
	}
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
							Settings
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
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
											<h5 class="card-title mb-0">Information</h5>
										</div>
										<div class="card-body">

											<div class="row">
												<div class="col-md-8">
													<div class="form-group">
														<label for="inputUsername">ID:</label>
														<input type="text" class="form-control text-dark" id="id" name="id" disabled value="<?php echo $_SESSION["id"]; ?>">
													</div>
													<div class="form-group">
														<label for="inputUsername">Designation:</label>
														<input type="text" class="form-control text-dark" id="name" disabled value="<?php echo $_SESSION["usertype"]; ?>">
													</div>
												</div>
												<div class="col-md-4">
													<div class="text-center">
														<img id="picture" name="picture" id="picture" src="<?php echo $_SESSION["image"]; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
														<div class="mt-2">
															<label class="form-label" for="customFile">Change Image</label>

															<form method="post">
																<input type="file" name="crop_image" class="crop_image form-control" id="upload_image" />
															</form>
															<label id="picture-error" class="error validation-error small form-text invalid-feedback"></label>
														</div>

													</div>
												</div>
											</div>
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
											<h5 class="card-title mb-0">Change Information</h5>
										</div>
										<div class="card-body">
											<form id="regForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Full Name<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" id="fname" name="fname" class="form-control" value="<?php echo $_SESSION["name"]; ?>">
														<label id="name-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Email<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="email" name="email" value="<?php echo $_SESSION["email"]; ?>">
														<label id="email-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Phone Number</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id=phone name="phone" value="<?php echo $_SESSION["phone"]; ?>">
														<label id="phone-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Nationality<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $_SESSION["nationality"]; ?>">
														<label id="nationality-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">NID Number<span class="text-danger"> *</span></label>
													<div class="col-sm-10">
														<input type="text" class="form-control" id="nid" name="nid" value="<?php echo $_SESSION["nid"]; ?>">
														<label id="nid-error" class="error validation-error small form-text invalid-feedback"></label>
													</div>
												</div>
												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Date of Birth</label>
													<div class="col-sm-10">
														<div class="input-group date" id="datetimepicker-date" data-target-input="nearest">
															<input type="date" class="form-control" name="dob" id="dob" max="<?= date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" placeholder="dd/mm/yyyy" onchange="validate_dob()" value="<?php echo $_SESSION["dob"]; ?>">
															<label id="dob-error" class="error validation-error small form-text invalid-feedback"></label>
														</div>
													</div>
												</div>

												<fieldset class="form-group">
													<div class="row">
														<label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Gender</label>
														<div class="col-sm-10">
															<div class="custom-controls-stacked">
																<label class="custom-control custom-radio">
																	<input name="gender" type="radio" class="custom-control-input" value="male" <?php if ($_SESSION["gender"] == "male") echo "checked"; ?>>
																	<span class="custom-control-label">Male</span>
																</label>
																<label class="custom-control custom-radio">
																	<input name="gender" type="radio" class="custom-control-input" value="female" <?php if ($_SESSION["gender"] == "female") echo "checked"; ?>>
																	<span class="custom-control-label">Female</span>
																</label>
																<label class="custom-control custom-radio">
																	<input name="gender" type="radio" class="custom-control-input" value="other" <?php if ($_SESSION["gender"] == "other") echo "checked"; ?>>
																	<span class="custom-control-label">Other</span>
																</label>
															</div>
														</div>
													</div>
												</fieldset>

												<div class="form-group row">
													<label class="col-form-label col-sm-2 text-sm-right">Address</label>
													<div class="col-sm-10">
														<textarea name="address" class="form-control" placeholder="Enter your address" rows="3"><?php echo $_SESSION["address"]; ?></textarea>
													</div>
												</div>

												<div class="form-group row">
													<div class="col-sm-10 ml-sm-auto">
														<button id="insert" type="submit" class="btn btn-primary">Submit</button>
													</div>
												</div>
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
													<label for="inputPasswordCurrent">Current password <span class="text-danger">*</span></label>
													<input type="password" class="form-control" id="curr-pass" name="curr-pass">
													<label id="curr-pass-error" class="error validation-error small form-text invalid-feedback"></label>
													<small><a href="#">Forgot your password?</a></small>
												</div>
												<div class="form-group">
													<label for="inputPasswordNew">New password <span class="text-danger">*</span></label>
													<input type="password" class="form-control" id="new-pass" name="new-pass">
													<label id="new-pass-error" class="error validation-error small form-text invalid-feedback"></label>
													<label class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" onclick="showPass()">
														<span class="custom-control-label">Show Password</span>

													</label>
												</div>
												<div class="form-group">
													<label for="inputPasswordNew2">Verify password <span class="text-danger">*</span></label>
													<input type="password" class="form-control" id="verify-pass" name="verify-pass">
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

	<script type="text/javascript">
		function showPass() {
			var x = document.getElementById("new-pass");
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}

		$(function() {
			var getUrlParameter = function getUrlParameter(sParam) {
				var sPageURL = window.location.search.substring(1),
					sURLVariables = sPageURL.split('&'),
					sParameterName,
					i;

				for (i = 0; i < sURLVariables.length; i++) {
					sParameterName = sURLVariables[i].split('=');

					if (sParameterName[0] === sParam) {
						return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
					}
				}
				return false;
			};
			//notification
			var param = getUrlParameter('status');
			if (param == "info_updated") {
				var message = "Your information was updated.";
				var title = "Successful";
				var type = "success"; //success info warning error
				toastr[type](message, title, {
					positionClass: "toast-bottom-right",
					closeButton: "checked",
					progressBar: "checked",
					newestOnTop: "checked",
					rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
					timeOut: "2500"
				});
			}
			else if (param == "password_updated") {
				var message = "Your password was updated.";
				var title = "Successful";
				var type = "success"; //success info warning error
				toastr[type](message, title, {
					positionClass: "toast-bottom-right",
					closeButton: "checked",
					progressBar: "checked",
					newestOnTop: "checked",
					rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
					timeOut: "2500"
				});
			}
			else if (param == "submission_error") {
				var message = "There was an error, We couldn't perform your action. Please try again laterr.";
				var title = "Error";
				var type = "error"; //success info warning error
				toastr[type](message, title, {
					positionClass: "toast-bottom-right",
					closeButton: "checked",
					progressBar: "checked",
					newestOnTop: "checked",
					rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
					timeOut: "5000"
				});
			}



			$("#toastr-clear").on("click", function() {
				toastr.clear();
			});
			$("#close-status").click(function() {
				$("#status").hide();
			});

			$("#name-error").hide();
			$("#email-error").hide();
			$("#phone-error").hide();
			$("#nationality-error").hide();
			$("#nid-error").hide();
			$("#dob-error").hide();
			$("#gender-error").hide();
			$("#upload_image-error").hide();

			$("#upload_image").show();

			var error_name = false;
			var error_email = false;
			var error_phone = false;
			var error_nationality = false;
			var error_nid = false;

			$("#fname").keyup(function() {
				check_name();
			});
			$("#fname").blur(function() {
				check_name();
			});

			$("#email").keyup(function() {
				check_email();
			});
			$("#email").blur(function() {
				check_email();
			});

			$("#phone").keyup(function() {
				check_phone();
			});

			$("#nationality").keyup(function() {
				check_nationality();
			});
			$("#nationality").blur(function() {
				check_nationality();
			});

			$("#nid").keyup(function() {
				check_nid();
			});
			$("#nid").blur(function() {
				check_nid();
			});

			function check_name() {
				var name = $("#fname").val();
				if (name == "") {
					$("#name-error").html("This field is required.");
					$("#name-error").show();
					$("#fname").addClass("is-invalid")
					error_name = true;
				} else if (/[A-Za-z]/.test(name[0]) == false) {
					$("#name-error").html("Must start with a letter.");
					$("#name-error").show();
					$("#fname").addClass("is-invalid")
					error_name = true;
				} else if (/^[A-Za-z\s._-]+$/.test(name) == false) {
					$("#name-error").html("Name can contain letter,desh,dot and space.");
					$("#name-error").show();
					$("#fname").addClass("is-invalid")
					error_name = true;
				} else if (name.match(/(\w+)/g).length < 2) {
					$("#name-error").html("Cannot contain less than two word.");
					$("#name-error").show();
					$("#fname").addClass("is-invalid")
					error_name = true;
				} else {
					$("#name-error").hide();
					$("#fname").removeClass("is-invalid");
				}
			}

			function check_email() {
				var email = $("#email").val();
				if (email == "") {
					$("#email-error").html("This field is required.");
					$("#email-error").show();
					$("#email").addClass("is-invalid")
					error_email = true;
				} else if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email) == false) {
					$("#email-error").html("Invalid email format.");
					$("#email-error").show();
					$("#email").addClass("is-invalid")
					error_email = true;
				} else if (email != "") {
					const xhttp = new XMLHttpRequest();
					xhttp.onload = function() {

						if (this.responseText == "exist") {
							$("#email-error").html("Email alrady exist, Try another.");
							$("#email-error").show();
							$("#email").addClass("is-invalid")
							email_error = true;
						} else if (this.responseText == "not_exist") {
							$("#email-error").hide();
							$("#email").removeClass("is-invalid");
							email_error = false
						}
					}
					xhttp.open("GET", "controller/EmailChecker.php?myemail=" + email);
					xhttp.send();
				} else {
					$("#email-error").hide();
					$("#email").removeClass("is-invalid");
				}

			}

			function check_phone() {
				var phone = $("#phone").val();
				if (isNaN(phone)) {
					$("#phone-error").html("Invalid phone number.");
					$("#phone-error").show();
					$("#phone").addClass("is-invalid")
					error_phone = true;
				} else if (phone.length != 11 && phone != "") {
					$("#phone-error").html("Phone number must be equal to 11.");
					$("#phone-error").show();
					$("#phone").addClass("is-invalid")
					error_phone = true;
				} else {
					$("#phone-error").hide();
					$("#phone").removeClass("is-invalid");
				}
			}

			function check_nationality() {
				var nationality = $("#nationality").val();
				if (nationality == "") {
					$("#nationality-error").html("This field is required.");
					$("#nationality-error").show();
					$("#nationality").addClass("is-invalid")
					error_nationality = true;
				} else if (/^[a-zA-Z]+$/.test(nationality) == false) {
					$("#nationality-error").html("Cannot contain alphabet or characters.");
					$("#nationality-error").show();
					$("#nationality").addClass("is-invalid")
					error_nationality = true;
				} else {
					$("#nationality-error").hide();
					$("#nationality").removeClass("is-invalid");
				}
			}

			function check_nid() {
				var nid = $("#nid").val();

				if (nid == "") {
					$("#nid-error").html("This field is required.");
					$("#nid-error").show();
					$("#nid").addClass("is-invalid")
					error_nid = true;
				} else if (/^[0-9]*$/.test(nid) == false) {
					$("#nid-error").html("Cannot contain alphabet or characters.");
					$("#nid-error").show();
					$("#nid").addClass("is-invalid")
					error_nid = true;
				} else if (nid != "") {
					const xhttp = new XMLHttpRequest();
					xhttp.onload = function() {
						if (this.responseText == "exist") {
							$("#nid-error").html("Sorry! This nid already exist.");
							$("#nid-error").show();
							$("#nid").addClass("is-invalid")
							email_error = true;
						} else if (this.responseText == "not_exist") {
							$("#nid-error").hide();
							$("#nid").removeClass("is-invalid");
							email_error = false
						}
					}
					xhttp.open("GET", "controller/NidChecker.php?mynid=" + nid);
					xhttp.send();
				} else {
					$("#nid-error").hide();
					$("#nid").removeClass("is-invalid");
				}
			}

			$("#regForm").submit(function() {
				error_name = false;
				error_email = false;
				error_phone = false;
				error_nationality = false;
				error_nid = false;

				check_name();
				check_email();
				check_phone();
				check_nationality();
				check_nid();

				if (error_name === false && error_email === false && error_phone === false && error_nationality === false && error_nid === false) {
					return true;
				} else {
					alert("Please Fill the form Correctly");
					return false;
				}
			});


			$("#curr-pass-error").hide();
			$("#new-pass-error").hide();
			$("#verify-pass-error").hide();
			var error_curr = false;
			var error_new = false;
			var error_verify = false;

			$("#curr-pass").keyup(function() {
				check_curr_pass();
			});
			$("#curr-pass").blur(function() {
				check_curr_pass();
			});


			$("#new-pass").keyup(function() {
				check_new_pass();
			});
			$("#new-pass").blur(function() {
				check_new_pass();
			});

			$("#verify-pass").keyup(function() {
				check_verify_pass();
			});
			$("#verify-pass").blur(function() {
				check_verify_pass();
			});


			function check_curr_pass() {
				var pass = $("#curr-pass").val();
				if (pass == "") {
					$("#curr-pass-error").html("This field is required.");
					$("#curr-pass-error").show();
					$("#curr-pass").addClass("is-invalid")
					error_curr = true;
				} else if (pass.length < 8) {
					$("#curr-pass-error").html("Cannot contain less than eight character.");
					$("#curr-pass-error").show();
					$("#curr-pass").addClass("is-invalid")
					error_curr = true;
				} else {
					$("#curr-pass-error").hide();
					$("#curr-pass").removeClass("is-invalid");
				}
			}

			function check_new_pass() {
				var pass = $("#new-pass").val();
				if (pass == "") {
					$("#new-pass-error").html("This field is required.");
					$("#new-pass-error").show();
					$("#new-pass").addClass("is-invalid")
					error_new = true;
				} else if (pass.length < 8) {
					$("#new-pass-error").html("Cannot contain less than eight character.");
					$("#new-pass-error").show();
					$("#new-pass").addClass("is-invalid")
					error_new = true;
				} else if (/[#$%@]/.test(pass) == false) {
					$("#new-pass-error").html("Password have to contain at least one '#' or '$' or '%' or '@'.");
					$("#new-pass-error").show();
					$("#new-pass").addClass("is-invalid")
					return false;
				} else {
					$("#new-pass-error").hide();
					$("#new-pass").removeClass("is-invalid");
				}
			}

			function check_verify_pass() {
				var pass = $("#new-pass").val();
				var verify_pass = $("#verify-pass").val();
				if (verify_pass == "") {
					$("#verify-pass-error").html("This field is required.");
					$("#verify-pass-error").show();
					$("#verify-pass").addClass("is-invalid")
					error_verify = true;
				} else if (pass != verify_pass) {
					$("#verify-pass-error").html("Password does not matched.");
					$("#verify-pass-error").show();
					$("#verify-pass").addClass("is-invalid")
					error_verify = true;
				} else {
					$("#verify-pass-error").hide();
					$("#verify-pass").removeClass("is-invalid");
				}
			}

			$("#changePass").submit(function() {
				error_curr = false;
				error_new = false;
				error_verify = false;
				check_curr_pass();
				check_new_pass();
				check_verify_pass();


				if (error_curr === false && error_new == false && error_verify == false) {
					return true;
				} else {
					alert("Please Fill the form Correctly");
					return false;
				}
			});
		});
	</script>

</body>

</html>