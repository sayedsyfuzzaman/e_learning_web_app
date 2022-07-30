<?php 
function db_conn()
{
    $servername = "sql205.epizy.com";
    $username = "epiz_32271769";
    $password = "3W5Mz5NLxE";
    $dbname = "epiz_32271769_e_learning_web_app";

    

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
