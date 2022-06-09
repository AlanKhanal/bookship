<?php 
include 'dbconnect.php';

$adminCheck=mysqli_query($conn,"SELECT * FROM admins");
        if(mysqli_num_rows($adminCheck)>=1){
            header("location:../public/Admin_login.php?set=reg");
        }

// this is Admin_register.php backend 
//taking data from Admin_register.php
$msg="";
$valid=true;
if(isset($_POST['submit'])){
    $adminName=trim($_REQUEST['adminName']);
    $password=$_REQUEST['password'];
    $confirmPassword=$_REQUEST['confirm-password'];
    $companyName=trim($_REQUEST['company-name']);
    $companyAddress=trim($_REQUEST['company-address']);
    $email=trim($_REQUEST['company-mail']);
    $uqid=uniqid();
    // adminName_validation
    if($adminName==""){
        $msg.="Please insert Admin name.<br>";
        $valid=false;
    }
    elseif(strlen($adminName)<6 || strlen($adminName)>50){
        $msg.="Admin name must be between 6 and 50 characters.<br>";
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
    
    // confirm-password validation
    if($confirmPassword!=$password){
        $msg.="Confirm Password didn't matched with password.<br>";
        $valid=false;
    }
    
    // company-name validation
    if($companyName==""){
        $msg.="Please insert companyName.<br>";
        $valid=false;
    }
    elseif(strlen($companyName)>250){
        $msg.="Company name can only be of 250 characters.<br>";
        $valid=false;
    }
    // company-address validation
    if($companyAddress==""){
        $msg.="Please insert companyAddress.<br>";
        $valid=false;
    }
    elseif(strlen($companyAddress)>300){
        $msg.="Company address can only be of 300 characters.<br>";
        $valid=false;
    }
    // company-email validation
    if($email==""){
        $msg.="Please insert email.<br>";
        $valid=false;
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg.= "Invalid email format.<br>";
        $valid=false;
      }

    //   dbcheck
    if($valid){
        $adminCheck=mysqli_query($conn,"SELECT * FROM admins");
        if(mysqli_num_rows($adminCheck)<1){
            $hash=password_hash($password,PASSWORD_DEFAULT);
            $insert=mysqli_query($conn,"INSERT INTO admins(`adminName`,`password`,`companyName`,`companyAddress`,`email`,`uniqueadmin`) 
            VALUES('$adminName','$hash','$companyName','$companyAddress','$email','$uqid')");
            //sendmail after success
            if($insert){
                $to=$email;
                $subject='E-mail Verification.';
                $message="Click the link to confirm your book store registration into bookship.
                        http://localhost:8081/bookship/private/user-mailVerification.php?uniqid=$uqid";
                $headers="alankhanal2001@gmail.com";
                $mail=mail($to,$subject,$message,$headers);
                //Get Verified
                if($mail){
                    header("location:../public/verify.php");
                }
                else{
                    $updateMail=mysqli_query($conn,"UPDATE admins SET emailVerification=1 WHERE uniqueadmin='$uqid'");
                    if($updateMail){
                        echo "Mail() function error. DIRECTLY verifying mail for demo purpose.";
                    }
                }
            }
        }
    }
}
?>
