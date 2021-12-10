<?php
//no change needed
$username=$_REQUEST['username'];

require_once "../Model/generalModel.php";
$obj=new Model();

if($obj->get_user($username)==""){
    echo "false";
}
else{
    echo "true";
}
?>