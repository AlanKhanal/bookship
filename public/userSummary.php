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
        body{
            background:rgb(202, 205, 212);
        }
        .subParts,.parts{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .heads{
            border: 2px solid #003399;
            border-radius: 5px;
            padding:1rem;
            margin:1rem;
            text-decoration: none;
            background-color: #003399;
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
            margin:0rem 1rem;
        }
        .delivered{
            margin: 1rem;
        }
        .delivered table th{
            background-color: purple;
            color:white;
            padding:0.2rem 0.5rem;
            font-size: 18px;
        }
        .delivered table td,.delivered table td a{
            background-color: whitesmoke;
            color:black;
            padding:0.2rem 0.5rem;
        }
        .delivered table .main:hover{
            transform: scale(1.1);
        }
        .delivered table{
            background-color: purple;
            border: 3px solid purple;
            border-radius: 0.3rem;
        }
    </style>
</head>
<body>
    <div class="parts">
        <div class="subParts">
           <a href="Admin_category_management.php"><div class="heads" id="cat">MANAGE CATEGORY</div></a>
            <a href="Admin_product_management.php"><div class="heads" id="prod">MANAGE PRODUCT</div></a>
        </div>
        <div class="subParts">
            <a href="Admin_placedbooks.php"><div class="heads" id="placed">ORDERS RECEIVED</div></a>
            <a href="Admin_shippedbooks.php"><div class="heads" id="ship">ORDERS SHIPPED</div></a>
            <!-- <a href="Admin_placedbooks.php"><div class="heads" id="placed">ORDERS CANCELLED</div></a>
            <a href="Admin_shippedbooks.php"><div class="heads" id="ship">ORDERS DELIVERED</div></a> -->
        </div>
    </div>
    <hr>
    <?php

if(isset($_REQUEST['id'])){
    $userid=$_REQUEST['id'];

    $get=mysqli_query($conn,"SELECT * FROM users WHERE userID=$userid");
    while($getName=mysqli_fetch_assoc($get)){
        $user=strtoupper($getName['userName']);
    }
}
?>
<div class="delivered">
<div class="miniRow">
                    <div class="head" style="color:purple;font-size:24px;margin:0.5rem;"><b>USER</b>: <b><u><?=$user?></u></b> </div>
                    <br>
                </div>
<table>
    <tr>
        <th>ID</th>
        <th>ORDERED BY</th>
        <th>BOOKS TYPE</th>
        <th>PAYMENT</th>
    </tr>

<?php
    $placed=mysqli_query($conn,"SELECT uniqueorder,sum(qty) AS qty,method,customer FROM orders WHERE userID=$userid AND orderStatus=3 GROUP BY uniqueorder ORDER BY orderedTime desc LIMIT 6");
    if($rowplaced=mysqli_num_rows($placed)>0){
        while($getPlaced=mysqli_fetch_assoc($placed)){
            $name2=$getPlaced['customer'];
            $uqorid2=$getPlaced['uniqueorder'];
            $orqty=$getPlaced['qty'];
            $ordTime3=$getPlaced['method'];
            $totprod223=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$uqorid2' and orderStatus=3");
            $numqty2=mysqli_num_rows($totprod223);
            echo "<tr><td class='main'><a href='Admin_orderSummary.php?id=$uqorid2'>$uqorid2</a></td><td>$name2</td><td>$numqty2</td><td>$ordTime3</td></tr>";
        }
    }
    else{
        $msg.="-";
        echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";

    }
?>
</table>
</div>