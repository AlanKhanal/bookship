<?php
include ('../private/dbconnect.php');
include('../private/admin-header-nav.php');


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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
    <style>
        input{
            margin-top: 10px;
            font-size: 16px;
            padding:2px 10px;
            border-radius: 5px;
            border:2px solid grey;
        }
        label{
            font-weight: 600;
            font-size: 16px;
            padding:2px 10px;
        }
        #headed{
            text-align: center;
            margin-bottom: 0rem;
        }
    </style>
</head>
<body>
    <div id="headed">
        <h1>EDIT INFORMATION</h1>
    </div>
    <div align=center>
        <form action="" method="POST">
<!-- adminName -->
            <!-- <label for="">Admin Username</label><br> -->
            <input type="text" id="adminName" class="" name="adminName" value="<?=$adminName?>" hidden>
            <br>
<br>
<!-- company-name -->
            <label for="">Company Name</label><br>
            <input type="text" id="company-name" class="" name="company-name" value="<?=$companyName?>" required>
            <br>
            <br>
<!-- company-address -->
            <label for="">Company Address</label><br>
            <input type="text" id="company-address" class="" name="company-address" value="<?=$companyAddress?>" required>
            <br>
            <br>
<!-- company-mail -->
            <!-- <label for="">Company E-mail</label><br> -->
            <input type="email" id="company-mail" class="" name="company-mail" value=<?=$adminEmail?> style="width:auto" hidden>
            <!-- <br> -->
            <!-- <br><br> -->
<!-- submission -->
            <input type="submit" value="Submit" id="submit" class="" name="submit" style="border:2px solid grey;background-color:black;color:white;">
        </form>
    </div>
</body>
</html>
<label for="" style="color:red">!! USERNAME AND EMAIL EDIT NOT AVAILABLE RIGHT NOW !!</label>

<?php
$msg="";
$valid=true;
if(isset($_POST['submit'])){
    $adminName2=$_REQUEST['adminName'];
    $companyName2=$_REQUEST['company-name'];
    $companyAddress2=$_REQUEST['company-address'];
    $valid=true;

    $adminNamePattern="[^0-9A-Za-z]";
    $adminNamePattern2="[^/A-Za-z0-9]";//actual pattern 
    if($adminName2==""){
        $msg.="Please insert Admin name.<br>";
        $valid=false;
    }
    elseif($adminName2!=trim($adminName2)){
        $msg.="Do not leave blank at start or end of Admin name.<br>";
        $valid=false;
    }
    elseif(strlen($adminName2)<6 || strlen($adminName2)>50){
        $msg.="Admin name must be between 6 and 50 characters.<br>";
        $valid=false;
    }
    elseif($adminName2!=preg_match($adminNamePattern,$adminName2)){
        $msg.="Admin name need to start with alphabet.<br>";
        $valid=false;
    } 
    elseif($adminName2!=preg_match($adminNamePattern2,$adminName2)){
            $msg.="Admin name requires only A-Z,a-z or 0-9.<br>"; 
            $valid=false; 
    }
    elseif($adminName2==strpos(trim($adminName2), ' ')){
        $msg.="Admin name can only be of one word."; 
        $valid=false; 
    }
    if($companyName2==""){
        $msg.="Company name cannot be empty"; 
        $valid=false; 
    }
    if($companyAddress2==""){
        $msg.="Company address cannot be empty"; 
        $valid=false; 
    }
    if($valid){
        $validBE=true;
        // $query2 = "SELECT * FROM admins WHERE adminName='$adminName2'";
        // $runquery2 = mysqli_query($conn,$query2);
        // if (mysqli_num_rows($runquery2) == 1){
        //     $msg.="Username already exists";
        //     $validBE=false;
        // }
        // $query4 = "SELECT * FROM admins WHERE companyName='$companyName2'";
        // $runquery4 = mysqli_query($conn,$query4);
        // if (mysqli_num_rows($runquery4) == 1){
        //     $msg.="Username already exists";
        //     $validBE=false;
        // }

        if($validBE){
                $updatequery00="UPDATE admins SET adminName='$adminName2',companyName='$companyName2',companyAddress='$companyAddress2' WHERE adminID=$adminID";
                $runquery00=mysqli_query($conn,$updatequery00);
                if($runquery00){
                    // header("location:Admin_changeInfo.php");
                }
        }
    }
}    
?>