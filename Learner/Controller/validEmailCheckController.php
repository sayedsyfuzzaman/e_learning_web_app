<?php
$email=$_REQUEST['email'];

require_once "../model/model.php";
$obj=new Model();

$is_unique=$obj->verify_unique_email($email);

if($is_unique==false){
    echo "found";
}
else{
    echo "not_found";
}
?>