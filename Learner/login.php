<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Login</title>

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
$time = time();
$usernameErr = $passwordErr = "";
$username = $password = $name = $picture = "";
$student = "";
$data = [];

if (isset($_COOKIE['username'])) {
    require_once "Controller/receiceLearnerInfoController.php";
    $obj = new student_info();
    $learner = $obj->get_learner($_COOKIE['username']);

    if (!empty($learner)) {
        $name = $learner['name'];
        $picture = $learner['image'];
    }
}


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_COOKIE["username"]) && !empty($_POST['remember']) && $_POST['username'] == $_COOKIE["username"] && $_POST['password'] == $_COOKIE["password"]) {
        $_SESSION['username'] = $_COOKIE["username"];
        $_SESSION['password'] = $_COOKIE["password"];
        header("location: dashboard.php");
    } else {
        $username = test_input($_POST["username"]);

        $data = array(
            'username' => $username,
            'password' =>  $_POST["password"]
        );


        require_once "Controller/loginController.php";
        $learner = new addstudent();

        $student = $learner->found_learner($data);
        $error = $learner->get_error();

        $usernameErr = $error["usernameErr"];
        $passwordErr = $error["passwordErr"];



        if (empty($passwordErr) && empty($usernameErr) && $student != "") {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $post["password"];
            header("location: dashboard.php");

            if (!empty($_POST['remember']) && empty($passwordErr) && empty($usernameErr) && $student != "") {
                setcookie("username", $_POST['username'], time() + (60*60*24*30*12));
                setcookie("password", $_POST['password'], time() + (60*60*24*30*12));
            }else{
                setcookie("username", "", time() - 3600);
                setcookie("password", "", time() - 3600);
            }
        }
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

                        <div class="text-center mt-4">
                            <?php
                            if (isset($_COOKIE["username"])) {
                                echo "<h1 class='h2'>Welcome back, " . $name . "!</h1>";
                            }
                            ?>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <?php
                                        if (isset($_COOKIE["username"])) {
                                            echo "<img src='" . $picture . "'  class='img-fluid rounded-circle' width='132' height='132' />";
                                        }
                                        ?>
                                    </div>
                                    <form name="loginForm" onsubmit="return validate_login_form()" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input class="form-control form-control-lg" id="username" type="text" name="username" placeholder="Enter your id" onblur="validateusername()" onkeyup="validateusername()" value="<?php if (isset($_COOKIE['username'])) {
                                                                                                                                                                                                                                    echo $_COOKIE['username'];
                                                                                                                                                                                                                                } ?>" />
                                            <label id="username-error" class="error validation-error small form-text invalid-feedback"></label>
                                            <span class="text-danger">
                                                <?php
                                                if (!empty($usernameErr)) {
                                                    echo '<script type="text/JavaScript"> 
                                                    document.getElementById("username").className = "form-control form-control-lg is-invalid";
                                                    </script>';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input class="form-control form-control-lg" type="password" id="password" name="password" placeholder="Enter your password" onblur="validateLoginpassword()" onkeyup="validateLoginpassword()" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                                                                                                                                            echo $_COOKIE['password'];
                                                                                                                                                                                                                                                        } ?>" />
                                                <label id="password-error" class="error validation-error small form-text invalid-feedback"><?php
                                                    if (!empty($passwordErr)) {
                                                        echo '<script type="text/JavaScript"> 
                                                           document.getElementById("password").className = "form-control form-control-lg is-invalid";
                                                        </script>';
                                                        echo $passwordErr;
                                                    }
                                                    ?></label>
                                                <span class="text-danger">

                                                </span>
                                            </div>

                                            <small>
                                                <a href="#">Forgot password?</a>
                                            </small>
                                        </div>
                                        <div>
                                            <div class="custom-control custom-checkbox align-items-center">
                                                <input id="customControlInline" type="checkbox" class="custom-control-input" value="remember" name="remember" <?php if (isset($_COOKIE["username"])) {
                                                                                                                                                                    echo "checked";
                                                                                                                                                                } ?>>
                                                <label class="custom-control-label text-small" for="customControlInline">Remember me next time</label>
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">Not you? <a href="registration.php">Sign up</a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/app.js"></script>

</body>

</html>