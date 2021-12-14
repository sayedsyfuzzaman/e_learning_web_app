<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Courses</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
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
                            All Courses
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Courses</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Showing all courses</h5>
                                    <h6 class="card-subtitle text-muted">If you are using from mobile, click on a particular image to see more.</h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Thumbnail</th>
                                                <th>Course Name</th>
                                                <th>Course ID</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Thumbnail</th>
                                                <th>Course Name</th>
                                                <th>Course ID</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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

    <script>
        $(function() {
            $('#datatable').DataTable({
                ajax: {
                    url: 'model/getCourses.php',
                    dataSrc: ''
                },
                columns: [{
                        data: "thumbnail"
                    },
                    {
                        data: "course_name"
                    },
                    {
                        data: "course_id"
                    },
                    {
                        data: "created_by"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "action"
                    }
                ],
                responsive: true
            });
        });
    </script>


</body>

</html>