<?php
    // include '../private/selector.php';
    include '../private/User_login_BE.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        #nav{
            display: flex;
            justify-content: space-between;
        }
        #nav a{
            text-decoration: none;
            color:white;
            padding: 1rem 1.5rem;
        }
        body{
            background-image: url("../icon/934061.jpg");
            background-repeat: no-repeat;
        }
        .body{
            margin-top: 6rem;
            margin:2rem;
            text-align: center;
        }
        #register-form{
            padding:5px;
            border: #ff3333;
            background-color: #ff3333;
            border-radius: 10px;
            margin:0% 25%;
            box-shadow:4px 2px white;
        }
        label{
            font-size: 24px;
            
        }
        .input{
            font-size: 24px;
            margin:1rem;
            padding:2px 5px;
            border-radius: 10px;
            width: 50%;
        }
        input{
            font-size: 24px;
            margin:1rem;
            padding:2px 5px;
            border-radius: 10px;
            
        }
        .error{
            color:yellow;
        }
    </style>
</head>
<body>
<div id="nav">
        <div>
            
        </div>
        <div>
        <a href="User_login.php">Login</a>
        <a href="User_register.php">Register</a>
        <a href="Admin_register.php">Admin</a>
        </div>
    </div>

<div class="body">
    <!-- Heading -->
    <!-- company-login-form -->
    <div class="" id="register-form">
        <h1 style="color:black">USER LOGIN</h1>

        <form action="" method="POST">
            <label for="">Username</label><br>
            <input type="text" id="userName" class="input" name="userName" style="background-color:grey;color:white;">
            <br>

            <label for="">Password</label><br>
            <input type="password" id="password" class="input" name="password" style="background-color:grey;color:white;">
            <br>

            <div class="error"><?=$msg?></div>

            <input type="submit" value="Login" id="submit" class="" name="submit">
        </form>
        <div>
            <a href="User_register.php" style="color:white">Don't have an account? Register!</a>
        </div>
    </div>
</div>
</body>
</html>