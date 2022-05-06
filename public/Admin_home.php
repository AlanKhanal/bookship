<?php
    include ('../private/dbconnect.php');
    include('../private/admin-header-nav.php');
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location: Admin_login.php");
    }
    $admin = $_SESSION['adminName'];
    $query = "SELECT * FROM admins WHERE adminName='$admin'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $adminID=$row['adminID'];
        $adminName=$row['adminName'];
        $adminEmail=$row['email'];
        $companyName=$row['companyName'];
        $companyAddress=$row['companyAddress'];
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Home | Bookship</title>
    <style>
        .info{
            padding-left: 5rem;
        }
        div{
            padding:20px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <!-- <a href="../private/Admin-logout.php">Logout</a> -->
    <div class="info">
        <div><b>Company Name:</b><?=$companyName?></div>
        <div><b>Admin Name:</b><?=$adminName?></div>
        <div><b>Location:</b><?=$companyAddress?></div>
        <div><b>E-mail:</b><?=$adminEmail?></div>
    </div>
</body>
</html>