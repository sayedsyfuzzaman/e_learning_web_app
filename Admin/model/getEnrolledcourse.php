<?php
require_once 'db_connect.php';

$id = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn = db_conn();
    $selectQuery = 'select c.thumbnail, c.course_name, c.course_id, ec.course_price,  DATE_FORMAT(ec.enrolled_at, "%d %b, %Y - %h:%i %p") as enrolled_at from course_info c, enrolled_course ec where c.course_id = ec.course_id and ec.learner_id = ? ORDER BY enrolled_at DESC';
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;

    $data = array();

    foreach ($result as $row) {
        $sub = array(
            "thumbnail" => '<img style="height: 40px; height: 40px;" src="' . '../' . $row["thumbnail"] . '" alt="Image"> </td>',
            "course_name" => $row["course_name"],
            "course_id" => $row["course_id"],
            "course_price" => $row["course_price"],
            "enrolled_at" => $row["enrolled_at"]
        );
        array_push($data, $sub);
    }
    echo json_encode($data);
}
