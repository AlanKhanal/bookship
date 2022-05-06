<?php
    // include '../private/selector.php';
    include '../private/User_register_BE.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | user Register</title>
</head>
<body>
    <!-- Heading -->
    <h3>User Register</h3>
    <!-- error-msg -->
    <div class="error"><?=$msg?></div>
    <!-- company-register-form -->
    <div class="" id="register-form">
        <form action="" method="POST">
<!-- userName -->
            <label for="">Username:</label>
            <input type="text" id="userName" class="" name="userName" required>
            <br>
<!-- password -->
            <label for="">Password</label>
            <input type="password" id="password" class="" name="password" placeholder=""required>
            <br>
<!-- confirm-password -->
            <label for="">Confirm Password</label>
            <input type="password" id="confirm-password" class="" name="confirm-password" required>
            <br>
<!-- usermail -->
            <label for="">Mail</label>
            <input type="email" id="user-mail" class="" name="user-mail" required>
            <br>
<!-- submission -->
            <input type="submit" value="Register" id="submit" class="" name="submit" >
        </form>
</div>
    <div>
        <a href="user_login.php">Got an account? Login!</a>
    </div>
    <div style="margin-top:30%">
        <a href="">AS admin</a>
    </div>
</body>
</html>