<?php
require_once 'db_connect.php';
$id = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn = db_conn();
    $selectQuery = 'select title, comment_one, comment_two, comment_three, comment_four, DATE_FORMAT(date, "%d %b, %Y - %r")as date from history where added_by = ? ORDER BY date DESC';
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = array();

    foreach($result as $row){
        $sub = array(
            "title" => $row["title"],
            "details" => $row["comment_one"]."<br>". $row["comment_two"]."<br>".$row["comment_three"]."<br>".$row["comment_four"],
            "date" => $row["date"]
        );
        array_push($data, $sub);
    }
    echo json_encode($data);
}

