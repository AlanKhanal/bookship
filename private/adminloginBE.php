<?php
     include 'dbconnect.php';
    $isvalid=true;
    if($_POST){
        $username = trim($_REQUEST['admin_username']);
        $password = $_REQUEST['admin_password'];
        
    if($username == ""){
        echo 'username empty'.'<br>';
        $isvalid=false;
    }
    if($password == ""){
        echo 'password empty'.'<br>';
        $isvalid=false;
    }            
    else if(strlen($password) < 8){
        echo 'Password must be more than 8 characters'.'<br>';
        $isvalid=false;
    }   
}
    if($_POST){
        if($isvalid){
            $adminrec="SELECT admin_username,admin_password FROM adminlogin WHERE admin_username='$username' and admin_password='$password'";
            $adminquery = mysqli_query($conn,$adminrec);
            $record = mysqli_num_rows($adminquery);
            if($record == 1){
                header("location:adminhome.php");
            }
            else{
                echo 'Username and Password not matched.';
            }
        } 
    }
?>