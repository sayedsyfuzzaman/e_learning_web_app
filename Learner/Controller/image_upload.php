<?php
session_start();
if (isset($_POST['crop_image'])) {
    $data = $_POST['crop_image'];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $base64_decode = base64_decode($image_array_2[1]);
    $path_img = '../picture/' . $_SESSION["username"] . '.png';
    $imagename = '' .  $_SESSION["username"]  . '.png';

    file_put_contents($path_img, $base64_decode);
    require_once "../Learner/model/model.php";
    $obj=new model();
    $data=array(
        "id"=>$_SESSION["username"],
        "picture" =>"picture/".$imagename
    );

    $obj->change_picture($data);
}
?>