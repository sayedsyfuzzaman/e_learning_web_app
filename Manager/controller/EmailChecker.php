<?php
if (isset($_REQUEST['email'])) {
    $email = $_REQUEST['email'];

    require_once "../model/model.php";
    $obj = new Model();

    $email_exist = $obj->checkExistingEmail($email);

    if ($email_exist == true) {
        echo "exist";
    } else {
        echo "not_exist";
    }
}

if (isset($_REQUEST['myemail'])){
    session_start();
    $email = $_REQUEST['myemail'];
    $id = $_SESSION["id"];
    
    require_once "../model/model.php";
    $obj = new Model();

    $email_exist = $obj->checkExistingPersonalEmail($email, $id);

    if ($email_exist == true) {
        echo "exist";
    } else {
        echo "not_exist";
    }
}
 