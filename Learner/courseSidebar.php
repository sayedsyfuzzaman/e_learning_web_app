<!DOCTYPE html>
<html lang="en">
<?PHP
$name = $picture = "";
require_once "Controller/receiceLearnerInfoController.php";
$obj = new student_info();
$learner = $obj->get_learner($_SESSION['username']);

if (!empty($learner)) {
    $name = $learner['name'];
    $picture = $learner['image'];
} else {
    $name = "";
    $picture = "";
}
?>

<body>
    <nav id="sidebar" class="sidebar">
        <a class="sidebar-brand" href="dashboard.php">
            Course Dashboard
        </a>
        <div class="sidebar-content">
            <div class="sidebar-user">
                <img src="<?php echo $picture; ?>" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
                <div class="font-weight-bold"><?php echo $name; ?></div>
                <small>Learner</small>
            </div>

            <ul class="sidebar-nav">
                <li class="sidebar-header">
                    Course Panel
                </li>

                <li class="sidebar-item">
                    <a href="#course" data-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle mr-2 fas fa-fw fa-book"></i> <span class="align-middle">Course</span>
                    </a>
                    <ul id="course" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                        <li id="course_dashboard" class="sidebar-item "><a class="sidebar-link" href="courseDashboard.php">Course Dashboard</a></li>
                        <li id="course_matarial" class="sidebar-item"><a class="sidebar-link" href="courseMatarial.php">Course Matarial</a></li>
                        <!--<li id="course_comunity" class="sidebar-item"><a class="sidebar-link" href="#">Course Comunity</a></li> -->
                        <li id="get_certificate" class="sidebar-item"><a class="sidebar-link" href="certificate.php">Certificate</a></li>
                        <li class="sidebar-item"><a class="sidebar-link" href="dashboard.php">Main Manu</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>