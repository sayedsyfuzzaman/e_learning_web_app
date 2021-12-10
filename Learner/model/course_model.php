<?php
class courseModel{

    function db_conn()
    {
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "mydb";

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
        $selectQuery = 'SELECT * FROM `course`';
        try{
            $stmt = $conn->query($selectQuery);
        }catch(PDOException $e){
            echo "course ".$e->getMessage();
        }
        $course = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $course;
    }
}
?>