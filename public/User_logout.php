<?php   
    include 'dbconnect.php';
    session_start();
    $_SESSION = array();
    session_destroy();
    header("location: ../public/User_login.php");
?>