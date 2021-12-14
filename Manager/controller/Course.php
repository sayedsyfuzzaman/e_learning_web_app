<?php
require_once('model/model.php');
class Course
{
    public $errors = array(
        'course_id' => "",
        'course_name' => "",
        'price' => "",
        'discount' => "",
        'availability' => "",
        'created_by' => ""
    );
    function inputValidation($data)
    {
        //cname validation
        if (empty($data["course_name"])) {
            $this->errors["course_name"] =  "Can not be empty";
        } elseif (preg_match("/[A-Za-z]/", $data["course_name"][0]) == 0) {
            $this->errors["course_name"] = "Must start with a letter";
        } else {
            $this->errors["course_name"] = "";
        }

        //Price number validation
        if (!empty($data["price"])) {
            if (!filter_var($data["price"], FILTER_SANITIZE_NUMBER_INT)) {
                $this->errors["price"] = "Invalid phone number";
            } else {
                $this->errors["price"] = "";
            }
        }

        //Discount number validation
        if (!empty($data["discount"])) {
            if (!filter_var($data["discount"], FILTER_SANITIZE_NUMBER_INT)) {
                $this->errors["discount"] = "Invalid phone number";
            } else {
                $this->errors["discount"] = "";
            }
        }

        if (
            empty($this->errors["course_name"]) &&
            empty($this->errors["price"]) &&
            empty($this->errors["discount"])
        ) {
            return true;
        }
        return false;
    }

    function addCourse($data)
    {
        if ($this->inputValidation($data) == true) {
            $data["course_id"] = (int)date("isa");
            $model = new model();
            $updateStatus = $model->insertCourse($data);
            if ($updateStatus === true) {
                header("location: add-course.php?status=created&id=" . $data["course_id"]);
            } else {
                header("location: add-course.php?status=submission_error");
            }
        } else {
            header("location: add-course.php?status=submission_error");
        }
        return "";
    }

    function updateCourse($data)
    {
        if ($this->inputValidation($data) == true) {
            $model = new model();
            $updateStatus = $model->updateCourse($data);
            if ($updateStatus === true) {
                header("location: course-details.php?status=updated&id=" . $data["course_id"]);
            } else {
                //header("location: add-course.php?status=submission_error");
            }
        } else {
            //header("location: add-course.php?status=submission_error");
        }
        return "";
    }

    function fetchCourse($id)
    {
        $model = new model();
        $course = $model->showCourse($id);

        if (!empty($course)) {
            $courseInfo = array();
            foreach ($course as $rows) {
                $courseInfo = array(
                    'course_id' => $rows["course_id"],
                    'course_name' => $rows["course_name"],
                    'price' => $rows["price"],
                    'discount' => $rows["discount"],
                    'avilability' => $rows["avilability"],
                    'thumbnail' => $rows["thumbnail"],
                    'created_by' => $rows["created_by"]
                );
                break;
            }
        }

        return $courseInfo;
    }
}
