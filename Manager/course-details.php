<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Course Details</title>
	<link href="../css/modern.css" rel="stylesheet">
	<script src="../js/settings.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

</head>
<?php
session_start();
if (!isset($_SESSION['id'])) {
	session_destroy();
	header("location:../sign-in.php");
}

require_once 'controller/Course.php';

$Course = new Course();

$courseInfo = array(
	'course_id' => "",
	'course_name' => "",
	'price' => "",
	'discount' => "",
	'avilability' => "",
	'thumbnail' => "",
	'created_by' => ""
);
if (isset($_GET['id']) && !empty($_GET['id'])) {
	
	$course_info = $Course->fetchCourse($_GET["id"]);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$data = array(
		'course_id' => "",
		'course_name' => "",
		'price' => "",
		'discount' => "",
		'avilability' => ""
	);

	$data["course_name"] = $_POST['cname'];
	$data["price"] = $_POST['price'];
	$data["discount"] = $_POST['discount'];
	$data["avilability"] = $_POST['status'];
	$data["course_id"] = $_GET['id'];

	// echo $data["course_name"];
	// echo $data["price"];
	// echo $data["discount"] ;
	// echo $data["avilability"] ;
	// echo  $data["course_id"];

	require_once 'controller/Course.php';
	$course = new Course();
	$course->updateCourse($data);
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
							<?php echo $course_info["course_name"] ?>
						</h1>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
								<li class="breadcrumb-item"><a href="courses.php">Courses</a></li>
								<li class="breadcrumb-item active" aria-current="page">Course Details</li>
							</ol>
						</nav>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Update Course Information</h5>
								</div>
								<div class="card-body">
									<form id="regForm" method="post" action="course-details.php?id=<?php echo $course_info["course_id"]?>" enctype="multipart/form-data">
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">Course ID</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" name="course_id" value="<?php echo $course_info["course_id"]; ?>" disabled>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">Course Name<span class="text-danger"> *</span></label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="cname" name="cname" value="<?php echo $course_info["course_name"]; ?>">
												<label id="cname-error" class="error validation-error small form-text invalid-feedback"></label>
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">Course Price</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="price" name="price" value="<?php echo $course_info["price"]; ?>">
												<label id="price-error" class="error validation-error small form-text invalid-feedback"></label>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">Add Discount</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" id="discount" name="discount" value="<?php echo $course_info["discount"]; ?>">
												<label id="discount-error" class="error validation-error small form-text invalid-feedback"></label>
											</div>
										</div>

										<div class="form-group row">
											<label for="status" class="col-form-label col-sm-2 text-sm-right">Status</label>
											<div class="col-sm-10">
												<select name="status" id="status" class="form-control">
													<option value="true" <?php if ($course_info["avilability"] == "true") {
																				echo "selected";
																			} ?>>Avaliable</option>
													<option value="false" <?php if ($course_info["avilability"] == "false") {
																				echo "selected";
																			} ?>>Not Available</option>
												</select>
												
											</div>
										</div>

										<div class="form-group row">
											<label class="col-form-label col-sm-2 text-sm-right">Thumbnail</label>
											<div class="col-sm-10">
												<img src="../courseThumbnail/course-thumbnail.png" style="width: 350px; height: 250px;" alt=""><br>
												<input type="file">
												<label id="status-error" class="error validation-error small form-text invalid-feedback"></label>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-sm-10 ml-sm-auto">
												<button id="insert" type="submit" class="btn btn-primary">Update</button>
											</div>
										</div>
									</form>
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
	<script type="text/javascript">
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
			if (param == "updated") {
				var message = "Course Information Updated";
				var title = "Course Updated!";
				var type = "success"; //success info warning error
				toastr[type](message, title, {
					positionClass: "toast-bottom-right",
					closeButton: "checked",
					progressBar: "checked",
					newestOnTop: "checked",
					rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
					timeOut: "2500"
				});
			} else if (param == "submission_error") {
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


			$("#cname-error").hide();
			$("#price-error").hide();
			$("#discount-error").hide();

			var error_cname = false;
			var error_price = false;
			var error_discount = false;
			var error_status = false;

			$("#cname").keyup(function() {
				check_cname();
			});
			$("#cname").blur(function() {
				check_cname();
			});

			$("#price").keyup(function() {
				check_price();
			});

			$("#discount").keyup(function() {
				check_discount();
			});

			function check_cname() {
				var name = $("#cname").val();
				if (name == "") {
					$("#cname-error").html("This field is required.");
					$("#cname-error").show();
					$("#cname").addClass("is-invalid")
					error_cname = true;
				} else if (/[A-Za-z]/.test(name[0]) == false) {
					$("#cname-error").html("Must start with a letter.");
					$("#cname-error").show();
					$("#cname").addClass("is-invalid")
					error_cname = true;
				} else {
					error_cname = false;
					$("#cname-error").hide();
					$("#cname").removeClass("is-invalid");
				}
				return error_cname;
			}

			function check_price() {
				var price = $("#price").val();
				if (isNaN(price)) {
					$("#price-error").html("Invalid phone number.");
					$("#price-error").show();
					$("#price").addClass("is-invalid")
					error_price = true;
				} else {
					$("#price-error").hide();
					$("#price").removeClass("is-invalid");
				}
			}

			function check_discount() {
				var discount = $("#discount").val();
				if (isNaN(discount)) {
					$("#discount-error").html("Invalid phone number.");
					$("#discount-error").show();
					$("#discount").addClass("is-invalid")
					error_discount = true;
				} else {
					$("#discount-error").hide();
					$("#discount").removeClass("is-invalid");
				}
			}

			$("#regForm").submit(function() {
				var error_cname = check_cname();
				check_price();
				check_discount();
				if (error_cname == false) {
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