<?php
class course{

    function get_couse(){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 6/model/course_model.php";
        $obj=new courseModel();
        return $obj->getAllCourse();
    }
}
?>