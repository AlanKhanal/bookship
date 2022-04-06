<?php

include 'dbconnect.php';

if(isset($_REQUEST['category'])){
    $delete=$_REQUEST['category'];
    $deleteQuery="UPDATE categories SET categoryStatus=0 WHERE `categoryName`='$delete'";
    $run=mysqli_query($conn,$deleteQuery);
    if($run){
        header('location:../public/Admin_category_management.php');
    }
}

?>