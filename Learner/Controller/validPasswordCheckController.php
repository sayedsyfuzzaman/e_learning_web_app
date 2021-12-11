<?php
$username=$_REQUEST['id'];
$password=$_REQUEST['password'];

require_once "../model/model.php";
$obj=new Model();

if($obj->verify_id_password($username,$password)==""){
    echo "not_valid";
}
else{
    echo "valid";
}
?>