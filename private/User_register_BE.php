<?php 
include 'dbconnect.php';

$msg="";
// this is User_register.php backend 
//taking data from User_register.php
$valid=true;
if(isset($_POST['submit'])){
    $userName=trim($_REQUEST['userName']);
    $password=$_REQUEST['password'];
    $confirmPassword=$_REQUEST['confirm-password'];
    $email=trim($_REQUEST['user-mail']);
    // userName_validation 
    if($userName==""){
        $msg.="Please insert Username.<br>";
        $valid=false;
    }
    elseif(strlen($userName)<6 || strlen($userName)>50){
        $msg.="User name must be between 6 and 50 characters.<br>";
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
    
    // user-email validation
    if($email==""){
        $msg.="Please insert email.<br>";
        $valid=false;
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg.= "Invalid email format.<br>";
        $valid=false;
      }
      if($valid){
        $userCheck=mysqli_query($conn,"SELECT * FROM users WHERE userName='$userName' AND emailverification=1 AND userStatus=1");
        if(mysqli_num_rows($userCheck)<1){
            $userCheck2=mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND emailverification=1 AND userStatus=1");
            if(mysqli_num_rows($userCheck2)<1){
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $insert=mysqli_query($conn,"INSERT INTO users(`userName`,`password`,`email`) 
                VALUES('$userName','$hash','$email')");
                //sendmail after success
                if($insert){
                    $to=$email;
                    $subject='E-mail Verification.';
                    $message="Click the link to confirm your book store registration into bookship.
                            http://localhost:8081/bookship/private/user-mailVerification.php?uniqid=$hash";
                    $headers="alankhanal2001@gmail.com";
                    $mail=mail($to,$subject,$message,$headers);
                    //Get Verified
                    if($mail){
                        header("location:../public/verify.php");
                    }
                    else{
                        $updateMail=mysqli_query($conn,"UPDATE users SET emailVerification=1 WHERE userName='$userName' AND email='$email'");
                        if($updateMail){
                            $msg.= "Mail() function error. DIRECTLY verifying mail for demo purpose.";
                        }
                    }
            }
        }
        else{
            $msg.= "Email already exists.";
        }
    }
        else{
            $msg.= "USERNAME EXISTS";
        }
      }
    }
?>