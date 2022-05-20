<?php
    include ('../private/dbconnect.php');
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location: user_login.php");
    }
    $user = $_SESSION['userName'];
    $query = "SELECT * FROM users WHERE userName='$user'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $userID=$row['userID'];
        $userName=$row['userName'];
        $userEmail=$row['email'];
    }
?>

