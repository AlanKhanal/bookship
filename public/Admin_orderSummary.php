<?php
$msg="";
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
    <title>Bookship | My Orders</title>
    <style>
        body{
            background:rgb(202, 205, 212);
        }
        #orderBody{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        #placed,#ship{
        text-align: center;
        margin:1rem;
        }
        .summary table{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .head th{
            padding:0.5rem 1rem;
            background-color: #20214a;
            color: white;
        }
        #placed th{
            padding:0.5rem 1rem;
            background-color: #00cc99;
        }
        .summary td{
            text-align: left;
            padding:0.5rem 1rem;
            background-color: whitesmoke;
        }
        .data:hover{
            /* transform: scaleX(1.2); */
            transform: scaleY(1.1);
        }
        .cancellation:hover{
            transform: scaleX(1.05);
        }
        .summary a{
           text-decoration: none;
           color:black;
           /* text-decoration: underline;  */
        }
        .head{
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 3rem;
        }
    </style>
</head>
<body>
   <?php
 if(isset($_REQUEST['id'])){
    $orID=$_REQUEST['id'];
    $data=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$orID'");
    if(mysqli_num_rows($data)>0){
        while($rowda=mysqli_fetch_assoc($data)){
            $userID=$rowda['userID'];
            $name=$rowda['customer'];
            $productID=$rowda['productID'];
            $qty=$rowda['qty'];
            $price=$rowda['price'];
            $mail=$rowda['mail'];
            $phone=$rowda['phno'];
            $state=$rowda['state'];
            $city=$rowda['city'];
            $street=$rowda['street'];
            $hono=$rowda['hono'];
            $postC=$rowda['postC'];
            $method=$rowda['method'];
            $time=$rowda['orderedTime'];

            $findUser=mysqli_query($conn,"SELECT * FROM users WHERE userID=$userID");
            while($user=mysqli_fetch_assoc($findUser)){
                $userNamebyid=$user['userName'];
            }
                }
            }     
        }
if(isset($_REQUEST['st'])){
    $st=$_REQUEST['st'];
}
   ?>
    <div style="display:flex;justify-content:space-around;flex-wrap:wrap;" class="summary">
    <div class="head">
    <div>
        <table>
            <tr>
                <th colspan="2" style="color:white;background-color:grey;font-size:20px">CUSTOMER DETAILS</td>
            </tr>
            <tr>
                <th colspan="2"><b>PERSONAL DETAILS</b></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><?=$userNamebyid?></td>
            </tr>
            <tr>
                <td>Order Id</td>
                <td><?=$orID?></td>
            </tr>
            <tr>
                <td>Ordered By</td>
                <td><?=$name?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$phone?></td>
            </tr>
            <tr>
                <th colspan="2"><b>SHIPPING DETAILS</b></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?=$state?></td>
            </tr>
            <tr>
                <td>City</td>
                <td><?=$city?></td>
            </tr>
            <tr>
                <td>Street</td>
                <td><?=$street?></td>
            </tr>
            <tr>
                <td>House number</td>
                <td><?=$hono?></td>
            </tr>
            <tr>
                <td>Postal Code</td>
                <td><?=$postC?></td>
            </tr>
            <tr>
                <th colspan="2"><b>PAYMENT OPTION</b></td>
            </tr>
            <tr>
                <td>Method</td>
                <td><?=$method?></td>
            </tr>
            <tr>
                <td>date & Time</td>
                <td><?=$time?></td>
            </tr>
        </table>
    </div>
    </div>
    <div id="placed">
            <table>
                <tr>
                    <th colspan="6" style="color:white;background-color:grey;font-size:20px">ORDER DETAILS</th>
                </tr>
                <tr>
                    <th colspan="2">Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Per Book</th>
                    <th>Price</th>
                </tr>
            
            <?php
            // INNERJOIN connect proDID and productTable
            $data2=mysqli_query($conn,"SELECT orders.totPrice,orders.productID,orders.method,orders.qty,products.productName,products.productCategory,products.productCost,products.productImg,products.productQty
            FROM orders 
            INNER JOIN products
            ON orders.productID = products.productID WHERE uniqueorder='$orID';");
            if(mysqli_num_rows($data2)>0){
                while($getPlaced2=mysqli_fetch_assoc($data2)){
                        $ID=$getPlaced2['productID'];
                        $prdqty=$getPlaced2['productQty'];
                        if($prdqty>=1){
                            $link="http://localhost:8081/bookship/private/Admin_product_edit.php?productID=$ID";
                        }
                        else{
                            $link="";
                        }
                        $img=$getPlaced2['productImg'];
                        $name=$getPlaced2['productName'];
                        $proCat=$getPlaced2['productCategory'];
                        $ordMeth=$getPlaced2['method'];
                        $ordqty=$getPlaced2['qty'];
                        $perCost=$getPlaced2['productCost'];
                        $totPrice=$getPlaced2['totPrice'];
                        echo "<tr><td class='data'>
                        <a href='$link'>
                        <img src='$img' width='90rem' height='120rem'>
                        </a>
                        </td>
                        <td class='data'><a href='$link'>
                        <b>$name</b>
                        </a></td>
                        <td>$proCat</td><td>$ordqty</td><td>NPR.$perCost</td><td>NPR.$totPrice</td></tr>";
                    }
                }
                else{
                    $msg.="-";
                    echo "<tr><td>-</td><td>-</td><td>-</td></tr>";

                }
            ?>
            </table>
    <div align="right">
        <?php
        $query32 = "SELECT * FROM orders WHERE uniqueorder='$orID'";
        $query_run = mysqli_query($conn,$query32);
        $qty= 0;
        if($row32=mysqli_num_rows($query_run))
        while ($num = mysqli_fetch_assoc ($query_run)) {
            $qty += $num['totPrice'];
        }
        ?>
            <i><b>Total Price: NPR.<?=$qty?></b></i>
        </div>
    </div>
        </div>
    </div>