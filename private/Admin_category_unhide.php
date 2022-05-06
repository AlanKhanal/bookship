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

    $query022="UPDATE categories SET categoryStatus=1 WHERE adminID=$adminID AND categoryID=$categoryIDedit";
    $run022=mysqli_query($conn,$query022);
    if($run022){
        header('location:../private/Admin_moreManagementCat.php');
    }
?>