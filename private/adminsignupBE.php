<?php
     include 'dbconnect.php';
    $isvalid=true;
    if($_POST){
        $username = trim($_REQUEST['admin_username']);
        $password = $_REQUEST['admin_password'];
        $confPass = $_REQUEST['admin_confPassword'];
        $compName = trim($_REQUEST['admin_companyName']);
        $compAdd = trim($_REQUEST['admin_companyAddress']);
        $estd = trim($_REQUEST['admin_estdDate']);
        //$compDetails = trim($_REQUEST['admin_companyDetails']);
        $transName = trim($_REQUEST['admin_transactionName']);
        $transNumb = trim($_REQUEST['admin_transactionNumber']);

        
        
        $sq = "INSERT INTO adminlogin(`admin_username`,`admin_password`,`admin_companyName`,`admin_companyAddress`,`admin_transactionName`,`admin_transactionNumber`,`admin_estdDate`) 
        VALUES('$username','$password','$compName','$compAdd','$transName','$transNumb','$estd')";

        $admincheck="SELECT * FROM adminlogin WHERE admin_username='$username'";
        $check = mysqli_query($conn, $admincheck);
        $num = mysqli_num_rows($check);
        if($num>0){
            echo 'Username already taken<br>';
            $isvalid=false;
        }
        
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
        if($confPass ==""){
            echo 'Confirmed Password not matched'.'<br>';
            $isvalid=false;
        }
        else if($confPass != $password){
            echo 'Password not matched'.'<br>';
            $isvalid=false;
        }
        $admincheckcn="SELECT * FROM adminlogin WHERE admin_companyName='$compName'";
        $checkcn = mysqli_query($conn, $admincheckcn);
        $cn = mysqli_num_rows($checkcn);
        if($cn > 0){
            echo 'Company Name already exists.<br>';
            $isvalid=false;
        }
        if($compName==""){
            echo 'Fill company name'.'<br>';
            $isvalid=false;
        }
        if($compAdd==""){
            echo 'Fill company address'.'<br>';
            $isvalid=false;
        }
        //if($compDetails==""){
            //echo '<script>
                        //document.getElementById("cderror").innerHTML = "Company Details not filled.";
                    //</script>';
        //}
        if($transName==""){
            echo 'Fill eSewa Name'.'<br>';
            $isvalid=false;
        }
        if($transNumb==""){
            echo 'Fill eSewa Number<br>';
            $isvalid=false;
        }
        $adminchecknumb="SELECT * FROM adminlogin WHERE admin_transactionNumber='$transNumb'";
        $checknumb = mysqli_query($conn,$adminchecknumb);
        $numb = mysqli_num_rows($checknumb);
        if($numb >0){
            echo 'Phone number already exist.<br>';
            $isvalid=false;
        }
        if($estd==""){
            echo 'Fill company established date'.'<br>';
            $isvalid=false;
        }
        
}   

if($_POST){
    if($isvalid){
        $record = mysqli_query($conn,$sq);
        if($record){
            header("location:adminlogin.php");
        }
    } 
}

?>