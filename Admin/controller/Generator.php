<?php
require_once 'model/model.php';
function getManagerID() {
    $model = new model();
    $count = $model->getTotalManagerNumber();
    $count = (int)$count + (int)date("isa");

    $unique_id = date("Y")."-".$count."-". date("m");
    return $unique_id;
}

function getUniquePassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>