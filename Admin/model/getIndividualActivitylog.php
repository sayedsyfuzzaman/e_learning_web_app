<?php
require_once 'db_connect.php';
$id = "";
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $conn = db_conn();
    $selectQuery = 'select title, comment_one, comment_two, comment_three, comment_four, DATE_FORMAT(date, "%M %d %Y, %r") as date from history where added_by = ?;';
    try {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = array();

    foreach ($result as $row) {
        $sub = array(
            "title" => '<td>
                        <div class="d-flex">
                            <div class="col-md-8">
                                <p><i class="fas fa-fw fa-newspaper mr-2"></i>' . $row["title"] . '</p>
                            </div>
                            <div class="col-md-4">
                                <p><i class="ion ion-md-time mr-2"></i>' . $row["date"] . '</p>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <p>' . $row["comment_one"] . " " . $row["comment_two"] . " " . $row["comment_three"] . " " . $row["comment_four"] . '</p>
                        </div>
                    </td>'
        );
        array_push($data, $sub);
    }
}
echo json_encode($data);
