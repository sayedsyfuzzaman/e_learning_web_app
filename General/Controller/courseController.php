<?php
class Course{

    function getAllcouse(){
        require_once "General/Model/generalModel.php";
        $obj=new model();
        return $obj->getAllCourse();
    }

}
?>