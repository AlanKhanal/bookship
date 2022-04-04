<?php
include 'dbconnect.php';
//Session start
session_start();
// check if the user is already logged in
if(isset($_SESSION['adminID'])){
    header("location:Admin_home.php");
    exit;
}

//validationCheck
$msg="";
$valid=true;
if(isset($_POST['submit'])){
    $adminName=trim($_REQUEST['adminName']);
    $password=trim($_REQUEST['password']);
    //adminName validation
    if($adminName==""){
        $msg.="Please insert Admin name.<br>";
        $valid=false;
    }
    // password validation
    if($password==""){
        $msg.="Please insert password.<br>";
        $valid=false;
    }
    elseif(strlen($password)<6 || strlen($password)>100){
        $msg.="Password must be between 6 and 100 characters.<br>";
        $valid=false;
    }

    if($valid){
        //check if user is registered
        $adminCheck="SELECT * FROM admins WHERE `adminName`='$adminName' AND `password`='$password' AND `emailVerification`=1 AND `adminStatus`=1";
        $check1 = mysqli_query($conn, $adminCheck);
        $num1 = mysqli_num_rows($check1);
        if($num1<1){
            echo '<div class="error">Admin Name and Password not matched.</div>';
            $valid=false;
        }
        elseif($num1==1){
            session_start();
            $_SESSION["adminName"] = $adminName;
            $_SESSION["loggedin"] = true;
            $query="SELECT `adminID` FROM admins where adminName='$adminName' AND `emailVerification`=1 AND `adminStatus`=1";
            $run=mysqli_query($conn,$query);
            if (mysqli_num_rows($run) > 0){
                $row = mysqli_fetch_assoc($run);
                $adminID=$row['adminID'];
            }
            else{
                echo 'verify login in email.';
            }
            $_SESSION["adminID"]=$adminID;
            // echo $id;
            header("location:Admin_home.php");
            }
    }
}
?>