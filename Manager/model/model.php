<?php
require_once 'db_connect.php';
class model
{
    function insertCourse($data)
    {
        $conn = db_conn();
        $Query1 = "INSERT into course_info (thumbnail, course_id, course_name, created_by, created_at, price, discount, avilability)
                 VALUES (:thumbnail, :course_id, :course_name, :created_by, now(), :price, :discount, :avilability); ";

        $Query3 = "INSERT into history (title, comment_one, comment_two,  added_by, date)
                    VALUES (:title, :comment_one, :comment_two, :added_by, now()); ";
        try {
            $stmt1 = $conn->prepare($Query1);
            $stmt1->execute([
                'thumbnail' => "courseThumbnail/course-thumbnail.png",
                'course_id' => $data["course_id"],
                'course_name' => $data["course_name"],
                'created_by' => $data["created_by"],
                'price' => $data["price"],
                'discount' => $data["discount"],
                'avilability' => $data["avilability"]
            ]);



            $stmt3 = $conn->prepare($Query3);
            $stmt3->execute([
                ':title'           => "Created a New Course.",
                ':comment_one'    => "Course ID: " . $data["course_id"],
                ':comment_two'    => "Course Name: " . $data["course_name"],
                ':added_by'    => $data["created_by"]
            ]);

            if ($stmt1 == true  and $stmt3 == true) {
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
        $selectQuery = "SELECT * FROM manager_info WHERE email = ? and id != ?;";

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
        $selectQuery = "SELECT * FROM `manager_info` where nid = ? and id != ?";

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
        $selectQuery = "UPDATE manager_info set name = ?, email = ?, phone = ?, nid = ?, dob = ?, gender = ?, address = ?, nationality = ? where id = ?";
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

    function updateCourse($data)
    {
        $conn = db_conn();
        $selectQuery = "UPDATE course_info set course_name = ?, price = ?, discount = ?, avilability = ? where course_id = ?";
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute([
                $data["course_name"],
                $data["price"],
                $data["discount"],
                $data["avilability"],
                $data["course_id"]
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
        $selectQuery = "UPDATE manager_info set password = ? where id = ? and password = ?";
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

    function showCourse($id)
    {
        $conn = db_conn();
        $selectQuery = 'SELECT * FROM `course_info` where course_id = ?';
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
