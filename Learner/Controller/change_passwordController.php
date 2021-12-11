<?php

class passwordCon{
    public $error=array(
        'passwordErr'=>"",
        'new_passwordErr'=>"",
        'confirm_passwordErr'=>"",
    );
    public $message="";
    
    function password_change($data){
        if (empty($data["password"])) {
            $this->error["passwordErr"] = "Password is required";
        } else {
            if (strlen($data["password"]) < 8) {
                $this->error["passwordErr"] = "Password must contain at least 8 character";
            } 
            else {

                if (preg_match('/[#$%@]/', ($data["password"]) !== 1)) {
                    $this->error["passwordErr"] = "Password have to contain at least one '#' or '$' or '%' or '@'";
                } else {

                    require_once "model/model.php";
                    $obj=new model();
                    $learner=$obj->get_a_learner($data["username"]);

                    if($learner["password"]!=$data["password"]) {

                                $this->error["passwordErr"] = "Invalid password";
                            } elseif ($learner["password"]==$data["password"]) {
                                if (empty($data["new_password"])) {
                                    $this->error["new_passwordErr"]= "Password is required";
                                } else {
                                    if (strlen($data["new_password"]) < 8) {
                                        $this->error["new_passwordErr"] = "Password must contain at least 8 character";
                                    } else {

                                        if (preg_match('/[#$%@]/', $data["new_password"]) !== 1) {
                                            $this->error["new_passwordErr"] = "Password have to contain at least one '#' or '$' or '%' or '@'";
                                        } else {
                                            if (empty($data["confirm_password"])) {
                                                $this->error["confirm_passwordErr"] = "Confirm Password is required";
                                            } else {
                                                if (strcmp($data["new_password"], $data["confirm_password"]) !== 0) {
                                                    $this->error["confirm_passwordErr"]= "Password are not matched";
                                                } else {
                                                    

                                                    $learnerArr=array(
                                                        'username'=>$data["username"],
                                                        'new_password'=>$data["new_password"]
                                                    );

                                                    $obj->change_password($learnerArr);
                                                    $this->message="Password Changed!";

                                                }
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

    function get_messege(){
        return $this -> message;
    }
}
?>