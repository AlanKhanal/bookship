<?php
    include '../private/selector.php';
    include '../private/Admin_login_BE.php';
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
            <h4 class="login-sidetext">Welcome to Bookship</h4>
            <p class="smalltext">Login to start</p>
        </div>
        <div class="login-form">
            <form action="" method="POST">
                <label for="">Admin Name</label>
            <input type="text" id="adminName" class="input-class" name="adminName" >
            <br>
<!-- password -->
            <label for="">Password</label>
            <input type="password" id="password" class="input-class" name="password" >
            <br>
<!-- submission -->
            <div class=msg><?=$msg?></div>
            <input type="submit" id="submit" class="loginbtn" name="submit" value="Login">
            <div class="loginSignup">
                Create a new account
                <a href="Admin_register.php" class="login-signup">SignUp</a>
                </div>
            </form>
        </div>
</body>
</html>