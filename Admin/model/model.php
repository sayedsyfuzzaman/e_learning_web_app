<?php
require_once 'db_connect.php';

class model
{
    function insertManager($data)
    {
        $conn = db_conn();
        $Query1 = "INSERT into manager_info (id, password, name, email, phone, nationality, nid, dob, gender, address, image, created_at)
                                     VALUES (:id, :password, :name, :email, :phone,:nationality, :nid, :dob, :gender, :address, :image, NOW()); ";
        $Query2 = "INSERT into users (id, usertype)
        VALUES (:id, :usertype); ";

        try {
            $stmt1 = $conn->prepare($Query1);
            $stmt1->execute([
                ':id'           => $data["id"],
                ':password'     => $data["password"],
                ':name'      => $data["name"],
                ':email'         => $data["email"],
                ':phone'         => $data["phone"],
                ':nationality'  => $data["nationality"],
                ':nid'         => $data["nid"],
                ':dob'          => $data["dob"],
                ':gender'        => $data["gender"],
                ':address'        => $data["address"],
                ':image'        => $data["image"]
            ]);

            $stmt2 = $conn->prepare($Query2);
            $stmt2->execute([
                ':id'           => $data["id"],
                ':usertype'    => "Manager"
            ]);

            if ($stmt1 == true and $stmt2 == true) {
                return true;
            } else {
                $conn = null;
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        $conn = null;
        return false;
    }

    function checkExistingEmail($email)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `manager_info` where email = ?";

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$email]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if (!empty($row)) {
            return true;
        }
    }

    function checkExistingPersonalEmail($email, $id)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM admin_info WHERE email = ? and id != ?;";

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $email,
                $id
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if (!empty($row)) {
            return true;
        }
    }

    function checkExistingNID($nid)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `manager_info` where nid = ?";

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $nid
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if (!empty($row)) {
            return true;
        }
        return false;
    }

    function checkExistingPersonalNID($nid , $id)
    {
        $conn = db_conn();
        $selectQuery = "SELECT * FROM `admin_info` where nid = ? and id != ?";

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $nid,
                $id
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $conn = null;

        if (!empty($row)) {
            return true;
        }
        return false;
    }

    function getUserInfo($data){
        $conn = db_conn();
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

    function getTotalManagerNumber()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT id FROM `manager_info` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $count = 0;
        while($stmt->fetch(PDO::FETCH_OBJ)) {
            $count++;
        }
        $conn = null;
        return $count;
    }

    function showAllManager()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `manager_info` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $rows;
    }
    function showAllLearner()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `learner_info` ';
        try {
            $stmt = $conn->query($selectQuery);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        return $rows;
    }


    
    function updatePersonalInfo($data) {
        $conn = db_conn();
        $selectQuery = "UPDATE admin_info set name = ?, email = ?, phone = ?, nid = ?, dob = ?, gender = ?, address = ?, nationality = ? where id = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["name"],
                $data["email"],
                $data["phone"],
                $data["nid"],
                $data["dob"],
                $data["gender"],
                $data["address"],
                $data["nationality"],
                $data["id"]
            ]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $conn = null;
        if($stmt == true)
        {
            return true;
        }
        return false;
    }

    function updatePassword($password) {
        $conn = db_conn();
        $selectQuery = "UPDATE admin_info set password = ? where id = ? and password = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $password["new"],
                $password["id"],
                $password["current"]
            ]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        if($stmt){
            return true;
        }
    }

    function deleteManager($id){
        $conn = db_conn();
        $selectQuery = "DELETE FROM `manager_info` WHERE `id` = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }

        $selectQuery = "DELETE FROM `users` WHERE `id` = ?";
        try{
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        $conn = null;
    
        return true;
    }

    function showManager($id)
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `manager_info` where id = ?';
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function showLearner($id)
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `learner_info` where id = ?';
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function showActivityLog($id)
    {
        $conn = db_conn();
        $selectQuery = 'select title, comment_one, comment_two, comment_three, comment_four, DATE_FORMAT(date, "%M %d %Y, %r") as date from history where added_by = ?;';
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}
