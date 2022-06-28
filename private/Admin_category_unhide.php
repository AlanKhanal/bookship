<?php
include 'dbconnect.php';

if(isset($_REQUEST['categoryID'])){
    $categoryIDedit=$_REQUEST['categoryID'];
    
}
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
    }
    $fetch=mysqli_query($conn,"SELECT * FROM categories where categoryID='$categoryIDedit'");
    $row=mysqli_fetch_assoc($fetch);
    echo $catname=$row['categoryName'];
    $query022="UPDATE categories SET categoryStatus=1 WHERE categoryID='$categoryIDedit'";
    $run022=mysqli_query($conn,$query022);
    if($run022){
        $unhideProduct="UPDATE products SET productStatus=1 WHERE productCategory='$catname'";
        $rununhide=mysqli_query($conn,$unhideProduct);
        if($rununhide){
            header('location:../public/Admin_category_management.php');
        }
    }
?>