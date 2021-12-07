<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Sign In</title>

    <link href="css/modern.css" rel="stylesheet">
</head>
<!-- SET YOUR THEME -->

<?php

session_start();
if (isset($_SESSION['id'])) {
    header("location: Admin/dashboard.php");
}


$time = time();
$count = 0;

if (isset($_COOKIE['invalid'])) {
    $count = $_COOKIE['invalid'];
} else {
    setcookie('invalid', 0);
}

$userErr = "";
$data = array(
    'id' => "",
    'password' => ""
);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = array(
        'id' => test_input($_POST["id"]),
        'password' => $_POST["password"]
    );


    if ($count < 3) {
        if (!empty($_POST["id"]) and !empty($_POST["password"])) {
            require_once "Admin/controller/authentication.php";

            $authentication = new authentication();
            $isUser = $authentication->authenticateUser($data);

            if ($isUser == false) {
                $count = $count + 1;
                setcookie('invalid', $count, time() + 30);
                $userErr =  "Invalid id or password!";
            }
        } else {
            $userErr =  "Username or password cannot be empty!";
        }

        if (!empty($_POST['remember'])) {

            setcookie("id", $_POST['id'], time() + (60*60*24*30*12));
            setcookie("password", $_POST['password'], time() + (60*60*24*30*12));
        }
    } else {
        $userErr =  "Too many login attempts, Please try again later.";
    }
}
?>


<body>
    <main class="main h-100 w-100">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">

                            <h2>E-Learning Web App</h2>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <h3>Welcome back!</h3>
                                        <p class="lead">
                                            Sign in to your account to continue
                                        </p>

                                        <b class="text-danger"><?php echo $userErr; ?></b>
                                    </div>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input class="form-control" type="text" name="id" placeholder="Enter your id" value="<?php if (isset($_COOKIE['id'])) {
                                                                                                                                                        echo $_COOKIE['id'];
                                                                                                                                                    } else {
                                                                                                                                                        echo $data["id"];
                                                                                                                                                    } ?>" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                                                                    echo $_COOKIE['password'];
                                                                                                                                                                                } else {
                                                                                                                                                                                    echo $data["password"];
                                                                                                                                                                                } ?>" />
                                            <small>
                                                <a href="#">Forgot password?</a>
                                            </small>
                                        </div>
                                        <div>
                                            <div class="custom-control custom-checkbox align-items-center">
                                                <input id="customControlInline" class="custom-control-input" type="checkbox" id="remember" name="remember" value="remember" checked>
                                                <label class="custom-control-label text-small" for="customControlInline">Remember me next time</label>
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-primary">Sign in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>