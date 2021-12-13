<?php
$data=array(
    "id"=>$_GET["id"],
    "course_id"=>$_GET["course_id"],
    "serial"=>$_GET["serial"]
);

require_once "../model/course_model.php";
$obj=new courseModel();
$obj->updateProgess($data);
echo "compete";
?>