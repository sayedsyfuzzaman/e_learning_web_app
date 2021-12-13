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
else if($user["usertype"]=="Admin"){
    $data = array(
        'id' => $username,
        'password' =>  $password
    );
    if(!empty($obj->getAdminInfo($data))){
        echo "true";
    }else{
        echo "false";
    }
}
else if($user["usertype"]=="Manager"){
    $data = array(
        'id' => $username,
        'password' =>  $password
    );
    if(!empty($obj->getManagerInfo($data))){
        echo "true";
    }else{
        echo "false";
    }
}

//add your function name
/* else if($user["usertype"]=="admin"){

}*/
else{
    echo "true";
}
?>