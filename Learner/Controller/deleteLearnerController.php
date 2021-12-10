<?php 
class delete{

    function delete_account($id){
        require_once "C:/xampp/htdocs/Fall21_22/Lab task 6/model/model.php";
        $obj=new model();

        $obj->delete_learner($id);
    }
}
 ?>