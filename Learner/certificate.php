<?PHP
session_start();
$id = $picture = "";
$matarial = array();
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
    $id = $_SESSION['username'];
    $matarial = $obj->get_LearnerCurrentCourseMatarial($data);

    require_once "Controller/receiceLearnerInfoController.php";
    $obj = new student_info();
    $learner = $obj->get_learner($_SESSION['username']);


    if (empty($matarial)) {
        $font = "../fonts/Pacifico.ttf";
        $font2 = "../fonts/Aller_Bd.ttf";
        $image = imagecreatefromjpeg("../Certificate/defaultCertificate.jpg");
        $color = imagecolorallocate($image, 19, 21, 22);
        $name = $learner['name'];
        $name_len = strlen($name);
        imagettftext($image, 30, 0, 1000 - ($name_len * 10), 800, $color, $font, $name);
        $course = $Course["course_name"];
        $course_len = strlen($course);
        imagettftext($image, 30, 0, 1000 - ($course_len * 10), 1050, $color, $font, $course);
        $date = date("jS \of F Y");
        imagettftext($image, 23, 0, 1355, 1190, $color, $font2, $date);
        imagejpeg($image, "../Certificate/" . $id . ".jpg");
        imagedestroy($image);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Certificates</title>
    <link href="../css/modern.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/settings.js"></script>

</head>



<body>
    <div class="wrapper">
        <?php
        include 'courseSidebar.php';
        ?>
        <script>
            document.getElementById('get_certificate').className = "sidebar-item active";
        </script>
        <div class="main">
            <?php
            include 'navbar.php';
            ?>

            <!-- Start from here -->
            <main class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php if (!empty($matarial)) : ?>
                            <div class="col-md-12 text-center">
                                <h1 class="text-white">You need to complete this course for geting certificate.</h1>
                            </div>
                            <div class="col-md-12 col-lg-12 text-center">
                                <a class="mb-3 card overflow-hidden">
                                    <div class="px-4 pt-4">
                                        <img src=<?PHP echo "../" . $Course["thumbnail"] ?> class="img-fluid card-img-hover landing-img" />
                                    </div>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (empty($matarial)) : ?>
                            <div class="col-md-12 text-center">
                                <h1 class="text-white">Congratulations! <br>You have successfully completed this course.<br> Please download your certificate.</h1>
                            </div>
                            <div class="col-md-12 col-lg-12 text-center">
                                <a class="mb-3 card overflow-hidden">
                                    <div class="px-4 pt-4">
                                        <h2><?PHP echo $Course["course_name"] ?></h2>
                                        <h3><?PHP echo "Course ID: " . $Course["course_id"] ?></h3>
                                        <br>
                                        <a href="<?PHP echo "../Certificate/" . $id . ".jpg" ?>" download>
                                            <button class="btn btn-primary btn-lg"><i class="fa fa-download"></i> Download Certificate</button>
                                        </a>
                                        <br>
                                    </div>
                                </a>
                            </div>
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