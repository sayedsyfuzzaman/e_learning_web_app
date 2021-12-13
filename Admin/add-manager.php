<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Manager</title>
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
        'id' => "",
        'password' => "",
        'name' => "",
        'email' => "",
        'phone' => "",
        'nationality' => "",
        'nid' => "",
        'dob' => "",
        'gender' => "",
        'address' => "",
        'image' => "upload/default.png",
        'added_by' => $_SESSION["id"]
    );


    $data["name"] = $_POST['name'];
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
    $manager->addManager($data);
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
                                <li class="breadcrumb-item active" aria-current="page">Add Manager</li>
                            </ol>
                        </nav>
                    </div>

                    <?php
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] === "submitted") {
                            $id = $_GET["id"];
                            $password = $_GET["password"];

                            echo '<div class="row" id = "status">';
                            echo '<div class="col-12">';
                            echo '<div class="card">';
                            echo '<div class="card-header">';
                            echo '<h5 class="card-title mb-0">Manager inserted successfully!</h5>';
                            echo '</div>';
                            echo '<div class="card-body">';
                            echo '<p>Id: ' . $id . '</p>';
                            echo '<p>Password: ' . $password . '</p>';

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
                                    <h5 class="card-title">Manager</h5>
                                    <h6 class="card-subtitle text-muted">Create a brand new manager and add him to this web app</h6>
                                </div>
                                <div class="card-body">
                                    <form id="regForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Full Name<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name">
                                                <label id="name-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Email<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                                                <label id="email-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Phone Number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id=phone name="phone" placeholder="Enter phone number">
                                                <label id="phone-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Nationality<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Enter nationality">
                                                <label id="nationality-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">NID Number<span class="text-danger"> *</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nid" name="nid" placeholder="Enter nid number">
                                                <label id="nid-error" class="error validation-error small form-text invalid-feedback"></label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Date of Birth</label>
                                            <div class="col-sm-10">
                                                <div class="input-group date" id="datetimepicker-date" data-target-input="nearest">
                                                    <input type="date" class="form-control" name="dob" id="dob" max="<?= date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" placeholder="dd/mm/yyyy" onchange="validate_dob()">
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
                                                            <input name="gender" type="radio" class="custom-control-input" value="male">
                                                            <span class="custom-control-label">Male</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input name="gender" type="radio" class="custom-control-input" value="female">
                                                            <span class="custom-control-label">Female</span>
                                                        </label>
                                                        <label class="custom-control custom-radio">
                                                            <input name="gender" type="radio" class="custom-control-input" value="other">
                                                            <span class="custom-control-label">Other</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <div class="form-group row">
                                            <label class="col-form-label col-sm-2 text-sm-right">Address</label>
                                            <div class="col-sm-10">
                                                <textarea name="address" class="form-control" placeholder="Textarea" rows="3"></textarea>
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
            if (param == "submitted") {
                var message = "Please note the manager id and password shown in the top.";
                var title = "Manager Created!";
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

            $("#name").keyup(function() {
                check_name();
            });
            $("#name").blur(function() {
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
                var name = $("#name").val();
                if (name == "") {
                    $("#name-error").html("This field is required.");
                    $("#name-error").show();
                    $("#name").addClass("is-invalid")
                    error_name = true;
                } else if (/[A-Za-z]/.test(name[0]) == false) {
                    $("#name-error").html("Must start with a letter.");
                    $("#name-error").show();
                    $("#name").addClass("is-invalid")
                    error_name = true;
                } else if (/^[A-Za-z\s._-]+$/.test(name) == false) {
                    $("#name-error").html("Name can contain letter,desh,dot and space.");
                    $("#name-error").show();
                    $("#name").addClass("is-invalid")
                    error_name = true;
                } else if (name.match(/(\w+)/g).length < 2) {
                    $("#name-error").html("Cannot contain less than two word.");
                    $("#name-error").show();
                    $("#name").addClass("is-invalid")
                    error_name = true;
                } else {
                    $("#name-error").hide();
                    $("#name").removeClass("is-invalid");
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
                    xhttp.open("GET", "controller/EmailChecker.php?email=" + email);
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

            function check_unique_nid(email) {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    is_found = this.responseText;
                    if (is_found == "found") {
                        return false;
                    } else {
                        return true;
                    }
                }
                xhttp.open("GET", "controller/NidChecker.php?nid=" + nid);
                xhttp.send();
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
                            error_nid = true;
                        } else if (this.responseText == "not_exist") {
                            $("#nid-error").hide();
                            $("#nid").removeClass("is-invalid");
                            error_nid = false
                        }
                    }
                    xhttp.open("GET", "controller/NidChecker.php?nid=" + nid);
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
                //check_phone();
                check_nationality();
                check_nid();

                if (error_name === false && error_email === false && error_phone === false && error_nationality === false && error_nid === false) {
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