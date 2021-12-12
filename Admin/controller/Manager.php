<?php
require_once('model/model.php');
class Manager
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
    function inputValidation($data, $action)
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
        $accountExist = $model->checkExistingEmail($data["email"]);

        //email validation
        if (empty($data["email"])) {
            $this->errors["email"] =  "Email can not be empty";
        } elseif (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] =  "Invalid email format";
        } elseif ($accountExist == true and $action == "insert") {
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

        $nidExist = $model->checkExistingNID($data["nid"]);

        if (empty($data["nid"])) {
            $this->errors["nid"] = "Nid cannot be empty";
        } elseif ($nidExist == true and $action == "insert") {
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

    function addManager($data)
    {
        if ($this->inputValidation($data, "insert") == true) {

            //Getting Unique ID and Password
            require_once('Generator.php');
            $id = getManagerID();
            $pass = getUniquePassword();
            $data["id"] = $id;
            $data["password"] = $pass;

            $model = new model();
            $AddStatus = $model->insertManager($data);
            if ($AddStatus === true){
                header("location: add-manager.php?status=submitted&id=".$data["id"]."&password=".$data["password"]);
            }
            else
            {
                header("location: add-manager.php?status=submission_error");
            }
        }
        else
        {
            header("location: add-manager.php?status=submission_error");
        }
        return "";
    }

    function fetchManager($id)
    {
        $model = new model();
        $manager = $model->showManager($id);

        if (!empty($manager)) {
            $managerInfo = array();
            foreach ($manager as $rows) {
                $managerInfo = array(
                    'id' => $rows["id"],
                    'name' => $rows["name"],
                    'email' => $rows["email"],
                    'phone' => $rows["phone"],
                    'nationality' => $rows["nationality"],
                    'nid' => $rows["nid"],
                    'dob' => $rows["dob"],
                    'gender' => $rows["gender"],
                    'address' => $rows["address"],
                    'image' => $rows["image"],
                    'salary' => $rows["salary"],
                    'created_at' => $rows["created_at"]
                );
                break;
            }
        }

        return $managerInfo;
    }

    function updateStatus($status, $id)
    {
        $model = new model();
        $Status = $model->changeStatus($status, $id);
        if ($Status == true) {
            return true;
        }
        return false;
    }
}
