<?php
require_once 'db_connect.php';
$conn = db_conn();
$selectQuery = 'SELECT * FROM `instructor_info` group by created_at DESC';
try {
    $stmt = $conn->query($selectQuery);
} catch (PDOException $e) {
    echo $e->getMessage();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$conn = null;

$data = array();

foreach($result as $row){
    $sub = array(
        "id" => $row["id"],
        "name" => $row["name"],
        "image" => $row["image"],
        "job_title" => $row["job_title"],
        "field" => $row["field"],
        "balance" => $row["balance"],
        "action" => '<a target="_blank" class="btn btn-outline-primary" href="instructor-profile.php?id='.$row['id'].'">View More</a>'
    );
    array_push($data, $sub);
}
echo json_encode($data);
?>

