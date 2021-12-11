<?php

class update{

    public $error=array(
        'nameErr'=>"",
        'emailErr' =>"",
        'dobErr' =>"",
        'genderErr' =>"",
        'highest_degreeErr'=>""
    );
    public $message="";

    function update_learner($data)
    {
      if (empty($data["name"])) {
          $this-> error["nameErr"] = "Name is required";
      } else {
          if ((str_word_count($data["name"])) < 2) {
            $this-> error["nameErr"] = "The name must have at least two word";
          } else {
              if ((preg_match("/[A-Za-z]/", $data["name"][0])) == 0) {
                $this-> error["nameErr"] = "The name must have start with litter";
              } else {
                  if (preg_match('/^[A-Za-z\s._-]+$/', $data["name"]) !== 1) {
                    $this-> error["nameErr"] = "Name can contain letter,desh,dot and space";
                  }
              }
          }
      }
  

      if (empty($data["email"])) {
        $this-> error["emailErr"] = "Email is required";
      } else {
          if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this-> error["emailErr"] = "Invalid email format";
          }
          else{
            require_once "model/model.php";
            $check_mail=new model();
            if(!$check_mail->update_verify_unique_email($data["email"],$data["username"])){
               $this-> error["emailErr"] = "Email already exists";
            }
          }
      }


      if(empty($data["highest_degree"])) {
        $this-> error["highest_degreeErr"] = "Degree is required.";
      }else if($data["highest_degree"]!="ssc" && $data["highest_degree"]!="hsc" && $data["highest_degree"]!="graduate" && $data["highest_degree"]!="postgraduate"){
        $this-> error["highest_degreeErr"] = "Degree is not valid.";
      }

      if (empty($data["gender"])){
        $this-> error["genderErr"] = "Gender is required";
      }else if($data["gender"]!="male" && $data["gender"]!="female" && $data["gender"]!="orther"){
        $this-> error["genderErr"] = "Gender is not valid.";
      }

      if (empty($data["dob"])) {
        $this-> error["dobErr"] = "Date of Birth required";
      } else {
          if ($data["dob"] > date('Y-m-d')) {
            $this-> error["dobErr"] = "Invalide input";
          }
      }
  
      if (empty($data["gender"])){
        $this-> error["genderErr"] = "Gender is required";
      }


  
      if (empty($this-> error["nameErr"]) && empty($this-> error["emailErr"]) && empty($this-> error["dobErr"]) && empty($this-> error["highest_degreeErr"]) && empty($this-> error["genderErr"])) {
        require_once "model/model.php";
        $obj=new model();
        $this->message=$obj->update_learner($data);
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