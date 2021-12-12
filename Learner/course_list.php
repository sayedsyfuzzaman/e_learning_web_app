<?PHP
session_start();
$name = $picture = "";
$allCourses = array();
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
require_once "Controller/CourseController.php";
$course = new course();
$allCourses = $course->getAllcouse();

?>

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
                        <?php if (empty($allCourses)) : ?>
                            <div class="col-md-12 col-lg-12 text-center">
                                <a class="mb-3 card overflow-hidden" href="#">
                                    <div class="px-4 pt-4">
                                        <img src="../courseThumbnail/course-thumbnail.png" class="img-fluid card-img-hover landing-img" />
                                    </div>
                                </a>
                                <h4>No Course available yet!</h4>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($allCourses)) : ?>
                            <?php foreach ($allCourses as $i => $course) : ?>
                                <div class="col-md-4 col-lg-4 text-center">
                                    <a class="mb-3 card overflow-hidden" data-toggle="modal" data-target="<?PHP echo '#defaultModalPrimary' . $course['course_id'] ?>">
                                        <div class="px-4 pt-4">
                                            <img src=<?PHP echo "../" . $course["thumbnail"] ?> class="img-fluid card-img-hover landing-img" />
                                        </div>
                                    </a>
                                    <h4><?PHP echo $course["course_name"] ?></h4>
                                    <h5><?PHP echo "Course ID: " . $course["course_id"] ?></h5>
                                </div>
                                <div class="modal fade" id="<?PHP echo 'defaultModalPrimary' . $course['course_id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><?PHP echo $course["course_name"] ?></h5><br>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearInfo('<?PHP echo 'course-add-error' . $course['course_id'] ?>','<?PHP echo 'course-add-complete' . $course['course_id'] ?>')">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body m-3">
                                                <p class="mb-0"><?PHP echo "Course pice: " . ($course["price"] - ($course["price"] * ($course["discount"] / 100))) ?></p>
                                                <p id="<?PHP echo 'course-add-error' . $course['course_id'] ?>" class="mb-0" style="color:red"></p>
                                                <p id="<?PHP echo 'course-add-complete' . $course['course_id'] ?>" class="mb-0" style="color:green"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="clearInfo('<?PHP echo 'course-add-error' . $course['course_id'] ?>','<?PHP echo 'course-add-complete' . $course['course_id'] ?>')">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="addCourse('<?php echo $_SESSION['username'] ?>' , '<?php echo $course['course_id'] ?>' , '<?php echo $course['course_name'] ?>' , <?php echo ($course['price'] - ($course['price'] * ($course['discount'] / 100))) ?>,'<?PHP echo 'course-add-error' . $course['course_id'] ?>','<?PHP echo 'course-add-complete' . $course['course_id'] ?>')">
                                                    Add Course</button>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        function addCourse(id, course_id, course_name, course_price,ld_1,ld_2) {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                is_inserted = this.responseText;
                if (is_inserted == "invalid") {
                    error = "Alray taken.";
                    document.getElementById(ld_1).innerHTML = error;
                    document.getElementById(ld_2).innerHTML = "";
                } else if (is_inserted == "valid") {
                    document.getElementById(ld_1).innerHTML = "";
                    document.getElementById(ld_2).innerHTML = "Crouse Enrolled";
                }
            }
            xhttp.open("GET", "Controller/addCourse.php?id=" + id + "&course_id=" + course_id + "&course_price=" + course_price + "&course_name=" + course_name);
            xhttp.send();
        }


        function clearInfo(ld_1,ld_2) {
            document.getElementById(ld_1).innerHTML = "";
            document.getElementById(ld_2).innerHTML = "";
        }

    </script>


</body>

</html>