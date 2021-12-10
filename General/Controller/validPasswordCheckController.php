<?php
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];

require_once "../Model/generalModel.php";
$obj=new Model();

$user=$obj->get_user($username);

if($user["usertype"]=="learner"){
    if($obj->verify_learner_id_password($username,$password)==""){
        echo "false";
    }
    else{
        echo "true";
    }
}
//add your function name
/* else if($user["usertype"]=="admin"){

}*/
else{
    echo "true";
}
?>