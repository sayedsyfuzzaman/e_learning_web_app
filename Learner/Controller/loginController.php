<?php
 
 class addstudent{
    public $error=array(
        'usernameErr'=>"",
        'passwordErr'=>"",
    );
  
    function found_learner($data)
    {

        if (empty($data["username"])) {
            $this-> error["usernameErr"] = "ID is required";
        } else {
            if (strlen($data["username"]) != 11) {
                $this-> error["usernameErr"] = "ID must have 11 character";
            } else {
                if (preg_match('/^[0-9-]+$/', $data["username"]) !== 1) {
                    $this-> error["usernameErr"] = "ID can contain letter, hyphens(-)";
                }
                else{
                    require_once "Learner/model/model.php";
                    $check_username=new model();

                    if($check_username->get_a_learner($data["username"])==""){
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
                                      if($check_username->verify_id_password($data["username"],$data["password"])==""){
                                        $this-> error["passwordErr"]= "Password not matched";
                                      }
                                      else{
                                          return $check_username->verify_id_password($data["username"],$data["password"]);
                                      }
                                  }
                              }
                          }
                    }
                } 
            }
        }
  
    }

    function get_error(){
        return $this -> error;
    }
 }
    ?>