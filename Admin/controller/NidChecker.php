<?php
if (isset($_REQUEST['nid'])) {
    $nid = $_REQUEST['nid'];

    require_once "../model/model.php";
    $obj = new Model();

    $nid_exist = $obj->checkExistingNID($nid);

    if ($nid_exist == true) {
        echo "exist";
    } else {
        echo "not_exist";
    }
}

if (isset($_REQUEST['mynid'])) {
    session_start();
    $nid = $_REQUEST['mynid'];
    $id = $_SESSION["id"];

    require_once "../model/model.php";
    $obj = new Model();

    $nid_exist = $obj->checkExistingPersonalNID($nid, $id);

    if ($nid_exist == true) {
        echo "exist";
    } else {
        echo "not_exist";
    }
}
