<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Learner Informations</title>
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
                            Learner Informations
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Learner Informations</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Showing all learner</h5>
                                    <h6 class="card-subtitle text-muted">If you are using from mobile, click on a particular image to see more.</h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatable" class="table table-striped table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>ID</th>
                                                <th>Highest Degree</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>ID</th>
                                                <th>Highest Degree</th>
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

    <script type="text/javascript">
        $('#datatable').DataTable({
            ajax: {
                url: 'model/getLearners.php',
                dataSrc: ''
            },
            columns: [
                { data: "image" },
                { data: "name" },
                { data: "id" },
                { data: "highest_degree" },
                { data: "action" },
            ],
            responsive: true
        });
    </script>


</body>

</html>