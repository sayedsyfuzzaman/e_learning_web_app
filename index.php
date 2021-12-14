<?PHP

require_once "General/Controller/CourseController.php";
$course = new course();
$allCourses = $course->getAllcouse();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="css/modern.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark absolute-top w-100 py-2">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="index.php">
                E-Learning Web App
            </a>
            <a class="btn btn-success btn-pill my-2 ml-2" href="sign-in.php">
                Login
            </a>
        </div>
    </nav>

    <section class="pt-7 pb-5 landing-bg text-white overflow-hidden">
        <div class="container py-4">
            <div class="row">
                <div class="col-xl-11 mx-auto">
                    <div class="row">
                        <div class="col-md-12 col-xl-8 text-center mx-auto">
                            <div class="d-block my-4">
                                <h1 class="display-4 font-weight-bold mb-3 text-white">Learn Without Limits</h1>
                                <div class="my-4">
                                    <a href="Learner/registration.php" class="btn btn-lg btn-pill btn-success">Join For Free</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="py-3 bg-white landing-nav">
        <div class="container text-center">
            <a href="index.php" class="btn btn-lg btn-pill btn-primary">Home</a>
            <a href="about_us.php" class="btn btn-lg btn-pill btn-link text-dark">About Us</a>
            <a target="_blank" href="mailto:sayedsyfuzzaman@gmail.com" class="btn btn-lg btn-pill btn-link text-dark">Support</a>
        </div>
    </div>

    <section class="py-6">
        <div class="container">
            <div class="mb-4 text-center">
                <h2>Start Learning</h2>
            </div>

            <div class="row pb-3">
                <?php if (empty($allCourses)) : ?>
                    <div class="col-md-6 col-lg-4 text-center">
                        <h4>No Course available yet!</h4>
                        <a class="mb-3 card overflow-hidden" href="#">
                            <div class="px-2 pt-2">
                                <img src="courseThumbnail/course-thumbnail.png" class="img-fluid card-img-hover landing-img" alt="Machine Learning" />
                            </div>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($allCourses)) : ?>
                    <?php foreach ($allCourses as $i => $course) : ?>
                        <div class="col-md-6 col-lg-4 text-center">
                            <a class="mb-3 card overflow-hidden" href="sign-in.php">
                                <div class="px-2 pt-2">
                                    <img src="<?PHP echo  $course["thumbnail"] ?>" height="250px" weight="350px" class="img-fluid card-img-hover landing-img" alt="Machine Learning" />
                                </div>
                                <h4 class="pt-2"><?PHP echo $course["course_name"] ?></h4>
                                <p class="pt-2"><?PHP echo "Course price: ". $course["price"] ?><br><?PHP echo "Discount: ". $course["discount"] ."%"?></p>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <h2 class="mb-3">
                        Take the next step toward your personal and professional goals with E-Learning Web App.
                    </h2>
                    <a href="#" target="_blank" class="align-middle btn btn-success btn-lg mt-n1">
                        Join As a Instructor
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>

</html>