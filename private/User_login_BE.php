<?php
include 'dbconnect.php';
//Session start
session_start();
// check if the user is already logged in
if(isset($_SESSION['userID'])){
    header("location:User_home.php");
    exit;
}

//validationCheck
$msg="";
$valid=true;
if(isset($_POST['submit'])){
    $userName=trim($_REQUEST['userName']);
    $password=trim($_REQUEST['password']);
    //userName validation
    if($userName==""){
        $msg.="Please insert username.<br>";
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
        $userCheck="SELECT * FROM users WHERE `userName`='$userName' AND `password`='$password' AND `emailVerification`=1 AND `userStatus`=1";
        $check1 = mysqli_query($conn, $userCheck);
        $num1 = mysqli_num_rows($check1);
        if($num1<1){
            echo '<div class="error">Username and Password not matched.</div>';
            $valid=false;
        }
        elseif($num1==1){
            session_start();
            $_SESSION["userName"] = $userName;
            $_SESSION["loggedin"] = true;
            $query="SELECT `userID` FROM users where userName='$userName' AND `emailVerification`=1 AND `userStatus`=1";
            $run=mysqli_query($conn,$query);
            if (mysqli_num_rows($run) > 0){
                $row = mysqli_fetch_assoc($run);
                $userID=$row['userID'];
            }
            else{
                echo 'verify login in email.';
            }
            $_SESSION["userID"]=$userID;
            // echo $id;
            header("location:User_home.php");
            }
    }
}
?>