<?php
require_once 'db_connect.php';

$conn = db_conn();
$selectQuery = 'select thumbnail, course_name, DATE_FORMAT(created_at, "%d %b")as date, created_by from course_info ORDER BY date DESC';
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
        "thumbnail" => '<img style="height: 40px; height: 40px;" src="'.'../'.$row["thumbnail"].'" alt="Image"> </td>',
        "course_name" => $row["course_name"],
        "date" => $row["date"],
        "created_by" => $row["created_by"]
    );
    array_push($data, $sub);
}
echo json_encode($data);
