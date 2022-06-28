<?php
$msg="";
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
include('../private/User_nav.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | My Orders</title>
    <style>
        #orderBody{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        #placed,#ship{
        text-align: center;
        margin:1rem;
        }
        table{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        th{
            padding:0.5rem 1rem;
            background-color: #00cc99;
        }
        td{
            padding:0.5rem 1rem;
            background-color: whitesmoke;
        }
        .data:hover{
            transform: scaleX(1.2);
        }
        td a{
           text-decoration: none;
           color:black;
           text-decoration: underline; 
        }
        .head{
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 3rem;
        }
    </style>
</head>
<body>
    <div align="center" class="head">
        <?php
            if(isset($_REQUEST['st'])){
                $st=$_REQUEST['st'];
                if($st==0){
                    $head="PLACED ORDER";
                }
                elseif($st==1){
                    $head="SHIPPED ORDER";
                }
                elseif($st=3){
                    $head="DELIVERED ORDER";
                }
                else{
                    $head="<p style='color:red'>ERROR FOUND</>";
                }
            }
        ?>
        <div><h2><?=$head?></h2></div>
        <div>
            <form action="" metho="POST">
                <input type="text" name="srch" placeholder="Ordered by">
                <input type="submit" name="submit" value="SEARCH" id="">
            </form>
        </div>
    </div>
    <div id="placed">
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Ordered By</th>
                    <th>Books Type</th>
                    <th>Payment Method</th>
                </tr>
            <?php
            $placed=mysqli_query($conn,"SELECT uniqueorder,sum(qty) AS qty,method,customer FROM orders WHERE userID=$userID and orderstatus=$st GROUP BY uniqueorder ORDER BY orderedTime desc ");
            if(isset($_REQUEST['submit'])){
                $sr=$_REQUEST['srch'];
                $placed=mysqli_query($conn,"SELECT uniqueorder,sum(qty) AS qty,method,customer FROM orders WHERE userID=$userID and orderstatus=$st and customer LIKE '%$sr%' GROUP BY uniqueorder ORDER BY orderedTime desc  ");
            }
                if(mysqli_num_rows($placed)>0){
                    while($getPlaced=mysqli_fetch_assoc($placed)){
                        $name=$getPlaced['customer'];
                        $uqorid=$getPlaced['uniqueorder'];
                        $orqty=$getPlaced['qty'];
                        $ordTime=$getPlaced['method'];
                        $totprod2=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$uqorid' and orderStatus=$st");
                        $numqty=mysqli_num_rows($totprod2);
                        echo "<tr><td class='data'><a href='orderSummary.php?id=$uqorid'>$uqorid</a></td><td>$name</td><td>$numqty</td><td>$ordTime</td></tr>";
                    }
                }
                else{
                    $msg.="-";
                    echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";
                }
            ?>
            </table>
        </div>