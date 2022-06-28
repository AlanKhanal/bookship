<?php
    include '../private/selector.php';
    include '../private/Admin_login_BE.php';
    $checklog=mysqli_query($conn,"SELECT * FROM admins WHERE emailVerification=1 and adminStatus=1");
    if(mysqli_num_rows($checklog)<1){
        header("location:Admin_register.php?set=null");
    }
    $set=0;
    if(isset($_REQUEST['set'])){
        $set=$_REQUEST['set'];
        if($set=='reg'){
            $set=1;
        }
        else{
            $msg.="<b style='color:red'>ERROR FOUND</b>";
            $valid=false;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | Admin Login</title>

    <link rel="stylesheet" href="../private/AdminRegLog.css">
</head>
<body>
    <div class="login-container">
        <div class="login-text">
            <h3 class="login-sidetext">BOOKSHIP | LOGIN</h3>
            <!-- <p class="smalltext">LOGIN</p> -->
        </div>
        <div class="login-form">
            <div>
            <form action="" method="POST">
                <label for="">USERNAME</label>
            <input type="text" id="adminName" class="input-class" name="adminName" >
            <br>
<!-- password -->
            <label for="">PASSWORD</label>
            <input type="password" id="password" class="input-class" name="password" >
            <br>
<!-- submission -->
            <div class="msg"><?=$msg?></div>
            <input type="submit" id="submit" class="loginbtn" name="submit" value="LOGIN">
            </div>
            <br>
            <div class="loginSignup">
                <?php 
                $query44=mysqli_query($conn,"SELECT * FROM admins WHERE adminStatus=1 and emailVerification=1");
                if(mysqli_num_rows($query44)<1){
                ?>
                 Create a new account?
                <a href="Admin_register.php" class="login-signup">SignUp!</a><br><br>
                <?php
                }
                ?>
                <?php if($set==1){?>Already Registered  <?php } ?>
                <!-- <a href="../public/regSetting.php" class="login-signup">| Forgot Password?</a> -->

            </div>
            </form>
        </div>
</body>
</html>