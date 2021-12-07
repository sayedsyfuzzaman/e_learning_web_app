<?php
include "../model/db_connect.php";
session_start();
if (isset($_POST['crop_image'])) {
    $data = $_POST['crop_image'];
    $image_array_1 = explode(";", $data);
    $image_array_2 = explode(",", $image_array_1[1]);
    $base64_decode = base64_decode($image_array_2[1]);
    $path_img = '../upload/' . $_SESSION["id"] . '.png';
    $imagename = '' .  $_SESSION["id"]  . '.png';

    file_put_contents($path_img, $base64_decode);

    $conn = db_conn();
    $selectQuery = "UPDATE `admin_info` SET `image`= ? WHERE `id` = ?";
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            "upload/".$imagename,
            $_SESSION["id"]
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $_SESSION["image"] = "upload/".$imagename;
    $conn = null;
}
?>