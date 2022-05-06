<?php
    include '../private/selector.php';
    include '../private/Admin_register_BE.php';
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
                <h4 class="signup-sidetext">Welcome to Bookship</h4>
                <p class="smalltext">SignUp to start</p>
            </div>


            <div class="signup-form">
                <form action="" method="POST">
                    <label for="">Admin Username:</label>
                    <input type="text" id="adminName" class="input-class" name="adminName" >
                    <br>

                    <!-- password -->
                    <label for="">Password</label>
                    <input type="password" id="password" class="input-class" name="password" placeholder="">
                    <br>

                    <!-- confirm-password -->
                    <label for="">Confirm Password</label>
                    <input type="password" id="confirm-password" class="input-class" name="confirm-password" >
                    <br>

                    <!-- company-name -->
                    <label for="">Company Name</label>
                    <input type="text" id="company-name" class="input-class" name="company-name" >
                    <br>

                    <!-- company-address -->
                    <label for="">Company Address</label>
                    <input type="text" id="company-address" class="input-class" name="company-address" >
                    <br>

                    <!-- company-mail -->
                    <label for="">Company E-mail</label>
                    <input type="email" id="company-mail" class="input-class" name="company-mail" >
                    <br>
                <div class=msg><?=$msg?></div>
                            
                    <input type="submit" class="signupbtn" name="submit" value="Signup">

                    <div class="loginSignup">
                        Already hava an Account!
                        <a href="adminlogin.html" class="login-signup">Login</a>
                    </div>
                </form>
            </div>
        </div>
</body>
</html>