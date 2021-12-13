<?php
class course{

    function getAllcouse(){
        require_once "model/course_model.php";
        $obj=new courseModel();
        return $obj->getAllCourse();
    }

    function get_LearnerCourseInfo($id){
        require_once "model/course_model.php";
        $obj=new courseModel();
        return $obj->getLearnerCourseInfo($id);
    }

    function get_LearnerACourseInfo($data){
        require_once "model/course_model.php";
        $obj=new courseModel();
        return $obj->getLearnerACourseInfo($data);
    }

    function get_LearnerACourseProgress($data){
        require_once "model/course_model.php";
        $obj=new courseModel();
        return $obj->getLearnerACourseProgress($data);
    }

    function get_LearnerCurrentCourseMatarial($data){
        require_once "model/course_model.php";
        $obj=new courseModel();
        return $obj->getLearnerCurrentCourseMatarial($data);
    }

    function get_CurrentCourseMatarialQuiz($data){
        require_once "model/course_model.php";
        $obj=new courseModel();
        return $obj->getCurrentCourseMatarialQuiz($data);
    }
}
?>