<?php
session_start();

if (isset($_SESSION['id'])) {
    session_destroy();
    header("location:../../sign-in.php");
} else {
    header("location:../../sign-in.php");
}
?>