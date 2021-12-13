<?php
require_once "General/Model/generalModel.php";
class user_info{
    //general
    public $error=array(
        'usernameErr'=>"",
        'passwordErr'=>"",
    );

    function getUser($id){ 
        $user=new model();
        return $user->get_user($id);
    }

    function get_error(){
        return $this -> error;
    }


    //learner

    function found_learner($data)
    {
        if (empty($data["username"])) {
            $this-> error["usernameErr"] = "ID is required";
        }else{
            
            $check_username=new model();

            if($check_username->verify_learner_id_password($data["username"],$data["password"])==""){
                $this-> error["usernameErr"] = "ID not matched";
            }
            else{
                if (empty($data["password"])) {
                    $this-> error["passwordErr"] = "Password is required";
                } 
                else{
                    if (preg_match('/[#$%@]/', $data["password"]) !== 1) {
                        $this-> error["passwordErr"] = "Password have to contain at least one '#' or '$' or '%' or '@'";
                    }
                    else{
                        if($check_username->verify_learner_id_password($data["username"],$data["password"])==""){
                            $this-> error["passwordErr"]= "Password not matched";
                        }
                        else{
                            return $check_username->verify_learner_id_password($data["username"],$data["password"]);
                        }
                    }
                }
            }
        } 
  
    }
     
    //Admin

    function authenticateUser($data)
    {
        $model = new model();
        $user = $model->getAdminInfo($data);

        if (!empty($user)) {
            $userInfo = array();
            foreach ($user as $rows) {
                $userInfo = array(
                    'id' => $rows["id"],
                    'password' => $rows["password"],
                    'usertype' => $rows["usertype"],
                    'name' => $rows["name"],
                    'email' => $rows["email"],
                    'phone' => $rows["phone"],
                    'nationality' => $rows["nationality"],
                    'nid' => $rows["nid"],
                    'dob' => $rows["dob"],
                    'gender' => $rows["gender"],
                    'address' => $rows["address"],
                    'image' => $rows["image"]
                );
                break;
            }

            if ($userInfo['usertype'] == "Admin") {
                $_SESSION['id'] = $userInfo["id"];
                $_SESSION['password'] = $userInfo["password"];
                $_SESSION['usertype'] = $userInfo["usertype"];
                $_SESSION['name'] = $userInfo["name"];
                $_SESSION['email'] = $userInfo["email"];
                $_SESSION['phone'] = $userInfo["phone"];
                $_SESSION['nationality'] = $userInfo["nationality"];
                $_SESSION['nid'] = $userInfo["nid"];
                $_SESSION['dob'] = $userInfo["dob"];
                $_SESSION['gender'] = $userInfo["gender"];
                $_SESSION['address'] = $userInfo["address"];
                $_SESSION['image'] = $userInfo["image"];
                return true;
            }
           
        }
        return false;
    }

        //Manager

        function authenticateManagerUser($data)
        {
            $model = new model();
            $user = $model->getManagerInfo($data);
            
    
            if (!empty($user)) {
                $userInfo = array();
                foreach ($user as $rows) {
                    $userInfo = array(
                        'id' => $rows["id"],
                        'usertype' => $rows["usertype"],
                        'name' => $rows["name"],
                        'email' => $rows["email"],
                        'phone' => $rows["phone"],
                        'nationality' => $rows["nationality"],
                        'nid' => $rows["nid"],
                        'dob' => $rows["dob"],
                        'gender' => $rows["gender"],
                        'address' => $rows["address"],
                        'image' => $rows["image"],
                        'status' => $rows["status"]
                    );
                    break;
                }

                echo $rows["status"];
    
                if ($userInfo['usertype'] == "Manager") {
                    $_SESSION['id'] = $userInfo["id"];
                    $_SESSION['password'] = $userInfo["password"];
                    $_SESSION['usertype'] = $userInfo["usertype"];
                    $_SESSION['name'] = $userInfo["name"];
                    $_SESSION['email'] = $userInfo["email"];
                    $_SESSION['phone'] = $userInfo["phone"];
                    $_SESSION['nationality'] = $userInfo["nationality"];
                    $_SESSION['nid'] = $userInfo["nid"];
                    $_SESSION['dob'] = $userInfo["dob"];
                    $_SESSION['gender'] = $userInfo["gender"];
                    $_SESSION['address'] = $userInfo["address"];
                    $_SESSION['image'] = $userInfo["image"];
                    $_SESSION['status'] = $userInfo["status"];
                    return true;
                }
               
            }
            return false;
        }

    //add your function
}
?>