<?php 
include 'dbconnect.php';

// this is Admin_register.php backend 
//taking data from Admin_register.php
$msg="";
$valid=true;
if(isset($_POST['submit'])){
    
    $adminName=$_REQUEST['adminName'];
    $password=$_REQUEST['password'];
    $confirmPassword=$_REQUEST['confirm-password'];
    $companyName=$_REQUEST['company-name'];
    $companyAddress=$_REQUEST['company-address'];
    $email=$_REQUEST['company-mail'];
    // adminName_validation
    $adminNamePattern="[^0-9A-Za-z]";
    $adminNamePattern2="[^A-Za-z0-9]";//actual pattern 
    if($adminName==""){
        $msg.="Please insert Admin name.<br>";
        $valid=false;
    }
    elseif($adminName!=trim($adminName)){
        $msg.="Do not leave blank at start or end of Admin name.<br>";
        $valid=false;
    }
    elseif(strlen($adminName)<6 || strlen($adminName)>50){
        $msg.="Admin name must be between 6 and 50 characters.<br>";
        $valid=false;
    }
    elseif($adminName!=preg_match($adminNamePattern,$adminName)){
        $msg.="Admin name need to start with alphabet.<br>";
        $valid=false;
    } 
    elseif($adminName!=preg_match($adminNamePattern2,$adminName)){
            $msg.="Admin name requires only A-Z,a-z or 0-9.<br>"; 
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
    elseif($companyName!=trim($companyName)){
        $msg.="Do not leave blank at start or end of company name.<br>";
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
    elseif($companyAddress!=trim($companyAddress)){
        $msg.="Do not leave blank at start or end of company address.<br>";
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
    elseif($email!=trim($email)){
        $msg.="Do not leave blank at start or end of email.<br>";
        $valid=false;
    }
}
if(isset($_POST['submit'])){
    $dbValid=true;
    if($valid){
        //send mail if already an admin but not verified mail
        $checkQuery0="SELECT * FROM admins WHERE `email`='$email' AND `emailVerification`=0";
        $run0 = mysqli_query($conn, $checkQuery0);
        $number_of_users0 = mysqli_num_rows($run0);
        if($number_of_users0==1){
            $dbValid=false;
            $to0=$email;
            $subject0='E-mail Verification.';
            $message0="Click the link to confirm your book store registration into bookship.
                    http://localhost:8081/bookship/private/mailVerification.php?admin=$adminName";
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
        $checkQuery="SELECT * FROM admins WHERE `email`='$email' AND `emailVerification`=1";
        $run = mysqli_query($conn, $checkQuery);
        $number_of_users = mysqli_num_rows($run);
        if($number_of_users==1){
            //show error
            $msg.="Email already taken.<br>";
            $dbValid=false;                
        }
        //check adminName from database
        $checkQuery2="SELECT * FROM `admins` WHERE `adminName`='$adminName' AND `emailVerification`=1";
        $run2 = mysqli_query($conn, $checkQuery2);
        $number_of_users2 = mysqli_num_rows($run2);
        if($number_of_users2==1){
            //show error
            $msg.="Username already taken.<br>";
            $dbValid=false;                
        }
        //check company name from database
        $checkQuery3="SELECT * FROM `admins` WHERE `companyName`='$companyName' AND `emailVerification`=1";
        $run3 = mysqli_query($conn, $checkQuery3);
        $number_of_users3 = mysqli_num_rows($run3);
        if($number_of_users3==1){
            //show error
            $msg.="Company Name already taken.<br>";
            $dbValid=false;                
        }
        if($dbValid){
            // insert into dabase

            $insertRegForm="INSERT INTO admins(`adminName`,`password`,`email`,`companyName`,`companyAddress`) VALUES('$adminName','$password','$email','$companyName','$companyAddress')";
            $run_insertRegForm=mysqli_query($conn,$insertRegForm);
            if($run_insertRegForm){
                    $to=$email;
                    $subject='E-mail Verification.';
                    $message="Click the link to confirm your book store registration into bookship.
                            http://localhost:8081/bookship/private/mailVerification.php?admin=$adminName";
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