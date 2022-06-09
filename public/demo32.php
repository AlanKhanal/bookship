<?php
$to="alankhanal2001@gmail.com";
$subject="E-mail Verification";
$message="SUUP";
// $headers="FROM:alankhanal2001@gmail.com";


if(mail($to,$subject,$message)){
    echo "nice";
}
else{
    echo "not nice";
}
?>