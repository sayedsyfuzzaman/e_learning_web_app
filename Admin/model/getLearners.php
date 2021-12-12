<?php
require_once 'db_connect.php';
$conn = db_conn();
$selectQuery = 'SELECT * FROM `learner_info` group by created_at DESC';
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
        "image" =>'<img style="height: 40px; height: 40px;" src="'.'../Learner/'.$row["image"].'" alt="Image"> </td>',
        "highest_degree" => $row["highest_degree"],
        "action" => '<a target="_blank" class="btn btn-outline-primary" href="learner-profile.php?id='.$row['id'].'">View More</a>'
    );
    array_push($data, $sub);
}
echo json_encode($data);
?>

