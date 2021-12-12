<?PHP
session_start();
$name = $picture = "";
$progress = 0;
$Course = array();
if (isset($_GET["course_id"])) {
    $_SESSION["course_id"] = $_GET["course_id"];
}
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
if (!isset($_SESSION['course_id'])) {
    header("location:dashboard.php");
} else {
    $data = array(
        "id" => $_SESSION['username'],
        "course_id" => $_SESSION["course_id"]
    );
    require_once "Controller/CourseController.php";
    $obj = new course();
    $Course = $obj->get_LearnerACourseInfo($data);
    if (empty($Course)) {
        unset($_SESSION['course_id']);
        header("location:dashboard.php");
    }
    $progress = $obj->get_LearnerACourseProgress($data);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Crouse Dashboard</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>

</head>



<body>
    <div class="wrapper">
        <?php
        include 'courseSidebar.php';
        ?>
        <script>
            document.getElementById('course_dashboard').className = "sidebar-item active";
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
                            <h1 class="text-white">Your courses</h1>
                        </div>
                        <div class="col-md-12 col-lg-12 text-center">
                            <a class="mb-3 card overflow-hidden">
                                <div class="px-4 pt-4">
                                    <img src=<?PHP echo "../" . $Course["thumbnail"] ?> class="img-fluid card-img-hover landing-img" />
                                    <h2><?PHP echo "Progression: " . $progress."%" ?></h2>
                                </div>
                            </a>
                            <h2><?PHP echo $Course["course_name"] ?></h2>
                            <h3><?PHP echo "Course ID: " . $Course["course_id"] ?></h3>
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