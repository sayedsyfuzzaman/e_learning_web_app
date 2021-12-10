<?php 
function db_conn()
{
    $servername = "springsoftbd.com";
    $username = "elearning_webapp_admin";
    $password = "elearning_webapp_admin%8879";
    $dbname = "elearning_webapp";

    try {
        $conn = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        // var_dump($conn) ;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
    return $conn;
}
?>
