<?PHP
session_start();
$name = $picture = "";
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
    $matarial = $obj->get_LearnerCurrentCourseMatarial($data);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($matarial)) {
        setcookie("material_id", $matarial["material_id"], time() + 20);
        setcookie("serial", $matarial["serial"], time() + 20);
        header("location:quiz.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Matarial</title>
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
            document.getElementById('course_matarial').className = "sidebar-item active";
        </script>
        <div class="main">
            <?php
            include 'navbar.php';
            ?>

            <!-- Start from here -->
            <main class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php if (empty($matarial)) : ?>
                            <div class="col-md-12 text-center">
                                <h1 class="text-white">Congratulations! <br>You have successfully completed this course.<br> Please download your certificate for certificate section.</h1>
                            </div>
                            <div class="col-md-12 col-lg-12 text-center">
                                <a class="mb-3 card overflow-hidden">
                                    <div class="px-4 pt-4">
                                        <img src=<?PHP echo "../" . $Course["thumbnail"] ?> class="img-fluid card-img-hover landing-img" />
                                    </div>
                                </a>
                                <h2><?PHP echo $Course["course_name"] ?></h2>
                                <h3><?PHP echo "Course ID: " . $Course["course_id"] ?></h3>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($matarial)) : ?>
                            <div class="col-md-12 text-center">
                                <h1 class="text-white"><?PHP echo $Course["course_name"] ?><br><?PHP echo $matarial["title"] ?></h1>
                            </div>
                            <div class="col-md-12 col-lg-12 text-center">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="<?PHP echo "../" . $matarial["video_file"] ?>" allowfullscreen></iframe>
                                </div>
                                <?php if (!empty($matarial["file"])) : ?>
                                    <br>
                                    <a href="<?PHP echo "../" . $matarial["file"] ?>" download>
                                        <button class="btn btn-primary btn-lg"><i class="fa fa-download"></i> Download Lacture Note</button>
                                    </a>
                                    <br>
                                <?php endif; ?>
                                <br>
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <button class="btn btn-primary btn-lg" name="quiz_btn" id="quiz_btn">Attend Quiz</button>
                                </form>
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