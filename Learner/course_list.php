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
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1 class="text-white">Course List</h1>
                        </div>
                        <div class="col-md-12 col-lg-12 text-center">
                            <a class="mb-3 card overflow-hidden" href="#">
                                <div class="px-4 pt-4">
                                    <img src="../courseThumbnail/course-thumbnail.png" class="img-fluid card-img-hover landing-img" />
                                </div>
                            </a>
                            <h4>No Course available yet!</h4>
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