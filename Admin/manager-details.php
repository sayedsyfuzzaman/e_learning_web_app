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

require_once 'controller/manager.php';

$manager = new Manager();
$managerInfo = $manager->fetchAllManager();


if (isset($_GET['delete_manager']) && !empty($_GET['delete_manager'])) {

    if ($manager->deleteManager($_GET['delete_manager'])) {
        header('Location: manager-details.php?status=deleted');
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
                                    <h6 class="card-subtitle text-muted">You can print, export and search your desired information.</h6>
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
                                                <th>Salary</th>
                                                <th>Hire Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($managerInfo as $row) : ?>
                                                <tr>
                                                    <td id=""> <img style="height: 40px; height: 40px;" src="<?php echo $row["image"]; ?>" alt="Image"> </td>
                                                    <td><?php echo $row["name"]; ?></td>
                                                    <td><?php echo $row["id"]; ?></td>
                                                    <td><?php echo $row["email"]; ?></td>
                                                    <td><?php echo $row["nationality"]; ?></td>
                                                    <td><?php echo $row["nid"]; ?></td>
                                                    <td><?php echo $row["salary"]; ?></td>
                                                    <td><?php echo $row["created_at"]; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-primary" onclick="window.location.href='manager_log.php?id=<?php echo $row['id'] ?>'">View More</button>
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
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
                                                <th>Hire Date</th>
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
        $(".btn-danger").click(function() {
            var dialog = confirm("Are you sure want to delete this manager?");
            if (dialog == true) {
                var currentRow = $(this).closest("tr");
                var id = currentRow.find("td:eq(2)").text();
                var url = "manager-details.php?delete_manager="+id;
                location.replace(url);
            }
        });
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
            if (param == "deleted") {
                var message = "Manager deleted successfully from the system.";
                var title = "Deleted!";
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

            var datatablesButtons = $('#datatables-buttons').DataTable({
                lengthChange: !1,
                buttons: ["csv", "print"],
                responsive: true
            });
            datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
        });
    </script>


</body>

</html>