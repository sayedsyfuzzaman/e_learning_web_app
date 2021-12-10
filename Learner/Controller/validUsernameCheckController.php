<?php
$username=$_REQUEST['username'];

require_once "../model/model.php";
$obj=new Model();

if($obj->get_a_learner($username)==""){
    echo "false";
}
else{
    echo "true";
}
?>