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

if(isset($_REQUEST['orID'])){
    $id=$_REQUEST['orID'];
    $getpID=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$id' and userID=$userID");
    if(mysqli_num_rows($getpID)>0){
        while($datapr=mysqli_fetch_assoc($getpID)){
            $pId=$datapr['productID'];
            $oQty=$datapr['qty'];
            
            $updateProQty=mysqli_query($conn,"UPDATE products SET productQty=productQty+$oQty WHERE productID=$pId");

            if($updateProQty){
                if(mysqli_query($conn,"DELETE FROM orders WHERE userID=$userID and uniqueorder='$id'")){
                    header("location:orders.php");
                }
            }
        }
    }
    }
?>