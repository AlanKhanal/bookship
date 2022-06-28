<?php
    include '../private/selector.php';
    include '../private/Admin_register_BE.php';
    $msginfo="";
    if(isset($_REQUEST['set'])){
        $nub=$_REQUEST['set'];
        if($nub=='null'){
            $msginfo.="SIGNUP TO LOGIN";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | Admin Register</title>
    <link rel="stylesheet" href="../private/AdminRegLog.css">
</head>
<body>
<div class="signup-container">
            <div class="signup-text">
                <h4 class="signup-sidetext">BOOKSHIP | SIGNUP</h4>
            </div>


            <div class="signup-form">
                <form action="" method="POST">
                    <label for="">USERNAME</label><br>
                    <input type="text" id="adminName" class="input-class" name="adminName" >
                    <br>

                    <!-- password -->
                    <label for="">PASSWORD</label><br>
                    <input type="password" id="password" class="input-class" name="password" placeholder="">
                    <br>

                    <!-- confirm-password -->
                    <label for="">CONFIRM PASSWORD</label>
                    <input type="password" id="confirm-password" class="input-class" name="confirm-password" >
                    <br>

                    <!-- company-name -->
                    <label for="">COMPANY NAME</label>
                    <input type="text" id="company-name" class="input-class" name="company-name" >
                    <br>

                    <!-- company-address -->
                    <label for="">ADDRESS</label>
                    <input type="text" id="company-address" class="input-class" name="company-address" >
                    <br>

                    <!-- company-mail -->
                    <label for="">E-MAIL</label><br>
                    <input type="email" id="company-mail" class="input-class" name="company-mail" >
                    <br>
                    <div class=msg><?=$msg?></div>
                    
                    <input type="submit" class="signupbtn" name="submit" value="SIGNUP">
                    <div style="font-size:1rem"><?php echo $msginfo; ?></div>
                </form>
            </div>
        </div>
</body>
</html>