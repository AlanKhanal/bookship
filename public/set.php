<?php
include ('../private/dbconnect.php');
// session_start();
// if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
// {
//     header("location: user_login.php");
// }
// $user = $_SESSION['userName'];
// $query = "SELECT * FROM users WHERE userName='$user'";
// $run=mysqli_query($conn,$query);
// if (mysqli_num_rows($run) > 0){
//     $row = mysqli_fetch_assoc($run);
//     $userID=$row['userID'];
//     $userName=$row['userName'];
//     $userEmail=$row['email'];
    
// // if(isset($_REQUEST['trsid'])){
// //     $uqid=$_REQUEST['trsid'];
// //     if(strlen($uqid)==0){
// //         header("location:User_home.php");
// //     }
// // }
// }
$getpro=mysqli_query($conn,"SELECT * FROM products WHERE productStatus=1");
if($getpro){
    if(($totRows=mysqli_num_rows($getpro)) > 0){
        while($Row32=mysqli_fetch_array($getpro)){
            $id=$Row32['productID'];
            $pqty=$Row32['productQty'];
            // in orders
            $getord=mysqli_query($conn,"SELECT distinct(productID) FROM orders WHERE productID=$id and userID=1");
            if($getord){
                if($totords=mysqli_num_rows($getord)>0){
                    while($Row33=mysqli_fetch_array($getord)){
                        $oid=$Row33['productID'];

                        $query34 = "SELECT * FROM orders WHERE userID=1 and productID=$oid";
                        $query_run = mysqli_query($conn,$query34);
                        $qty= 0;
                        while ($num = mysqli_fetch_assoc ($query_run)) {
                            $qty += $num['qty'];
                        }
                        // echo "$id has =".$qty." quantity<br>";
                        $update=mysqli_query($conn,"UPDATE products SET productQty=$pqty-$qty WHERE productID=$id");
                }
            }
        }
    }
}
}
// echo"T0=".$to0="alankhanal2001@gmail.com";
// echo "<br>";
// echo"Subject".$subject0='E-mail Verification.';
// echo "<br>";
// echo "Message=".$message0="Click the link to confirm your book store registration into bookship.
//         http://localhost:8081/bookship/private/user-mailVerification.php?user=alan";
// echo "<br>";
// echo"header=".$headers0="alankhanal2001@gmail.com";
// // header("location:login.php");
// $mail0=mail($to0,$subject0,$message0,$headers0);
// if($mail0){
//     echo "Success";
//     // $dbValid=false;
// }
// else{
// echo "<br>";
// echo "<br>";
// echo "Final message=not succeed";
//     // $dbValid=false;
//     // $run_insertRegForm0=mysqli_query($conn,$insertRegForm0);
// }  
?>