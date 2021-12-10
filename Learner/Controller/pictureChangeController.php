<?php

class picture{

    public $error=array(
        'pictureErr' =>""
    );
    public $message="";
    
    function change_picture($data){
        $target_dir = "picture/";
        if(empty($data["file"])){
            $this->error["pictureErr"]="picture is required";
            return "";
        }
        $target_file =  $target_dir .$data["file"];
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filepath = "";
        if ($data["file"] != "") {
            $check = getimagesize($data["temp_name"]);
            if ($check !== false) {

                $uploaded = 1;
            } else {
                $this->error["pictureErr"] = "File is not an image.";
                $uploaded = 0;
                return "";
            }

            if ($data["size"] > 40000000000) {
                $this->error["pictureErr"] = "Sorry, your file is too large.";
                $uploaded = 0;
                return "";
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $this->error["pictureErr"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploaded = 0;
                return "";
            }

            if ($uploaded == 0) {
                $this->error["pictureErr"] = "Sorry, your file was not uploaded.";
                return "";
            } else {
                if (move_uploaded_file($data["temp_name"], $target_file)) {

                    $mypic = $target_file;
                    $UploadConfirmation = "Picture has been uploaded Successfully";
                    $filepath = $target_dir . htmlspecialchars(basename($data["file"]));

                    if ($data["old_file"] != "broken.png" && $data["old_file"]!= $filepath) {
                        unlink($data["old_file"]);
                    }

                    $learner=array(
                        'username' =>$_SESSION['username'],
                        'filepath' => $filepath
                    );

                    require_once "C:/xampp/htdocs/Fall21_22/Lab task 6/model/model.php";
                    $obj=new model();
                    $obj->change_picture($learner);

                    $this->message=$UploadConfirmation;
                    return $filepath;
                } else {
                    $this->error["pictureErr"] = "Sorry, there was an error uploading your file.";
                    return "";
                }
            }
        } else {
            $this->error["pictureErr"] = "No Image was selected";
            return "";
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