<?php
require_once 'db_connect.php';
$conn = db_conn();
$selectQuery = 'SELECT * FROM `manager_info` group by created_at DESC';
try {
    $stmt = $conn->query($selectQuery);
} catch (PDOException $e) {
    echo $e->getMessage();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$conn = null;

$data = array();

foreach($result as $row){
    $action = '<a target="_blank" class="btn btn-outline-primary" href="manager-profile.php?id='.$row['id'].'">View</a>'.
    '<button type="button" onclick = "changeStatus()" class="btn btn-danger"><i class="align-middle fas fa-fw fa-ban"></i></button>';

    if($row["status"] == "false"){
        $action = '<a target="_blank" class="btn btn-outline-primary" href="manager-profile.php?id='.$row['id'].'">View</a>'.
        '<button type="button" class="btn btn-success"><i class="align-middle fas fa-fw fa-check"></i></button>';
    }
    $sub = array(
        'image' => '<img style="height: 40px; height: 40px;" src="'.'../Admin/'.$row["image"].'" alt="Image"> </td>',
        'name' => $row["name"],
        'id' => $row["id"],
        'email' => $row["email"],
        'nationality' => $row["nationality"],
        'nid' => $row["nid"],
        'salary' => $row["salary"],
        'created_at' => $row["created_at"],
        'action' => $action
                    
    );
    array_push($data, $sub);
}
echo json_encode($data);
