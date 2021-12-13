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
    $action = '<a target="_blank" class="btn btn-outline-primary" href="manager-profile.php?id='.$row['id'].'">View</a>';
    $status = '<a class="btn btn-danger" href="manager-details.php?status=false&id='.$row['id'].'"><i class="align-middle fas fa-fw fa-check mr-3"></i>Block</a>';

    if($row["status"] == "false"){
        $action = '<a target="_blank" class="btn btn-outline-primary" href="manager-profile.php?id='.$row['id'].'">View</a>';
        $status = '<a class="btn btn-success" href="manager-details.php?status=true&id='.$row['id'].'"><i class="align-middle fas fa-fw fa-ban"></i>Unblock</a>';
    }

    $sub = array(
        'image' => '<img style="height: 40px; height: 40px;" src="'.'../Manager/'.$row["image"].'" alt="Image"> </td>',
        'name' => $row["name"],
        'id' => $row["id"],
        'email' => $row["email"],
        'nationality' => $row["nationality"],
        'nid' => $row["nid"],
        'created_at' => $row["created_at"],
        'status' => $status,
        'action' => $action
                    
    );
    array_push($data, $sub);
}
echo json_encode($data);
