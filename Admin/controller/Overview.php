<?php
require_once 'model/model.php';
function dailyCourseEnrolles() {
    $model = new model();
    $date = date("d/m/Y");
    echo $model->getDailyEnrolles($date);
}

function dailyUserResisters() {
    $model = new model();
    echo $model->getTotalUsers();
}

function totalEarnings() {
    $model = new model();
    $earnings =  $model->getTotalEarnings();
    $totalEarnings = "";
    if (!empty($earnings)) {
        foreach ($earnings as $rows) {
            $totalEarnings = $rows["earnings"];
            break;
        }
    }
    echo $totalEarnings;
}
?>