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
}
?>