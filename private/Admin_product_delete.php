<?php
include 'dbconnect.php';
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
        // $adminName=$row['adminName'];
        // $adminEmail=$row['email'];
        // $companyName=$row['companyName'];
        // $companyAddress=$row['companyAddress'];
    }

if(isset($_REQUEST['deleteID'])){
    $deleteID=$_REQUEST['deleteID'];

    $hideProduct="UPDATE products SET productStatus=0 WHERE productID=$deleteID AND adminID=$adminID";
    $runhide=mysqli_query($conn,$hideProduct);
    if($runhide){
        header('location:http://localhost:8081/bookship/public/Admin_product_management.php');
    }
    else{
        echo $deleteID;
    }
}
?>