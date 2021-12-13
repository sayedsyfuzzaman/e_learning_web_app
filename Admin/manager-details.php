<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manager Details</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
require_once 'controller/Manager.php';
$manager = new Manager();
if (isset($_GET['status']) && !empty($_GET['status']) && !empty($_GET['id'])) {

    if ($manager->updateStatus($_GET['status'], $_GET["id"])) {
        header('Location: manager-details.php?status=changed');
    } else {
        header('Location: manager-details.php?status=submission_error');
    }
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
                            Manager Details
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard-default.html">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Manager Details</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Showing all manager</h5>
                                    <h6 class="card-subtitle text-muted">If you are using from mobile, click on a particular image to see more.</h6>
                                </div>
                                <div class="card-body">
                                    <table id="datatables-buttons" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>ID</th>
                                                <th>Email</th>
                                                <th>Nationality</th>
                                                <th>NID</th>
                                                <th>Hire Date</th>
                                                <th>Block/Unblock</th>
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
                                                <th>Email</th>
                                                <th>Nationality</th>
                                                <th>NID</th>
                                                <th>Salary</th>
                                                <th>Block/Unblock</th>
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

            var getUrlParameter = function getUrlParameter(sParam) {
                var sPageURL = window.location.search.substring(1),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;

                for (i = 0; i < sURLVariables.length; i++) {
                    sParameterName = sURLVariables[i].split('=');

                    if (sParameterName[0] === sParam) {
                        return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
                    }
                }
                return false;
            };
            //notification
            var param = getUrlParameter('status');
            if (param == "changed") {
                var message = "Account avilability changed.";
                var title = "Status Changed!";
                var type = "success"; //success info warning error
                toastr[type](message, title, {
                    positionClass: "toast-bottom-right",
                    closeButton: "checked",
                    progressBar: "checked",
                    newestOnTop: "checked",
                    rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
                    timeOut: "2500"
                });
            } else if (param == "submission_error") {
                var message = "There was an error, We couldn't perform your action. Please try again laterr.";
                var title = "Error";
                var type = "error"; //success info warning error
                toastr[type](message, title, {
                    positionClass: "toast-bottom-right",
                    closeButton: "checked",
                    progressBar: "checked",
                    newestOnTop: "checked",
                    rtl: $("body").attr("dir") === "rtl" || $("html").attr("dir") === "rtl",
                    timeOut: "5000"
                });
            }



            $("#toastr-clear").on("click", function() {
                toastr.clear();
            });
            $("#close-status").click(function() {
                $("#status").hide();
            });

            $('#datatables-buttons').DataTable({
                ajax: {
                    url: 'model/getManagers.php',
                    dataSrc: ''
                },
                columns: [{
                        data: "image"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "id"
                    },
                    {
                        data: "email"
                    },
                    {
                        data: "nationality"
                    },
                    {
                        data: "nid"
                    },
                    {
                        data: "created_at"
                    },
                    {
                        data: "status"
                    },
                    {
                        data: "action"
                    },
                ],
                responsive: true
            });
        });
    </script>


</body>

</html>