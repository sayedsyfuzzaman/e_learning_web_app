<?php
require_once 'db_connect.php';

$conn = db_conn();
$selectQuery = 'select c.thumbnail, c.course_name, c.course_id, c.avilability as status, m.name as created_by from course_info c, manager_info m where c.created_by = m.id order by c.created_at desc;';
try {
    $stmt = $conn->prepare($selectQuery);
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$data = array();
foreach ($result as $row) {
    $status = '<span class="badge badge-warning">In progress</span>';
    if($row["status"] == "true"){
        $status = '<span class="badge badge-success">Done</span>';
    }
    $sub = array(
        "thumbnail" => '<img style="height: 40px; height: 40px;" src="' . '../' . $row["thumbnail"] . '" alt="Image"> </td>',
        "course_name" => $row["course_name"],
        "course_id" => $row["course_id"],
        "created_by" => $row["created_by"],
        "status" => $status,
        "action" => '<a target="_blank" class="btn btn-success" href="course-details.php?id='.$row['course_id'].'">Edit</a>'
    );
    array_push($data, $sub);
}
echo json_encode($data);
