<?php

class update{

    public $error=array(
        'nameErr'=>"",
        'emailErr' =>"",
        'dobErr' =>"",
        'genderErr' =>"",
        'pictureErr' =>"",
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


      $target_dir = "picture/";
      if(empty($data["file"])){
          $this->error["pictureErr"]="";
      }else{
        $target_file =  $target_dir .$data["file"];
        $uploaded = 0;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";
        if ($data["file"] != "") {
            $check = getimagesize($data["temp_name"]);
            if ($check !== false) {
  
                $uploaded = 1;
            } else {
                $this->error["pictureErr"] = "File is not an image.";
                $uploaded = 0;
            }
            if ($data["size"] > 40000000000) {
                $this->error["pictureErr"] = "Sorry, your file is too large.";
                $uploaded = 0;
            }
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $this->error["pictureErr"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploaded = 0;
            }
            if ($uploaded == 0) {
                $this->error["pictureErr"] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($data["temp_name"], $target_file)) {
                    $filepath = $target_dir . htmlspecialchars(basename($data["file"]));
  
                    if ($data["old_file"] != "broken.png" && $data["old_file"]!= $filepath) {
                        unlink($data["old_file"]);
                    }

                    $data['filepath']=$filepath;
                } else {
                    $this->error["pictureErr"] = "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            $this->error["pictureErr"] = "No Image was selected";
        }
      }


  
      if (empty($this-> error["nameErr"]) && empty($this-> error["emailErr"]) && empty($this-> error["dobErr"]) && empty($this-> error["highest_degreeErr"]) && empty($this-> error["genderErr"]) && empty($this-> error["pictureErr"])) {
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