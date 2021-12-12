<?php
require_once('model/model.php');
class Instructor
{
    function fetchInstructor($id)
    {
        $model = new model();
        $instructor = $model->showInstructor($id);

        if (!empty($instructor)) {
            $instructorInfo = array();
            foreach ($instructor as $row) {
                $instructorInfo = array(
                    "id" => $row["id"],
                    "name" => $row["name"],
                    "email" => $row["email"],
                    "dob" => $row["dob"],
                    "gender" => $row["gender"],
                    "image" => $row["image"],
                    "job_title" => $row["job_title"],
                    "field" => $row["field"],
                    "balance" => $row["balance"]
                );
                break;
            }
        }

        return $instructorInfo;
    }
}
