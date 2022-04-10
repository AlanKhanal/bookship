<?php
include 'dbconnect.php';
if(isset($_GET['user'])){
    $userName=$_GET['user'];

    $query="SELECT `userName` FROM users WHERE `emailVerification`=0 AND `userName`='$userName'";
    $connectVerify = mysqli_query($conn,$query);
    if (mysqli_num_rows($connectVerify) >0){
        $update = "UPDATE users SET `emailVerification`=1 WHERE `userName`='$userName'";
        $connectVerify2=mysqli_query($conn,$update);
        if($connectVerify2){
            header('location:../public/User_Login.php');
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