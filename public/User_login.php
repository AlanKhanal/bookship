<?php
    // include '../private/selector.php';
    include '../private/User_login_BE.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<!-- Heading -->
    <h3>User Login</h3>

<!-- company-login-form -->
    <div class="" id="register-form">
        <form action="" method="POST">
<!-- adminName -->
            <label for="">Username</label>
            <input type="text" id="userName" class="" name="userName" >
            <br>

<!-- password -->
            <label for="">Password</label>
            <input type="password" id="password" class="" name="password" >
            <br>

<!-- error message -->
            <div class="error"><?=$msg?></div>

<!-- submission -->
            <input type="submit" value="Login" id="submit" class="" name="submit" >
        </form>
    </div>
    <div>
        <a href="User_register.php">Don't have an account? Register!</a>
    </div>
</body>
</html>