<?php
class student_info{
    function get_learner($id){
        require_once "Model/model.php";
        $learner=new model();

        return $learner->get_a_learner($id);
    }
}
?>