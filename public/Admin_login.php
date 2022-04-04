<?php
    include '../private/selector.php';
    include '../private/Admin_login_BE.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | Admin Login</title>
</head>
<body>
<!-- Heading -->
    <h3>Admin Login</h3>
<!-- error-msg -->
    <div class="error"><?=$msg?></div>
<!-- company-login-form -->
    <div class="" id="register-form">
        <form action="" method="POST">
<!-- adminName -->
            <label for="">Admin Name:</label>
            <input type="text" id="adminName" class="" name="adminName" >
            <br>
<!-- password -->
            <label for="">Password</label>
            <input type="password" id="password" class="" name="password" >
            <br>
<!-- submission -->
            <input type="submit" value="Login" id="submit" class="" name="submit" >
        </form>
    </div>
    <div>
        <a href="Admin_register.php">Don't have an account? Register!</a>
    </div>
</body>
</html>