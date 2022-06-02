<?php
// echo"To=".$to0="alankhanal2001@gmail.com";
// echo "<br>";
// echo"Subject=".$subject0='E-mail Verification.';
// echo "<br>";
// echo "Message=".$message0="Click the link to confirm your book store registration into bookship.
//         http://localhost:8081/bookship/private/user-mailVerification.php?user=alan";
// echo "<br>";
// echo"header=".$headers0="alankhanal2001@gmail.com";
// // header("location:login.php");
$mail0=mail('alankhanal2001@gmail.com','mail verf','message123','header');
if($mail0){
    echo "Success";
    // $dbValid=false;
}
else{
echo "<br>";
echo "<br>";
echo "Final message=not succeed";
    // $dbValid=false;
    // $run_insertRegForm0=mysqli_query($conn,$insertRegForm0);
}  
?>