<?php
   class model{
       public $username="";
       public $message="";

       //general
       function db_conn()
      {
        $servername = "localhost";
        $username = "root";
        $password = "";
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

       function get_user($id){

        $conn = $this->db_conn();
        $selectQuery = "SELECT * FROM `users` where id = ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($row)){
            return $row;
        }
        return "";
    }

    //learner

    function verify_learner_id_password($id,$password){
        $conn = $this->db_conn();
        $selectQuery = "SELECT * FROM `learner_info` where id = ?";
    
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if(!empty($row)){
            if($row['password'] == $password){
                return $row;
            }
            else{
                return "";
            }
        }
        return "";
    }

    //Add your login function

    function getAdminInfo($data){
        $conn = $this->db_conn();
        $selectQuery = "select u.usertype , a.* from users u , admin_info a where u.id = a.id and u.id = ? and a.password = ? ";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["id"],
                $data["password"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $rows;
    }
   }
?>