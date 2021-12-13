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
    'password' => "",
    'usertype' => "",
    'name' => "",
    'email' => "",
    'image' => ""
);

if (isset($_SESSION['id'])) {
    $userInfo["id"] = $_SESSION['id'];
    $userInfo["password"] = $_SESSION['password'];
    $userInfo["usertype"] = $_SESSION['usertype'];
    $userInfo["name"] = $_SESSION['name'];
    $userInfo["email"] = $_SESSION['email'];
    $userInfo["image"] = $_SESSION['image'];
}

require_once 'controller/Overview.php';

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
                        <div class="col-12 col-lg-6 col-xxl-7 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <div class="card-actions float-right">
                                        <a target="_blank" class="btn btn-outline-primary" href="#">Explore Courses</a>
                                    </div>
                                    <h5 class="card-title mb-0">Latest Courses</h5>
                                </div>
                                <table id="courses" class="table table-striped my-0">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-5 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Course Enrolles</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book align-middle">
                                                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                                            </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3"><?php dailyCourseEnrolles(); ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-success">Total number of course enrolled today</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">User Registered</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle">
                                                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="9" cy="7" r="4"></circle>
                                                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3"><?php dailyUserResisters(); ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-success">Total number of user account created today</span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Total Earnings</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle">
                                                                    <line x1="12" y1="1" x2="12" y2="23"></line>
                                                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3">$<?php totalEarnings(); ?></h1>
                                                <div class="mb-0">
                                                    <span class="text-success">Total earnings from learner by enrolled courses</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Pending Orders</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="avatar">
                                                            <div class="avatar-title rounded-circle bg-primary-dark">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-middle">
                                                                    <circle cx="9" cy="21" r="1"></circle>
                                                                    <circle cx="20" cy="21" r="1"></circle>
                                                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                                                </svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="display-5 mt-1 mb-3">43</h1>
                                                <div class="mb-0">
                                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span>
                                                    Less orders than usual
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-lg-6 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Latest Activity</h5>
                                </div>
                                <table id="datatables" class="table table-striped my-0">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
    <script>
        $(function() {
            $('#courses').DataTable({
                ajax: {
                    url: 'model/getAllCourses.php',
                    method: 'POST',
                    dataSrc: ''
                },
                columns: [{
                        data: "thumbnail"
                    },
                    {
                        data: "course_name"
                    },
                    {
                        data: "date"
                    },
                    {
                        data: "created_by"
                    }
                ],
                responsive: true,
                pageLength: 4,
                lengthChange: false,
                bFilter: false,
                autoWidth: false,
                "bSort" : false
            });

            $('#datatables').DataTable({
                ajax: {
                    url: 'model/getFilteredActivityLog.php',
                    method: 'POST',
                    dataSrc: ''
                },
                columns: [{
                        data: "title"
                    },
                    {
                        data: "details"
                    },
                    {
                        data: "date"
                    }
                ],
                responsive: true,
                pageLength: 5,
                lengthChange: false,
                bFilter: false,
                autoWidth: false,
                "bSort" : false
            });
        });
    </script>
</body>

</html>