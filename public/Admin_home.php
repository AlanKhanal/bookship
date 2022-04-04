<?php
    include ('../private/dbconnect.php');
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location: Admin_login.php");
    }
    $admin = $_SESSION['adminName'];
    $query = "SELECT `adminID` FROM admins WHERE adminName='$admin'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $adminID=$row['adminID'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Home | Bookship</title>
</head>
<body>
    <a href="../private/Admin-logout.php">Logout</a>
</body>
</html>