<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Activity Log</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                            Activity Log
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Activity Log</li>
                            </ol>
                        </nav>
                    </div>


                    <div class="row">
                        <div class="col-md-3 col-xl-2">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Filter Activity</h5>
                                </div>
                                <div class="card-body">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="filter" value="Manager">
                                        <span class="custom-control-label">Manager's Log</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="filter" value="Instructor">
                                        <span class="custom-control-label">Instructor's Log</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="filter" value="learner">
                                        <span class="custom-control-label">Learner's Log</span>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="filter" value="Admin">
                                        <span class="custom-control-label">Admin's Log</span>
                                    </label>
                                    <button id="filter-button" class="btn btn-primary"> <i class="align-middle mr-3 fas fa-fw fa-filter"></i>Filter Now</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9 col-xl-10">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Filtered Activity Log</h5>
                                    <h6 class="card-subtitle text-muted">If you are using from mobile, click on a particular image to see more.</h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <td>Title</td>
                                            <td>Details</td>
                                            <td>Date</td>
                                        </thead>
                                        <tbody>
                                        </tbody>
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

    <!-- Javascript Start from here -->
    <script src="../js/app.js"></script>

    <script type="text/javascript">
        $('#datatable').DataTable({
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
            responsive: true
        });

        $("#filter-button").click(function() {
            var filter = [];
            $('#datatable').DataTable().clear().destroy();
            $.each($("input[name='filter']:checked"), function() {
                filter.push($(this).val());
            });

            $('#datatable').DataTable({
                ajax: {
                    url: 'model/getFilteredActivityLog.php',
                    method: 'POST',
                    data: {
                        value: filter
                    },
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
                responsive: true
            });
        });
    </script>

</body>

</html>