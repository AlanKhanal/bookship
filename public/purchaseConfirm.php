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
    
if(isset($_REQUEST['trsid'])){
    $uqid=$_REQUEST['trsid'];
    if(strlen($uqid)==0){
        header("location:User_home.php");
    }
}
if(isset($_REQUEST['oid'])){
    $uqord=$_REQUEST['oid'];
}
else{
    $uqord=uniqid();
}
}
$cart2order="INSERT INTO orders(productID,userID,uniquecart,qty,price,totPrice)
                SELECT `productID`,`userID`,`uniquecart`,`qty`,`price`,`totPrice` FROM cart WHERE userID=$userID";
$runc2o=mysqli_query($conn,$cart2order);
if($runc2o){
    $uniqinsert=mysqli_query($conn,"UPDATE orders SET uniqueorder='$uqord' WHERE uniqueorder='' and userID=$userID");
    if($uniqinsert){
        $getcustInfo="SELECT * FROM customerinfo WHERE userID=$userID and `status`=1 and uniquecart='$uqid'";
        $runquery=mysqli_query($conn,$getcustInfo);
        if (mysqli_num_rows($runquery) > 0){
            $row2 = mysqli_fetch_assoc($runquery);
            $cusName=$row2['customer'];
            $cusmail=$row2['mail'];
            $cusph=$row2['phno'];
            $cusstate=$row2['state'];
            $cuscity=$row2['city'];
            $cusstreet=$row2['street'];
            $cushono=$row2['hono'];
            $cuspostC=$row2['postC'];
            $cusmethod=$row2['method'];
            $infoInsert=mysqli_query($conn,"UPDATE orders SET customer='$cusName',`mail`='$cusmail',`phno`='$cusph',`state`='$cusstate',`city`='$cuscity',`street`='$cusstreet',`hono`='$cushono',`method`='$cusmethod',`postC`='$cuspostC' WHERE uniqueorder='$uqord' and userID=$userID");
            if($infoInsert){
                // $dltqty=mysqli_query($conn,"UPDATE products SET productQty=");
                mysqli_query($conn,"DELETE FROM cart");
                header("location:orders.php");
            }
        }
        else{
            echo 'error';
        }
        
    }
}
$getpro=mysqli_query($conn,"SELECT * FROM products WHERE productStatus=1");
if($getpro){
    if(($totRows=mysqli_num_rows($getpro)) > 0){
        while($Row32=mysqli_fetch_array($getpro)){
            $id=$Row32['productID'];
            $pqty=$Row32['productQty'];
            // in orders
            $getord=mysqli_query($conn,"SELECT distinct(productID) FROM orders WHERE productID=$id and userID=1");
            if($getord){
                if($totords=mysqli_num_rows($getord)>0){
                    while($Row33=mysqli_fetch_array($getord)){
                        $oid=$Row33['productID'];

                        $query34 = "SELECT * FROM orders WHERE userID=1 and productID=$oid";
                        $query_run = mysqli_query($conn,$query34);
                        $qty= 0;
                        while ($num = mysqli_fetch_assoc ($query_run)) {
                            $qty += $num['qty'];
                        }
                        // echo "$id has =".$qty." quantity<br>";
                        $update=mysqli_query($conn,"UPDATE products SET productQty=$pqty-$qty WHERE productID=$id");
                }
            }
        }
    }
}
}
?>