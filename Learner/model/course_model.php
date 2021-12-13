<?php
class courseModel{

    function db_conn()
    {
      $servername = "springsoftbd.com";
      $username = "elearning_webapp_admin";
      $password = "elearning_webapp_admin%8879";
      $dbname = "elearning_webapp";

      try {
          $conn = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
          } catch (PDOException $e) {
              echo $e->getMessage();
          }
      return $conn;
     }

    function getAllCourse(){

        $conn = $this->db_conn();
        $selectQuery = 'SELECT * FROM `course_info` where `avilability`="true"';
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo "course ".$e->getMessage();
        }
        $course = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $course;

    }
    function isTakeCourse($data){
        $conn = $this->db_conn();
        $selectQuery ="SELECT * FROM `enrolled_course` where learner_id = ? and course_id=? ";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$data["id"],$data["course_id"]]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(empty($row)){
            return true;
        }else{
            return false;
        }

    }

    function enrolledCourse($data){
        $conn = $this->db_conn();
        $selectQuery = "INSERT into enrolled_course (learner_id,course_id, enrolled_at,course_price)
        VALUES (:learner_id, :course_id, now(),:course_price)";
            try{
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute([
                    ':learner_id'               =>     $data["id"],
                    ':course_id'          =>      $data["course_id"],
                    ':course_price'     =>     $data["course_price"]
                ]);
            }catch(PDOException $e){
                echo "create_2 ".$e->getMessage();
            }
            

            $selectQuery_2 = "INSERT into history (title, comment_one, comment_two,added_by, date) 
            VALUES (:title, :comment_one, :comment_two,:added_by, now())";
                try{
                    $stmt = $conn->prepare($selectQuery_2);
                    $stmt->execute([
                        ':title'               =>    "Course Enrolled" ,
                        ':comment_one' => "Course ID: ".$data["course_id"],
                        ':comment_two' => "Course Name: ".$data["course_name"],
                        ':added_by' => $data["id"]
                    ]);
                }catch(PDOException $e){
                    echo "create_2 ".$e->getMessage();
                }

            $selectQuery = 'SELECT * FROM `course_material` where `course_id`=? and `serial`=1';
            try{
                $stmt = $conn->prepare($selectQuery);
                $stmt->execute([
                    $data["course_id"]
                ]);
            }catch(PDOException $e){
                echo "course ".$e->getMessage();
            }
                $matarials = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $matarial=array();
            foreach($matarials as $row){
                $matarial=$row;
                break;
            }

            $selectQuery_2 = "INSERT INTO `course_progression`(`learner_id`, `material_id`, `status`,`course_id`) VALUES (:learner_id, :material_id, :status,:course_id)";
                try{
                    $stmt = $conn->prepare($selectQuery_2);
                    $stmt->execute([
                        ':learner_id'  => $data["id"] ,
                        ':material_id' => $matarial["material_id"],
                        ':status' => "incomplete",
                        ":course_id" => $data["course_id"]
                    ]);
                }catch(PDOException $e){
                    echo "create_2 ".$e->getMessage();
                }


            $conn = null;

    }




    
    function getLearnerCourseInfo($id){

        $conn = $this->db_conn();
        $selectQuery = "select c.* from course_info c, enrolled_course ec where c.course_id = ec.course_id and ec.learner_id = ?";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $id
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        
        return $result;
    }

    function getLearnerACourseInfo($data){

        $conn = $this->db_conn();
        $selectQuery = "select c.* from course_info c, enrolled_course ec where c.course_id = ec.course_id and ec.learner_id = ? and ec.course_id=?";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["id"],
                $data["course_id"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;

        foreach ($result as $row){
            return $row;
        }
        
    }

    function getLearnerACourseProgress($data){

        $conn = $this->db_conn();
        $selectQuery = "SELECT COUNT(*) FROM `course_progression` WHERE `learner_id`=? and `course_id`=? and `status`='complete'";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["id"],
                $data["course_id"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $matarial_complete = $stmt->fetchColumn();

        $selectQuery = "SELECT COUNT(*) FROM `course_material` WHERE `course_id`=?";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["course_id"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $total_material = $stmt->fetchColumn();
        $conn = null;

        return (($matarial_complete/$total_material)*100);
    }

    function getLearnerCurrentCourseMatarial($data){
        $conn = $this->db_conn();
        $selectQuery = 'SELECT m.* from course_progression cp, course_material m where m.material_id = cp.material_id and cp.status="incomplete" and cp.learner_id = ? and cp.course_id=?';
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["id"],
                $data["course_id"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;

        foreach ($result as $row){
            return $row;
        }
    }
    function getCurrentCourseMatarialQuiz($data){
        $conn = $this->db_conn();
        $selectQuery = 'SELECT q.* from course_quiz q, course_material m where m.material_id = q.material_id and m.course_id=q.course_id and m.course_id  = ? and m.material_id=?';
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["course_id"],
                $data["material_id"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;

        foreach ($result as $row){
            return $row;
        }
    }

    function updateProgess($data){
        $conn = $this->db_conn();

        $selectQuery = 'SELECT * from course_material where course_id = ? and serial=?';
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["course_id"],
                $data["serial"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $matarial= array();

        $selectQuery = "UPDATE course_progression set status = 'complete'  where status = 'incomplete' and learner_id = ? and course_id = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data['id'], $data['course_id']
            ]);
        }catch(PDOException $e){
            echo "Update ".$e->getMessage();
        }

        if(!empty($result)){
            foreach ($result as $row){
                $matarial=$row;
                break;
            }
            $selectQuery_2 = "INSERT INTO `course_progression` (`learner_id`, `material_id`, `status`,`course_id`) VALUES (:learner_id, :material_id, :status, :course_id)";
            try{
                $stmt = $conn->prepare($selectQuery_2);
                $stmt->execute([
                    ':learner_id'  => $data["id"] ,
                    ':material_id' => $matarial["material_id"],
                    ':status' => "incomplete",
                    ":course_id" => $data['course_id']
                ]);
            }catch(PDOException $e){
                echo "create_2 ".$e->getMessage();
            }

        }
        $conn = null;
    }


    

}



?>