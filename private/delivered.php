<?php

include('../private/dbconnect.php');
if(isset($_REQUEST['id'])){
    $id=$_REQUEST['id'];
}
$query=mysqli_query($conn,"UPDATE orders set orderStatus=3 WHERE uniqueorder=$id");
if($query){
    header("location:../public/deliverycheckpage.php");
}
?>