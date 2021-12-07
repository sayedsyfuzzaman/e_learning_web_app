<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>View Profile</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <style>
        hr {
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>

<?php
session_start();
if (!isset($_SESSION['id'])) {
    session_destroy();
    header("location:../sign-in.php");
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
                            View Profile
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Profile</a></li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="account" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0"><?php echo $_SESSION["name"]; ?></h5>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">ID: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["id"]; ?></label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">Email: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["email"]; ?></label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">Phone Number: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["phone"]; ?></label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">Nationality: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["nationality"]; ?></label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">NID: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["nid"]; ?></label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">Date of Birth: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["dob"]; ?></label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">Gender: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["gender"]; ?></label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-sm-4 text-sm-right">Address: </label>
                                                            <div class="col-sm-8">
                                                                <label class="col-form-label"><?php echo $_SESSION["address"]; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="text-center">
                                                        <img alt="" src="<?php echo $_SESSION["image"]; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                                                    </div>
                                                </div>
                                            </div>
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

</body>

</html>