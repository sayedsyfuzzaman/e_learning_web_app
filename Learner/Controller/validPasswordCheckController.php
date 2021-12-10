<?php
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

require_once "../model/model.php";
$obj=new Model();

if($obj->verify_id_password($username,$password)==""){
    echo "false";
}
else{
    echo "true";
}
?>