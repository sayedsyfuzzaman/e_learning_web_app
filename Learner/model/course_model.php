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
}



?>