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

        $Query3 = "INSERT into history (title, comment_one, comment_two,  added_by, date)
                    VALUES (:title, :comment_one, :comment_two, :added_by, now()); ";
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

            $stmt3 = $conn->prepare($Query3);
            $stmt3->execute([
                ':title'           => "Created a New Manager.",
                ':comment_one'    => "Manager ID:" . $data["id"],
                ':comment_two'    => "Manager Password:" . $data["password"],
                ':added_by'    => $data["added_by"]
            ]);



            if ($stmt1 == true and $stmt2 == true and $stmt3 == true) {
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

    function checkExistingPersonalNID($nid, $id)
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

    function getUserInfo($data)
    {
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
        while ($stmt->fetch(PDO::FETCH_OBJ)) {
            $count++;
        }
        $conn = null;
        return $count;
    }

    function updatePersonalInfo($data)
    {
        $conn = db_conn();
        $selectQuery = "UPDATE admin_info set name = ?, email = ?, phone = ?, nid = ?, dob = ?, gender = ?, address = ?, nationality = ? where id = ?";
        try {
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
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $conn = null;
        if ($stmt == true) {
            return true;
        }
        return false;
    }

    function updatePassword($password)
    {
        $conn = db_conn();
        $selectQuery = "UPDATE admin_info set password = ? where id = ? and password = ?";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $password["new"],
                $password["id"],
                $password["current"]
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($stmt) {
            return true;
        }
    }

    function changeStatus($status, $id)
    {
        $conn = db_conn();
        $selectQuery = "UPDATE manager_info set status = ? where id = ?";


        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $status,
                $id
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if ($stmt) {
            return true;
        }
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
    function showInstructor($id)
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `instructor_info` where id = ?';
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    function getDailyEnrolles($date)
    {
        $conn = db_conn();
        $selectQuery = 'select * from course_info where DATE_FORMAT(created_at, "%d/%m/%Y") = ?' ;

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $date
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $count = 0;
        while ($stmt->fetch(PDO::FETCH_OBJ)) {
            $count++;
        }
        $conn = null;
        return $count;
    }

    function getTotalUsers()
    {
        $conn = db_conn();
        $selectQuery = 'select * from users' ;

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $count = 0;
        while ($stmt->fetch(PDO::FETCH_OBJ)) {
            $count++;
        }
        $conn = null;
        return $count;
    }

    function getTotalEarnings()
    {
        $conn = db_conn();
        $selectQuery = 'SELECT SUM(course_price) as earnings FROM enrolled_course;' ;

        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    
}
