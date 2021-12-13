<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<?php
session_start();
if (!isset($_SESSION['id'])) {
	session_destroy();
	header("location: ../sign-in.php");
}

$userInfo = array(
	'id' => "",
	'usertype' => "",
	'name' => "",
	'email' => "",
	'image' => ""
);

if (isset($_SESSION['id'])) {
	$userInfo["id"] = $_SESSION['id'];
	$userInfo["usertype"] = $_SESSION['usertype'];
	$userInfo["name"] = $_SESSION['name'];
	$userInfo["email"] = $_SESSION['email'];
	$userInfo["image"] = $_SESSION['image'];
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
                            Welcome back, <?php echo $userInfo["name"]; ?>
                        </h1>
                        <p class="header-subtitle">You have 24 new messages and 5 new notifications.</p>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Blank</h5>
                                </div>
                                <div class="card-body">

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
</body>

</html>