<?php
require_once('model/model.php');
class Learner
{
    function fetchLearner($id)
    {
        $model = new model();
        $learner = $model->showLearner($id);

        if (!empty($learner)) {
            $learnerInfo = array();
            foreach ($learner as $rows) {
                $learnerInfo = array(
                    'id' => $rows["id"],
                    'name' => $rows["name"],
                    'highest_degree' => $rows["highest_degree"],
                    'email' => $rows["email"],
                    'dob' => $rows["dob"],
                    'gender' => $rows["gender"],
                    'image' => $rows["image"],
                    'created_at' => $rows["created_at"]
                );
                break;
            }
        }

        return $learnerInfo;
    }
}