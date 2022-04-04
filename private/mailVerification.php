<?php
include 'dbconnect.php';
if(isset($_GET['admin'])){
    $adminName=$_GET['admin'];

    $query="SELECT `adminName` FROM admins WHERE `emailVerification`=0 AND `adminName`='$adminName'";
    $connectVerify = mysqli_query($conn,$query);
    if (mysqli_num_rows($connectVerify) >0){
        $update = "UPDATE admins SET `emailVerification`=1 WHERE `adminName`='$adminName'";
        $connectVerify2=mysqli_query($conn,$update);
        if($connectVerify2){
            header('location:../public/Admin_Login.php');
        }
    }
    else{
        echo "NOT FOUND";
    }
}
else{
    echo "ERROR";
}
?>