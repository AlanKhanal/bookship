<?php
    include '../private/selector.php';
    include '../private/Admin_register_BE.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | Admin Register</title>
</head>
<body>
    <!-- Heading -->
    <h3>Admin Register</h3>
    <!-- error-msg -->
    <div class="error"><?=$msg?></div>
    <!-- company-register-form -->
    <div class="" id="register-form">
        <form action="" method="POST">
<!-- adminName -->
            <label for="">Admin Username:</label>
            <input type="text" id="adminName" class="" name="adminName" placeholder="AtoZ0to9" required>
            <br>
<!-- password -->
            <label for="">Password</label>
            <input type="password" id="password" class="" name="password" placeholder=""required>
            <br>
<!-- confirm-password -->
            <label for="">Confirm Password</label>
            <input type="password" id="confirm-password" class="" name="confirm-password" required>
            <br>
<!-- company-name -->
            <label for="">Company Name</label>
            <input type="text" id="company-name" class="" name="company-name" required>
            <br>
<!-- company-address -->
            <label for="">Company Address</label>
            <input type="text" id="company-address" class="" name="company-address" required>
            <br>
<!-- company-mail -->
            <label for="">Company E-mail</label>
            <input type="email" id="company-mail" class="" name="company-mail" required>
            <br>
<!-- submission -->
            <input type="submit" value="Register" id="submit" class="" name="submit" >
        </form>
</div>
    <div>
        <a href="Admin_login.php">Got an account? Login!</a>
    </div>
    <div style="margin-top:30%">
        <a href="">AS user</a>
    </div>
</body>
</html>