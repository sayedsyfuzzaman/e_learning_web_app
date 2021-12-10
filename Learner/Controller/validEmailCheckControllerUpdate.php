<?php
$id= $_REQUEST['id'];
$email=$_REQUEST['email'];

require_once "../model/model.php";
$obj=new Model();

$is_unique=$obj->update_verify_unique_email($email,$id);

if($is_unique==false){
    echo "found";
}
else{
    echo "not_found";
}
?>