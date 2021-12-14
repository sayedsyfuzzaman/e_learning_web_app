<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Course</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<?php
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("location:sign-in.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = array(
        'course_id' => "",
        'course_name' => "",
        'price' => "",
        'discount' => "",
        'avilability' => "false",
        'created_by' => $_SESSION["id"]
    );


    $data["course_name"] = $_POST['cname'];
    $data["price"] = $_POST['price'];
    $data["discount"] = $_POST['discount'];

    require_once 'controller/Course.php';
    $course = new Course();
    $course->addCourse($data);
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
                            Add Manager
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Course</li>
                            </ol>
                        </nav>
                    </div>

                    <?php
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] === "created") {
                            $id = $_GET["id"];

                            echo '<div class="row" id = "status">';
                            echo '<div class="col-12">';
                            echo '<div class="card">';
                            echo '<div class="card-header">';
                            echo '<h5 class="card-title mb-0">Course created successfully!</h5>';
                            echo '</div>';
                            echo '<div class="card-body">';
                            echo '<p>Course Id: ' . $id . '</p>';

                            echo '<a class="btn btn-primary btn-sm" id="close-status" href="#">Close</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    ?>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Courses</h5>
                                    <h6 class="card-subtitle text-muted">Create a new course with necesarry data.</h6>
                                </div>
                                <div class="card-body">
                                    <form id="regForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Course Name<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="cname" name="cname" placeholder="Enter Course name">
                                                <label id="cname-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Course Price</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="price" name="price" placeholder="Enter course price">
                                                <label id="price-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Add Discount</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="discount" name="discount" placeholder="Enter discount in percentage">
                                                <label id="discount-error" class="error validation-error small form-text invalid-feedback"></label>
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
            if (param == "created") {
                var message = "Please note the course id shown in the top.";
                var title = "Course Created!";
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