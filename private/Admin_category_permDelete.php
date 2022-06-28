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
        $fetch=mysqli_query($conn,"SELECT * FROM categories WhERE categoryID=$deleteID");
        while($row=mysqli_fetch_assoc($fetch)){
        $catName=$row['categoryName'];

        $hideCcat2="DELETE FROM products WHERE productCategory='$catName';";
        $runhide2=mysqli_query($conn,$hideCcat2);    
            if($runhide2){
                $hideCcat="DELETE FROM categories WHERE categoryID=$deleteID;";
                $runhide=mysqli_query($conn,$hideCcat);

                if($runhide){
                    header('location:http://localhost:8081/bookship/public/Admin_category_management.php');
                }
            }
            else{
                echo $deleteID;
            }
        
        }
}
?>