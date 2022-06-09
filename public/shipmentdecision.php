<?php
include ('../private/dbconnect.php');
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: Admin_login.php");
}
$admin = $_SESSION['adminName'];
$query = "SELECT * FROM admins WHERE adminName='$admin'";
$run=mysqli_query($conn,$query);
if (mysqli_num_rows($run) > 0){
    $row = mysqli_fetch_assoc($run);
    $adminID=$row['adminID'];
    $adminName=$row['adminName'];
    $adminEmail=$row['email'];
    $companyName=$row['companyName'];
    $companyAddress=$row['companyAddress'];
}
// all check
if(isset($_REQUEST['oID']) && isset($_REQUEST['des'])){
    $id=$_REQUEST['oID'];
    $desc=$_REQUEST['des'];
    if($id=='all' && $desc==1){
        if(isset($_REQUEST['fil'])){
            $fil=$_REQUEST['fil'];
            if($fil=='null'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=1 WHERE orderStatus=0");
            }
            elseif($fil=='latest'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=1 WHERE orderStatus=0");
            }
            elseif($fil=='oldest'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=1 WHERE orderStatus=0");
            }
            elseif($fil=='esewa'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=1 WHERE orderStatus=0 and method='esewa'");
            }
            elseif($fil=='cash'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=1 WHERE orderStatus=0 and method='cash'");
            }
            elseif($fil==''){
                echo 'ERROR';
            }
            else{
              echo 'ERROR';  
            }
        }
    }
    elseif($id=='all' && $desc=='cancel'){
        if(isset($_REQUEST['fil'])){
            $fil=$_REQUEST['fil'];
            if($fil=='null'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=2 WHERE orderStatus=0");
            }
            elseif($fil=='latest'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=2 WHERE orderStatus=0");
            }
            elseif($fil=='oldest'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=2 WHERE orderStatus=0");
            }
            elseif($fil=='esewa'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=2 WHERE orderStatus=0 and method='esewa'");
            }
            elseif($fil=='cash'){
               $query=mysqli_query($conn,"UPDATE orders SET orderStatus=2 WHERE orderStatus=0 and method='cash'");
            }
            elseif($fil==''){
                echo 'ERROR';
            }
            else{
                echo 'ERROR';  
            }
        }
    }
    elseif($id!='' && $id!='all' && $desc==1){
       $query=mysqli_query($conn,"UPDATE orders SET orderStatus=1 WHERE orderStatus=0 and uniqueorder='$id'");
    }
    elseif($id!='' && $id!='all' && $desc=='cancel'){
        $query=mysqli_query($conn,"UPDATE orders SET orderStatus=2 WHERE orderStatus=0 and uniqueorder='$id'");
     }
    
}
?>