<?php
    include ('../private/dbconnect.php');
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
    include('../private/admin-header-nav.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Home | Bookship</title>
    <style>
        .subParts,.parts{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .heads{
            border: 2px solid cornflowerblue;
            border-radius: 5px;
            padding:1rem;
            margin:1rem;
            text-decoration: none;
            background-color: cornflowerblue;
            color:white;
            font-weight: 600;
        }
        .heads:hover{
            transform: scaleY(1.1);
        }
        .parts a{
            text-decoration: none;
        }
        hr{
            margin:0.5rem 1rem;
        }
    </style>
</head>
<body>
    <div class="parts">
        <div class="subParts">
           <a href=""><div class="heads" id="cat">MANAGE CATEGORY</div></a>
            <a href=""><div class="heads" id="prod">MANAGE PRODUCT</div></a>
        </div>
        <div class="subParts">
            <a href="Admin_placedbooks.php"><div class="heads" id="placed">ORDERS RECEIVED</div></a>
            <a href="Admin_shippedbooks.php"><div class="heads" id="ship">ORDERS SHIPPED</div></a>
            <!-- <a href="Admin_placedbooks.php"><div class="heads" id="placed">ORDERS CANCELLED</div></a>
            <a href="Admin_shippedbooks.php"><div class="heads" id="ship">ORDERS DELIVERED</div></a> -->
        </div>
    </div>
    <hr>
    <!-- SALES -->
    <div class="dashboard">
        <div class="sales">
            <div></div>
            <div></div>
        </div>
        <div>
            <div></div>
            <div></div>
        </div>
    </div>
</body>
</html>
