<?php
include '../private/admin-header-nav.php';
include '../private/dbconnect.php';

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
    <title>Change Password</title>
    <style>
        input{
            font-size: 16px;
            padding:2px 10px;
            border-radius: 5px;
            border:2px solid grey;
        }
        label{
            font-size: 16px;
            padding:2px 10px;
        }
        #pwchange{
            text-align: center;

        }
        #headed{
            text-align: center;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div id="headed"><h1>Change Password</h1></div>
    <div id="pwchange">
        <form action="" method="POST">
            <div>
                <label for="">Current Password</label><br>
                <input type="password" name="pass">
            </div>
            <br>
            <div>
                <label for="">New Password</label><br>
                <input type="password" name="newPassword">
                <br>
                <br>
                <label for="">Confirm New Password</label><br>
                <input type="password" name="confNewPassword">
            </div>
<br>
            <input type="submit" value="submit" name="submit" style="border:2px solid grey;background-color:black;color:white;">
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit'])){
    $password=$_REQUEST['pass'];
    $newPassword=$_REQUEST['newPassword'];
    $confnewPassword=$_REQUEST['confNewPassword'];
    $pValid=true;

    if($password==""){
        echo 'Enter your recent password.<br>';
        $pValid=false;
    }
    else if(strlen($password)<6 || strlen($password)>255){
        echo 'Password length must be greated than 6.<br>';
        $pValid=false;
    }
    if($newPassword==""){
        echo 'Enter your new password.<br>';
        $pValid=false;
    }
    else if(strlen($newPassword)<6 || strlen($newPassword)>255){
        echo 'Password length must be greated than 6.<br>';
        $pValid=false;
    }
    if($confnewPassword==""){
        echo 'Confirm your new password';
        $pValid=false;
    }
    else if(strlen($confnewPassword)<6 || strlen($confnewPassword)>255){
        echo 'Password length must be greated than 6.<br>';
        $pValid=false;
    }
    else if($confnewPassword != $newPassword){
        echo 'Confirmed password did not matched.<br>';
        $pValid=false;
    }
    if($pValid){
        $searchQuery="SELECT * FROM admins WHERE adminID=$adminID";
        $runsearchQuery=mysqli_query($conn,$searchQuery);
        if(password_verify($password,$row['password'])){
            if(mysqli_num_rows($runsearchQuery)==1){
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $update="UPDATE admins SET `password`='$hashed' WHERE adminID=$adminID";
                $run2=mysqli_query($conn,$update);
                if($run2){
                    header('location:../private/Admin-logout.php');
                }
                else{
                    echo 'Failed to change password. ;(<br>';
                }
        }
        else{
            echo 'Incorrect password. Forgot password?<br>';
        }
    }
}
}
?>
