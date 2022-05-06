<?php 
include 'dbconnect.php';

// this is User_register.php backend 
//taking data from User_register.php
$msg="";
$valid=true;
if(isset($_POST['submit'])){
    
    $userName=$_REQUEST['userName'];
    $password=$_REQUEST['password'];
    $confirmPassword=$_REQUEST['confirm-password'];
    $email=$_REQUEST['user-mail'];
    // userName_validation
    $userNamePattern="[^0-9A-Za-z]";
    $userNamePattern2="[^/A-Za-z0-9]";//actual pattern 
    if($userName==""){
        $msg.="Please insert User name.<br>";
        $valid=false;
    }
    elseif($userName!=trim($userName)){
        $msg.="Do not leave blank at start or end of User name.<br>";
        $valid=false;
    }
    elseif(strlen($userName)<6 || strlen($userName)>50){
        $msg.="User name must be between 6 and 50 characters.<br>";
        $valid=false;
    }
    elseif($userName!=preg_match($userNamePattern,$userName)){
        $msg.="User name need to start with alphabet.<br>";
        $valid=false;
    } 
    elseif($userName!=preg_match($userNamePattern2,$userName)){
            $msg.="User name requires only A-Z,a-z or 0-9.<br>"; 
            $valid=false; 
    }
    elseif($userName==strpos(trim($userName), ' ')){
        $msg.="username can only be of one word."; 
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
    elseif($email!=trim($email)){
        $msg.="Do not leave blank at start or end of email.<br>";
        $valid=false;
    }
}
if(isset($_POST['submit'])){
    $dbValid=true;
    if($valid){
        //send mail if already an user but not verified mail
        $checkQuery0="SELECT * FROM users WHERE `email`='$email' AND `emailVerification`=0";
        $run0 = mysqli_query($conn, $checkQuery0);
        $number_of_users0 = mysqli_num_rows($run0);
        if($number_of_users0==1){
            $dbValid=false;
            $to0=$email;
            $subject0='E-mail Verification.';
            $message0="Click the link to confirm your book store registration into bookship.
                    http://localhost:8081/bookship/private/user-mailVerification.php?user=$userName";
            $headers0="From:less.secure.email.for.students@gmail.com";
            // header("location:login.php");
            $mail0=mail($to0,$subject0,$message0,$headers0);
            if($mail0){
                header('location:verify.php');
                $dbValid=false;
            }
            else{
                $dbValid=false;
                $run_insertRegForm0=mysqli_query($conn,$insertRegForm0);
            }              
        }
        //check email from database
        $checkQuery="SELECT * FROM users WHERE `email`='$email' AND `emailVerification`=1";
        $run = mysqli_query($conn, $checkQuery);
        $number_of_users = mysqli_num_rows($run);
        if($number_of_users==1){
            //show error
            $msg.="Email already taken.<br>";
            $dbValid=false;                
        }
        //check userName from database
        $checkQuery2="SELECT * FROM `users` WHERE `userName`='$userName' AND `emailVerification`=1";
        $run2 = mysqli_query($conn, $checkQuery2);
        $number_of_users2 = mysqli_num_rows($run2);
        if($number_of_users2==1){
            //show error
            $msg.="Username already taken.<br>";
            $dbValid=false;                
        }
        if($dbValid){
            // insert into dabase

            $insertRegForm="INSERT INTO users(`userName`,`password`,`email`) VALUES('$userName','$password','$email')";
            $run_insertRegForm=mysqli_query($conn,$insertRegForm);
            if($run_insertRegForm){
                    $to=$email;
                    $subject='E-mail Verification.';
                    $message="Click the link to confirm your book store registration into bookship.
                            http://localhost:8081/bookship/private/user-mailVerification.php?user=$userName";
                    $headers="From:less.secure.email.for.students@gmail.com";
                    // header("location:login.php");
                    $mail=mail($to,$subject,$message,$headers);
                    if($mail){
                        header('location:verify.php');
                    }
                    else{
                        $run_insertRegForm=mysqli_query($conn,$insertRegForm);
                    }
                }
                else{
                    $msg.="If you didnot get mail.<br>1.Check if the mail inserted is correct.<br>2.Check spam folder.<br>";
                }
            }
        }
    }
?>