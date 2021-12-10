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

if (isset($_GET['id']) && !empty($_GET['id'])) {
}
?>

<script>
    var table = document.getElementById('datatable');

    for (var i = 1; i < table.rows.length; i++) {
        table.rows[i].onclick = function() {
            rIndex = this.rowIndex;
            alert(this.cells[1].innerHTML);
            document.getElementById("fname").value = this.cells[0].innerHTML;
            document.getElementById("lname").value = this.cells[1].innerHTML;
            document.getElementById("age").value = this.cells[2].innerHTML;
        };
    }
</script>

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
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ion ion-ios-search mr-2"></i></span>
                                        </div>
                                        <input type="text" id="input-data" class="form-control" onkeyup="search()" placeholder="Type here to search value from table.">
                                        <button class="btn btn-secondary"><i class="fas ion-ios-refresh"></i></button>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <table id="datatable" class="table table-striped" style="width:100%">
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
                                                        <button type="button" class="btn btn-outline-primary" id="view-button">View and Edit</button>
                                                        <button type="button" class="btn btn-danger" onclick="window.location.href='all_managers.php?id=<?php echo $row['id'] ?>'">Delete</button>
                                                    </td>

                                                </tr>
                                                <div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class=" modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal_id"><?php echo $row['name'] ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
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
        function search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("input-data");
            filter = input.value.toUpperCase();
            table = document.getElementById("datatable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>


</body>

</html>