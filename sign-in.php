<!DOCTYPE html>
<html lang="en">

<?php
session_start();
$time = time();
$usernameErr = $passwordErr = "";
$username = $password = $name = $picture = "";
$student = "";
$isStudent = false;
$data = [];

if (isset($_SESSION['id'])) {
    if($_SESSION['usertype'] == "Admin"){
        header("location: Admin/dashboard.php");
    }else if($_SESSION['usertype'] == "Manager"){
        header("location: Manager/dashboard.php");
    }    
}

if (isset($_COOKIE['username'])) {
    require_once "General/Controller/receiceInfoController.php";
    $obj = new user_info();
    $user = $obj->getUser($_COOKIE['username']);

    if (!empty($user)) {

        //learner
        if ($user["usertype"] == "learner") {
            $isStudent = true;
            $data = array(
                'username' => $_COOKIE['username'],
                'password' =>  $_COOKIE['password']
            );
            $learner = $obj->found_learner($data);
            if (!empty($learner)) {
                $name = $learner['name'];
                $picture = "Learner/" . $learner['image'];
            } else {
                setcookie("username", "", time() - 3600);
                setcookie("password", "", time() - 3600);
            }
        }

        //add your code
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

        require_once "General/Controller/receiceInfoController.php";
        $obj = new user_info();
        $user = $obj->getUser($_COOKIE["username"]);

        //learner
        if ($user["usertype"] == "learner") {
            $_SESSION['username'] = $_COOKIE["username"];
            $_SESSION['password'] = $_COOKIE["password"];
            header("location: Learner/dashboard.php");
        }
        //admin
        else if ($user["usertype"] == "Admin") {
            $data = array(
                'id' => $_COOKIE["username"],
                'password' =>  $_COOKIE["password"]
            );
            $obj->authenticateUser($data);
            header("location: Admin/dashboard.php");
        }

        //manager
        else if ($user["usertype"] == "Manager") {
            $data = array(
                'id' => $_COOKIE["username"],
                'password' =>  $_COOKIE["password"]
            );
            $obj->authenticateManagerUser($data);
            header("location: Manager/dashboard.php");
        }

        //add your code
    } else if (isset($_COOKIE["username"]) && empty($_POST['remember']) && $_POST['username'] == $_COOKIE["username"] && $_POST['password'] == $_COOKIE["password"]) {

        require_once "General/Controller/receiceInfoController.php";
        $obj = new user_info();
        $user = $obj->getUser($_COOKIE["username"]);

        //learner
        if ($user["usertype"] == "learner") {
            $_SESSION['username'] = $_COOKIE["username"];
            $_SESSION['password'] = $_COOKIE["password"];
            setcookie("username", "", time() - 3600);
            setcookie("password", "", time() - 3600);
            header("location: Learner/dashboard.php");
        }
        //admin
        else if ($user["usertype"] == "Admin") {
            $data = array(
                'id' => $_COOKIE["username"],
                'password' =>  $_COOKIE["password"]
            );
            $obj->authenticateUser($data);
            setcookie("username", "", time() - 3600);
            setcookie("password", "", time() - 3600);
            header("location: Admin/dashboard.php");
        }

        //manager
        else if ($user["usertype"] == "Manager") {
            $data = array(
                'id' => $_COOKIE["username"],
                'password' =>  $_COOKIE["password"]
            );
            $obj->authenticateManagerUser($data);
            setcookie("username", "", time() - 3600);
            setcookie("password", "", time() - 3600);
            header("location: Manager/dashboard.php");
        }


        //add your code
    } else {
        $username = test_input($_POST["username"]);

        $data = array(
            'username' => $username,
            'password' =>  $_POST["password"]
        );
        require_once "General/Controller/receiceInfoController.php";
        $obj = new user_info();
        $user = $obj->getUser($username);


        //learner
        if ($user["usertype"] == "learner") {
            $student = $obj->found_learner($data);
            $error = $obj->get_error();

            $usernameErr = $error["usernameErr"];
            $passwordErr = $error["passwordErr"];



            if (empty($passwordErr) && empty($usernameErr) && $student != "") {
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $post["password"];
                header("location: Learner/dashboard.php");

                if (!empty($_POST['remember']) && empty($passwordErr) && empty($usernameErr) && $student != "") {
                    setcookie("username", $_POST['username'], time() + (60 * 60 * 24 * 30 * 12));
                    setcookie("password", $_POST['password'], time() + (60 * 60 * 24 * 30 * 12));
                } else {
                    setcookie("username", "", time() - 3600);
                    setcookie("password", "", time() - 3600);
                }
            }
        }
        //admin
        else if ($user["usertype"] == "Admin") {
            $data = array(
                'id' => $username,
                'password' =>  $_POST["password"]
            );
            if ($obj->authenticateUser($data)) {
                if (!empty($_POST['remember'])) {
                    setcookie("username", $_POST['username'], time() + (60 * 60 * 24 * 30 * 12));
                    setcookie("password", $_POST['password'], time() + (60 * 60 * 24 * 30 * 12));
                    header("location: Admin/dashboard.php");
                } else {
                    setcookie("username", "", time() - 3600);
                    setcookie("password", "", time() - 3600);
                }
            }
        }

        //manager
        else if ($user["usertype"] == "Manager") {
            $data = array(
                'id' => $username,
                'password' =>  $_POST["password"]
            );
            if ($obj->authenticateManagerUser($data)) {
                if (!empty($_POST['remember'])) {
                    setcookie("username", $_POST['username'], time() + (60 * 60 * 24 * 30 * 12));
                    setcookie("password", $_POST['password'], time() + (60 * 60 * 24 * 30 * 12));
                    header("location: Manager/dashboard.php");
                } else {
                    setcookie("username", "", time() - 3600);
                    setcookie("password", "", time() - 3600);
                }
            }
        }
        //add your code
    }
}
?>


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
    <link href="css/modern.css" rel="stylesheet">
    <script src="js/settings.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-7"></script>
    <script>
        function validateusername() {
            let id = document.forms["loginForm"]["username"].value;
            let error;

            if (id == "") {
                error = "Id is required.";
                document.getElementById("username-error").innerHTML = error;
                document.getElementById('username').className = "form-control form-control-lg is-invalid";
                return false;

            } else if (/^[0-9-]+$/.test(id) == false) {
                error = "ID can contain letter, hyphens(-).";
                document.getElementById("username-error").innerHTML = error;
                document.getElementById('username').className = "form-control form-control-lg is-invalid";
                return false;
            } else if (id != "") {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (this.responseText == "false") {
                        error = "ID not found.";
                        document.getElementById("username-error").innerHTML = error;
                        document.getElementById('username').className = "form-control form-control-lg is-invalid";
                        return false;
                    } else if (this.responseText == "true") {
                        error = "";
                        document.getElementById("username-error").innerHTML = error;
                        document.getElementById('username').className = "form-control form-control-lg";
                        return true;
                    }
                }
                xhttp.open("GET", "General/Controller/validUsernameCheckController.php?username=" + id);
                xhttp.send();
            }
        }

        function validateLoginpassword() {
            let password = document.forms["loginForm"]["password"].value;
            let id = document.forms["loginForm"]["username"].value;
            let error;


            if (id == "") {
                error = "Fill id first.";
                document.getElementById("password-error").innerHTML = error;
                document.getElementById('password').className = "form-control form-control-lg is-invalid";
                return false;
            } else if (password == "") {
                error = "Password is required.";
                document.getElementById("password-error").innerHTML = error;
                document.getElementById('password').className = "form-control form-control-lg is-invalid";
                return false;
            } else if (password != "" && id != "") {
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    if (this.responseText == "false") {
                        error = "Password not matched.";
                        document.getElementById("password-error").innerHTML = error;
                        document.getElementById('password').className = "form-control form-control-lg is-invalid";
                        return false;
                    } else if (this.responseText == "true") {
                        error = "";
                        document.getElementById("password-error").innerHTML = error;
                        document.getElementById('password').className = "form-control form-control-lg";
                        return true;
                    }
                }
                xhttp.open("GET", "General/Controller/validPasswordCheckController.php?username=" + id + "&password=" + password);
                xhttp.send();
            }
        }


        function validate_login_form() {
            let correctID = validateusername();
            let correctPassword = validateLoginpassword();
            console.log(correctPassword);

            if (correctID != false && correctPassword != false) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</head>



<body class="theme-blue">
    <section class="pt-6 landing-bg text-white overflow-hidden">
        <nav class="navbar navbar-expand navbar-dark absolute-top w-100 py-2">
            <div class="container">
                <a class="navbar-brand font-weight-bold" href="index.php">
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
                            if ($isStudent) {
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
                                        if ($isStudent) {

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
                        <div class="text-center">Not you? <a href="Learner/registration.php">Sign up</a></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/app.js"></script>

</body>

</html>