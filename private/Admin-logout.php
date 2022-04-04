<?php   
    include 'dbconnect.php';
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: ../public/Admin_login.php");
?>