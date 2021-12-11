<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Course List</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>

    <script>
        document.getElementById('home').className = "sidebar-item";
        document.getElementById('course_list').className = "sidebar-item active";
    </script>

</head>

<?PHP
session_start();
$name = $picture = "";
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
?>

<body>
    <div class="wrapper">
        <?php
        include 'sidebar.php';
        ?>
        <script>
            document.getElementById('home').className = "sidebar-item";
            document.getElementById('course_list').className = "sidebar-item active";
        </script>
        <div class="main">
            <?php
            include 'navbar.php';
            ?>

            <!-- Start from here -->
            <main class="content">
                <div class="container-fluid">


                    <div class="header">
                        <h1 class="header-title">
                            Course List
                        </h1>
                        <p class="header-subtitle"></p>
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

    <!-- Javascript Start from here -->
    <script src="../js/app.js"></script>


</body>

</html>