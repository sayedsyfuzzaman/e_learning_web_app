<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">
    <link href="../css/modern.css" rel="stylesheet">

    <title>Registration</title>

    <style>
        body {
            opacity: 0;
        }
    </style>
    <script src="../js/settings.js"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-7"></script>
    <script src="js/validation.js"></script>
</head>

<?php
session_start();
$message =  "";
if(!isset($_SESSION["message"])){
    header("Location: ../sign-in.php");
}

$message=$_SESSION["message"];
session_destroy();
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    header("Location:../sign-in.php");
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
                            <h1 class="h2">Sign Up Completed.</h1>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form name="regForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <div class="form-group">
                                            <span class="text-success h2">
                                                <?php
                                                if (isset($message)) {
                                                    echo $message;
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        </div>
                                        <div class="col text-center">
                                            <button type="submit" class="btn btn-primary">Okay</button>
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