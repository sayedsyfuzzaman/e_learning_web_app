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
                  } else {
                      if (strlen($data["password"]) < 9) {
                        $this-> error["passwordErr"] = "Password must contain at least 8 character";
                      } else {
              
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
  
    }

    //add your function
}
?>