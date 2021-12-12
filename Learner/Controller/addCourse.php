<?php
$data= array(
    "id" =>$_GET['id'],
    "course_id" =>$_GET['course_id'],
    "course_name" =>$_GET['course_name'],
    "course_price" =>$_GET['course_price']
);
require_once "../model/course_model.php";
$obj=new courseModel();

if($obj->isTakeCourse($data)){
    $obj->enrolledCourse($data);
    echo "valid";
}
else{
    echo "invalid";
}
?>