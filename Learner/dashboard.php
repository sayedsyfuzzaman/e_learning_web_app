<?PHP
session_start();
$name = $picture = "";
$allCourses = array();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
if (isset($_SESSION['course_id'])){
    unset($_SESSION['course_id']);
}
require_once "Controller/CourseController.php";
$course = new course();
$allCourses = $course->get_LearnerCourseInfo($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>

</head>



<body>
    <div class="wrapper">
        <?php
        include 'sidebar.php';
        ?>
        <script>
            document.getElementById('home').className = "sidebar-item active";
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
                            <h1 class="text-white">Your taken courses</h1>
                        </div>
                        <?php if (empty($allCourses)) : ?>
                            <div class="col-md-12 col-lg-12 text-center">
                                <a class="mb-3 card overflow-hidden" href="#">
                                    <div class="px-4 pt-4">
                                        <img src="../courseThumbnail/course-thumbnail.png" class="img-fluid card-img-hover landing-img" />
                                    </div>
                                </a>
                                <h4>You haven't taken any courses!</h4>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($allCourses)) : ?>
                            <?php foreach ($allCourses as $course) : ?>
                                <div class="col-md-4 col-lg-4 text-center">
                                    <a class="mb-3 card overflow-hidden" href="<?PHP echo "courseDashboard.php?course_id=".$course['course_id']?>" >
                                        <div class="px-4 pt-4">
                                            <img src=<?PHP echo "../" . $course["thumbnail"] ?> class="img-fluid card-img-hover landing-img" />
                                        </div>
                                    </a>
                                    <h4><?PHP echo $course["course_name"] ?></h4>
                                    <h5><?PHP echo "Course ID: " . $course["course_id"] ?></h5>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>
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