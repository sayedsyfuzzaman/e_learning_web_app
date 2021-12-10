<?php
require_once('model/model.php');
class Admin
{
    public $errors = array(
        'name' => "",
        'email' => "",
        'phone' => "",
        'nationality' => "",
        'nid' => "",
        'dob' => "",
        'gender' => "",
        'address' => "",
    );
    function inputValidation($data)
    {
        //name validation
        if (empty($data["name"])) {
            $this->errors["name"] =  "Can not be empty";
        } elseif (str_word_count($data["name"]) < 2) {
            $this->errors["name"] = "Cannot contain less than two word";
        } elseif (preg_match("/[A-Za-z]/", $data["name"][0]) == 0) {
            $this->errors["name"] = "Must start with a letter";
        } elseif (preg_match('/^[A-Za-z\s._-]+$/', $data["name"]) !== 1) {
            $this->errors["name"] = "Can contain a-z, A-Z, period and dash only";
        } else {
            $this->errors["name"] = "";
        }



        $model = new model();
        $accountExist = $model->checkExistingPersonalEmail($data["email"], $data["id"]);

        //email validation
        if (empty($data["email"])) {
            $this->errors["email"] =  "Email can not be empty";
        } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] =  "Invalid email format";
        } elseif ($accountExist == true) {
            $this->errors["email"] =  "Email already exist, try another.";
        } else {
            $this->errors["email"] = "";
        }

        //Phone number validation
        if (!empty($data["phone"])) {
            if (!filter_var($data["phone"], FILTER_SANITIZE_NUMBER_INT)) {
                $this->errors["phone"] = "Invalid phone number";
            } elseif (strlen($data["phone"]) != 11) {
                $this->errors["phone"] = "Phone number cannot be greater or less than 11";
            } else {
                $this->errors["phone"] = "";
            }
        }




        //nationality validation
        if (empty($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot be empty";
        } elseif (is_numeric($data["nationality"])) {
            $this->errors["nationality"] = "Nationality cannot contain numbers";
        } else {
            $this->errors["nationality"] = "";
        }

        //nid validation

        $nidExist = $model->checkExistingPersonalNID($data["nid"], $data["id"]);

        if (empty($data["nid"])) {
            $this->errors["nid"] = "Nid cannot be empty";
        } elseif ($nidExist == true) {
            $this->errors["nid"] =  "Sorry! This NID already exist.";
        } elseif (!filter_var($data["nid"], FILTER_SANITIZE_NUMBER_INT)) {
            $this->errors["nid"] = "Invalid nid number";
        } else {
            $this->errors["nid"] = "";
        }

        if (
            empty($this->errors["name"]) &&
            empty($this->errors["email"]) &&
            empty($this->errors["phone"]) &&
            empty($this->errors["nationality"]) &&
            empty($this->errors["nid"])
        ) {
            return true;
        }
        return false;
    }

    function updateProfile($data)
    {
        if ($this->inputValidation($data) == true) {

            $model = new model();
            $updateStatus = $model->updatePersonalInfo($data);
            if ($updateStatus === true) {
                $_SESSION["name"] = $data["name"];
                $_SESSION["email"] = $data["email"];
                $_SESSION["phone"] = $data["phone"];
                $_SESSION["nationality"] = $data["nationality"];
                $_SESSION["nid"] = $data["nid"];
                $_SESSION["dob"] = $data["dob"];
                $_SESSION["gender"] = $data["gender"];
                $_SESSION["address"] = $data["address"];
                header("location: profile-setting.php?status=info_updated");
            } else {
                header("location: profile-setting.php?status=submission_error");
            }
        } else {
            header("location: profile-setting.php?status=submission_error");
        }
        return "";
    }

    function changePassword($password)
    {
        $model = new model();
        $updateStatus = $model->updatePassword($password);
        if ($updateStatus == true) {
            $_SESSION["password"] = $password["new"];
            setcookie("username", $_SESSION['id'], time() + (60 * 60 * 24 * 30 * 12));
            setcookie("password", $password["new"], time() + (60 * 60 * 24 * 30 * 12));
            header("location: profile-setting.php?status=password_updated");
        } else {
            header("location: profile-setting.php?status=submission_error");
        }
        return "";
    }
}
