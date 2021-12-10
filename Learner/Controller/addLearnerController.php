<?php
 
 class addstudent{
    public $error=array(
        'nameErr'=>"",
        'emailErr' =>"",
        'passwordErr'=>"",
        'confirm_passwordErr'=>"",
        'highest_degreeErr' => "",
        'dobErr' =>"",
        'genderErr' =>"",
    );
    public $message="";
    public $username="";
  
    function addData($data)
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

            if($check_mail->verify_unique_email($data["email"])==false){
                $this-> error["emailErr"] = "Email already exists";
            }
          }
      }
  
      if (empty($data["password"])) {
        $this-> error["passwordErr"] = "Password is required";
      } else {
          if (strlen($data["password"]) < 9) {
            $this-> error["passwordErr"] = "Password must contain at least 8 character";
          } else {
  
              if (preg_match('/[#$%@]/', $data["password"]) !== 1) {
                $this-> error["passwordErr"] = "Password have to contain at least one '#' or '$' or '%' or '@'";
              }
          }
      }

      if(empty($data["highest_degree"])) {
        $this-> error["highest_degreeErr"] = "Degree is required.";
      }else if($data["highest_degree"]!="ssc" && $data["highest_degree"]!="hsc" && $data["highest_degree"]!="graduate" && $data["highest_degree"]!="postgraduate"){
        $this-> error["highest_degreeErr"] = "Degree is not valid.";
      }
  
      if (empty($data["confirm_password"])) {
        $this-> error["confirm_passwordErr"] = "Confirm Password is required";
      } else {
          if (strcmp($data["password"], $data["confirm_password"]) !== 0) {
            $this-> error["confirm_passwordErr"] = "Password are not matched";
          }
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
      }else if($data["gender"]!="male" && $data["gender"]!="female" && $data["gender"]!="orther"){
        $this-> error["genderErr"] = "Gender is not valid.";
      }
  
      if (empty($this-> error["nameErr"]) && empty($this-> error["emailErr"]) && empty($this-> error["passwordErr"]) && empty($this-> error["confirm_passwordErr"]) && empty($this-> error["dobErr"]) && empty($this-> error["genderErr"]) && empty($this-> error["highest_degreeErr"])) {
        require_once "model/model.php";
        $create_account=new model();

        $this->message=$create_account->create_learner($data);
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
