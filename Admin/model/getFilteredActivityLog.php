<?php
require_once 'db_connect.php';


if (!isset($_POST['value'])) {
    $conn = db_conn();
    $selectQuery = 'select title, comment_one, comment_two, comment_three, comment_four, DATE_FORMAT(date, "%d %b, %Y - %r")as date from history ORDER BY date DESC';
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;
    $data = array();

    foreach ($result as $row) {
        $sub = array(
            "title" => $row["title"],
            "details" => $row["comment_one"] . "<br>" . $row["comment_two"] . "<br>" . $row["comment_three"] . "<br>" . $row["comment_four"],
            "date" => $row["date"]
        );
        array_push($data, $sub);
    }
    echo json_encode($data);
}


if (isset($_POST['value'])) {
    $data = array();

    function search_array($array, $value)
    {
        for ($x = 0; $x < count($array); $x++) {
            if ($array[$x] == $value) {
                return true;
            }
        }
        return false;
    }

    $array = $_POST["value"];


    if (search_array($array, "Admin")) {
        $selectQuery =
            'select h.title, h.comment_one, h.comment_two, h.comment_three, h.comment_four, DATE_FORMAT(h.date, "%d %b, %Y - %r")as date from history h, users u where h.added_by = u.id and u.usertype = ?';
        $conn = db_conn();
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute(["Admin"]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        foreach ($result as $row) {
            $sub = array(
                "title" => $row["title"],
                "details" => $row["comment_one"] . "<br>" . $row["comment_two"] . "<br>" . $row["comment_three"] . "<br>" . $row["comment_four"],
                "date" => $row["date"]
            );
            array_push($data, $sub);
        }
    }

    if (search_array($array, "Manager")) {

        $selectQuery =
            'select h.title, h.comment_one, h.comment_two, h.comment_three, h.comment_four, DATE_FORMAT(h.date, "%d %b, %Y - %r")as date from history h, users u where h.added_by = u.id and u.usertype = ?';
        $conn = db_conn();
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute(["Manager"]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        foreach ($result as $row) {
            $sub = array(
                "title" => $row["title"],
                "details" => $row["comment_one"] . "<br>" . $row["comment_two"] . "<br>" . $row["comment_three"] . "<br>" . $row["comment_four"],
                "date" => $row["date"]
            );
            array_push($data, $sub);
        }
    }
    if (search_array($array, "Instructor")) {

        $selectQuery =
            'select h.title, h.comment_one, h.comment_two, h.comment_three, h.comment_four, DATE_FORMAT(h.date, "%d %b, %Y - %r")as date from history h, users u where h.added_by = u.id and u.usertype = ?';
        $conn = db_conn();
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute(["Instructor"]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        foreach ($result as $row) {
            $sub = array(
                "title" => $row["title"],
                "details" => $row["comment_one"] . "<br>" . $row["comment_two"] . "<br>" . $row["comment_three"] . "<br>" . $row["comment_four"],
                "date" => $row["date"]
            );
            array_push($data, $sub);
        }
    }

    if (search_array($array, "learner")) {

        $selectQuery =
            'select h.title, h.comment_one, h.comment_two, h.comment_three, h.comment_four, DATE_FORMAT(h.date, "%d %b, %Y - %r")as date from history h, users u where h.added_by = u.id and u.usertype = ?';
        $conn = db_conn();
        try {
            $stmt = $conn->prepare($selectQuery);
            $stmt->execute(["learner"]);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $conn = null;
        foreach ($result as $row) {
            $sub = array(
                "title" => $row["title"],
                "details" => $row["comment_one"] . "<br>" . $row["comment_two"] . "<br>" . $row["comment_three"] . "<br>" . $row["comment_four"],
                "date" => $row["date"]
            );
            array_push($data, $sub);
        }
    }
    echo json_encode($data);
}

