<?PHP
session_start();
$quiz = array();
$Course = array();
$material_id = "";
if (isset($_GET["course_id"])) {
    $_SESSION["course_id"] = $_GET["course_id"];
}
if (!isset($_SESSION['username'])) {
    header("location:login.php");
}
if (!isset($_SESSION['course_id'])) {
    header("location:dashboard.php");
} elseif (!isset($_COOKIE["material_id"])) {
    header("location:courseDashboard.php");
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
    $data1 = array(
        "material_id" => $_COOKIE["material_id"],
        "course_id" => $_SESSION["course_id"]
    );
    $quiz = $obj->get_CurrentCourseMatarialQuiz($data1);
    $material_id = $_COOKIE["material_id"];
    $matarial_serial = $_COOKIE["serial"] + 1;
    setcookie("material_id", "", time() - 3600);
    setcookie("serial", "", time() - 3600);
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <link href="../css/modern.css" rel="stylesheet">
    <script src="../js/settings.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css" />
    <script src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <input type="text" id="quiz_url" value="<?php echo "../" . $quiz['file'] ?>" style="display: none">
    <div class="start_btn" id="start_btn"><button>Start Quiz</button></div>
    <div class="info_box" id="info_box">
        <div class="info-title"><span>Some Rules of this Quiz</span></div>
        <div class="info-list">
            <div class="info">1. You will have only <span>15 seconds</span> per each question.</div>
            <div class="info">2. Once you select your answer, it can't be undone.</div>
            <div class="info">3. You can't select any option once time goes off.</div>
            <div class="info">4. You can't exit from the Quiz while you're playing.</div>
            <div class="info">5. You'll get points on the basis of your correct answers.</div>
        </div>
        <div class="buttons">
            <button class="quit" id="quit">Exit Quiz</button>
            <button class="restart" id="continue">Continue</button>
        </div>
    </div>

    <div class="quiz_box" id="quiz_box">
        <header>
            <div class="title"><?php echo $quiz['title'] ?></div>
            <div class="timer">
                <div class="time_left_txt">Time Left</div>
                <div class="timer_sec">15</div>
            </div>
            <div class="time_line"></div>
        </header>
        <section>
            <div class="que_text">
            </div>
            <div class="option_list">
            </div>
        </section>

        <footer>
            <div class="total_que">
            </div>
            <button class="next_btn" id="next_btn">Next Que</button>
        </footer>
    </div>

    <div class="result_box" id="result_box">
        <div class="complete_text">You've completed the Quiz!</div>
        <div class="score_text">
        </div>
        <input type="text" name="insartPossible" id="insartPossible" value="" style="display: none">
        <div class="buttons">
            <button class="quit" id="main_manu" onclick="update_Progess('<?php echo $_SESSION['username'] ?>',<?php echo $matarial_serial ?>,'<?php echo $_SESSION['course_id'] ?>')">Main Manu</button>
        </div>
    </div>

</body>
<script>
    function update_Progess(id, serial, course_id) {
        let insertAble = document.getElementById("insartPossible").innerHTML;

        if (insertAble == "yes") {
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                console.log(this.responseText);
                location.reload();
            }
            xhttp.open("GET", "Controller/updateProgressController.php?id=" + id + "&serial=" + serial + "&course_id=" + course_id);
            xhttp.send();
        }
        else{
            location.reload();
        }
    }
</script>


</html>