<?php
$delete="";
include ('../private/dbconnect.php');
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: user_login.php");
}
$user = $_SESSION['userName'];
$query = "SELECT * FROM users WHERE userName='$user'";
$run=mysqli_query($conn,$query);
if (mysqli_num_rows($run) > 0){
    $row = mysqli_fetch_assoc($run);
    $userID=$row['userID'];
    $userName=$row['userName'];
    $userEmail=$row['email'];

    // if(isset($_REQUEST['id'])){
    //     $pID=$_REQUEST['id'];
        $checkinOrders=mysqli_query($conn,"SELECT * FROM orders WHERE userID=$userID and productID=$pID and orderStatus=3");

        if(mysqli_num_rows($checkinOrders)>=1){
            $checkfeeds=mysqli_query($conn,"SELECT * FROM feedback WHERE userID=$userID and productID=$pID");
            if(mysqli_num_rows($checkfeeds)<4){
                $feedbackInsert=mysqli_query($conn,"INSERT INTO feedback(`userID`,`productID`,`feed`) VALUES($userID,$pID,'$feedback')");
            }
            else{
                $fMsg.="Feedback limit reached.";
            }
        }
        else{
            $fMsg.="Please purchase inorder to provide feedback.";
        }
    }
// }
// ?>