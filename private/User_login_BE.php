<?php
include 'dbconnect.php';
//Session start
session_start();
// check if the user is already logged in
if(isset($_SESSION['userID'])){
    // header("location:User_home.php");
    // exit;
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
        // $sql="SELECT * from users WHERE adminName='$adminName' and `emailVerification`=1 and `adminStatus`=1";
        //     $result=mysqli_query($conn,$sql);
        //     $num=mysqli_num_rows($result);
        //     if($num==1){
        //         while($row=mysqli_fetch_assoc($result)){
        //             if(password_verify($password,$row['password'])){
        //                 $uqid=$row['uniqueadmin'];
        //                 $adminID=$row['adminID'];
        //                 session_start();
        //                 $_SESSION['loggedIn']=true;
        //                 // $login=true;
                        
        //                 $_SESSION["uniqueadmin"] = $uqid;
        //                 $_SESSION["adminName"] = $adminName;
        //                 $_SESSION["loggedin"] = true;
        //                 $_SESSION["adminID"]=$adminID;
        //                 $adminID=$row['adminID'];
        //                 header("location:../public/Admin_home.php");
        //             }    
        //             else{
        //                 $msg.="Password didn't matched.";
        //             }
        //         }
        //     }
        //     else{
        //         $msg.="Username not found.";
        //     }
        //check if user is registered
        $userCheck="SELECT * FROM users WHERE `userName`='$userName' AND `emailVerification`=1 AND `userStatus`=1";
        $check1 = mysqli_query($conn, $userCheck);
        $num1 = mysqli_num_rows($check1);
        if($num1<1){
            $msg.= 'Username not found.';
            $valid=false;
        }
        elseif($num1==1){
            while($get=mysqli_fetch_assoc($check1)){
                if(password_verify($password,$get['password'])){
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
                                $msg.= 'verify login in email.';
                            }
                            $_SESSION["userID"]=$userID;
                            header("location:User_home.php");
                }
                else{
                    $msg.="Password didn't matched";
                }
            }
            
            // session_start();
            // $_SESSION["userName"] = $userName;
            // $_SESSION["loggedin"] = true;
            // $query="SELECT `userID` FROM users where userName='$userName' AND `emailVerification`=1 AND `userStatus`=1";
            // $run=mysqli_query($conn,$query);
            // if (mysqli_num_rows($run) > 0){
            //     $row = mysqli_fetch_assoc($run);
            //     $userID=$row['userID'];
            // }
            // else{
            //     $msg.= 'verify login in email.';
            // }
            // $_SESSION["userID"]=$userID;
            // // $msg.= $id;
            // header("location:User_home.php");
        }
    }
}
?>