<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="css/modern.css" rel="stylesheet">
    <script src="js/settings.js"></script>
</head>

<?PHP
session_start();
$name = $email = $gender = $dob = $username  = $highest_degree = $picture = "";
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

require_once "Controller/receiceLearnerInfoController.php";
$obj = new student_info();
$learner = $obj->get_learner($_SESSION['username']);

if (!empty($learner)) {
    $name = $learner['name'];
    $picture = $learner['image'];
    $dob = $learner['dob'];
    $gender = $learner['gender'];
    $highest_degree = $learner['highest_degree'];
    $email = $learner['email'];
}

?>

<body>
    <div class="wrapper">
        <?php
        include 'sidebar.php';
        ?>

        <script>
            document.getElementById('home').className = "sidebar-item";
            document.getElementById('view_profile').className = "sidebar-item active";
        </script>
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
                                            <h5 class="card-title mb-0">Public info</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="inputUsername">Username</label>
                                                            <input type="text" class="form-control text-dark" id="inputUsername" placeholder="Username" disabled value="<?php echo $_SESSION['username']; ?>">
                                                            <div class="form-group">
                                                                <label for="inputUsername">Name</label>
                                                                <input type="text" class="form-control text-dark" placeholder="First name" disabled value="<?php echo $name; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="text-center">
                                                            <img alt="Chris Wood" src="<?php echo $picture; ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Private info</h5>
                                        </div>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="inputFirstName">Name</label>
                                                    <input type="text" class="form-control text-dark" id="inputFirstName" placeholder="First name" disabled value="<?php echo $name; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputEmail4">Email</label>
                                                    <input type="email" class="form-control text-dark" id="inputEmail4" placeholder="Email" disabled value="<?php echo $email; ?>">
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="highest_degree">Higest degree</label>
                                                        <input type="text" class="form-control text-dark" id="highest_degree" disabled value="<?php echo $highest_degree; ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="dob">Date of Birth</label>
                                                        <input type="text" class="form-control text-dark" id="dob" disabled value="<?php echo $dob; ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="gender">Gender</label>
                                                        <input type="text" class="form-control text-dark" id="gener" disabled value="<?php echo $gender; ?>">
                                                    </div>
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
            <?php
            include 'footer.php';
            ?>

        </div>

    </div>

    <!-- Javascript Start from here -->
    <script src="js/app.js"></script>

</body>

</html>