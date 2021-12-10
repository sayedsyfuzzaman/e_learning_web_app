<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Registration</title>

    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="js/settings.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-7"></script>
    <script src="js/validation.js"></script>
</head>

<?php
session_start();
$nameErr = $emailErr = $genderErr = $dobErr = $usernameErr = $passwordErr = $confirm_passwordErr = $highest_degreeErr = $message = $error = "";
$name = $email = $gender = $dob = $username = $password = $confirm_password  = $highest_degree = "";
$data = [];
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $dob = $_POST["dob"];
    if (!empty($_POST["gender"])) {
        $gender = $_POST["gender"];
    } else {
        $gender = "";
    }
    if (!empty($_POST["dob"])) {
        $dob = $_POST["dob"];
    }
    if (!empty($_POST["highest_degree"])) {
        $highest_degree = $_POST["highest_degree"];
    }

    $data = array(
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'confirm_password' => $confirm_password,
        'highest_degree' => $highest_degree,
        'dob' => $dob,
        'gender' => $gender
    );


    require_once "Controller/addLearnerController.php";
    $learner = new addstudent();

    $learner->addData($data);

    $error = $learner->get_error();
    $message = $learner->get_messege();


    $nameErr = $error["nameErr"];
    $emailErr = $error["emailErr"];
    $passwordErr = $error["passwordErr"];
    $confirm_passwordErr = $error["confirm_passwordErr"];
    $dobErr = $error["dobErr"];
    $genderErr = $error["genderErr"];
    $highest_degreeErr = $error["highest_degreeErr"];
    if (!empty($message)) {
        $_SESSION["message"] = $message;
        header("location: createAccountMessage.php");
    }
}
?>

<body class="theme-blue">
    <section class="pt-6 landing-bg text-white overflow-hidden">
        <nav class="navbar navbar-expand navbar-dark absolute-top w-100 py-2">
            <div class="container">
                <a class="navbar-brand font-weight-bold" href="#">
                    E Learning Web App
                </a>
            </div>
        </nav>
    </section>

    <main class="main h-100 w-100">
        <div class="container h-100">
            <div class="row">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4 pt-4">
                            <h1 class="h2">Sign Up</h1>
                            <p class="lead">
                                Please fill in this form to create an account!
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form name="regForm" onsubmit="return validate_reg_form()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <span class="text-success h2">
                                                <?php
                                                if (isset($message)) {
                                                    echo $message;
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input class="form-control form-control-lg" id="name" type="text" name="name" placeholder="Enter your name" onblur="validate_name()" onkeyup="validate_name()" />
                                            <label id="name-error" class="error validation-error small form-text invalid-feedback"></label>
                                            <span class="text-danger">
                                                <?php
                                                if (isset($nameErr)) {
                                                    echo $nameErr;
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control form-control-lg" type="text" id="email" name="email" placeholder="Enter your email" onblur="validateemail()" onkeyup="validateemail()" />
                                            <label id="email-error" class="error validation-error small form-text invalid-feedback"></label>
                                            <span class="text-danger">
                                                <?php
                                                if (isset($emailErr)) {
                                                    echo $emailErr;
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter password" onblur="validatepassword()" onkeyup="validatepassword()" />
                                            <label id="password-error" class="error validation-error small form-text invalid-feedback"></label>
                                            <span class="text-danger">
                                                <?php
                                                if (isset($passwordErr)) {
                                                    echo $passwordErr;
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input class="form-control form-control-lg" type="password" id="confirm_password" name="confirm_password" placeholder="Re-type password" onblur="validateconfirm_password()" onkeyup="validateconfirm_password()" />
                                            <label id="confirm_password-error" class="error validation-error small form-text invalid-feedback"></label>
                                            <span class="text-danger">
                                                <?php
                                                if (isset($confirm_passwordErr)) {
                                                    echo $confirm_passwordErr;
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        <div class="form-group">
                                            <label>Highest Degree</label>
                                            <select class="form-control form-control-lg" id="highest_degree" name="highest_degree" onclick="validatehighest_degree()">
                                                <option value="" selected>Select degree...</option>
                                                <option value="ssc">SSC</option>
                                                <option value="hsc">HSC</option>
                                                <option value="graduate">Graduate</option>
                                                <option value="postgraduate">Postgraduate</option>
                                            </select>
                                            <label id="highest_degree-error" class="error validation-error small form-text invalid-feedback"></label>
                                            <span class="text-danger">
                                                <?php
                                                if (isset($highest_degreeErr)) {
                                                    echo $highest_degreeErr;
                                                }
                                                ?>
                                            </span>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Gender</label>
                                                <select class="form-control form-control-lg" id="gender" name="gender" onclick="validategender()">
                                                    <option value="" selected>Select gender...</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <label id="gender-error" class="error validation-error small form-text invalid-feedback"></label>
                                                <span class="text-danger">
                                                    <?php
                                                    if (isset($genderErr)) {
                                                        echo $genderErr;
                                                    }
                                                    ?>
                                                </span>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Date of Birth</label>
                                                <div class="input-group date" id="datetimepicker-date" data-target-input="nearest">
                                                    <input type="date" class="form-control form-control-lg" name="dob" id="dob" max="<?= date('Y-m-d'); ?>" placeholder="mm/dd/yyyy" placeholder="dd/mm/yyyy" onchange="validatedob()" onclick="validatedob()">
                                                    <label id="dob-error" class="error validation-error small form-text invalid-feedback"></label>
                                                    <span class="text-danger">
                                                        <?php
                                                        if (isset($dobErr)) {
                                                            echo $dobErr;
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/app.js"></script>

</body>

</html>