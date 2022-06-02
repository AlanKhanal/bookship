<?php
    // include '../private/selector.php';
    include '../private/User_register_BE.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | user Register</title>
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
            width: 50%;
            border-radius: 10px;
        }
        input{
            font-size: 24px;
            margin:1rem;
            padding:2px 5px;
            /* width: 50%; */
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
            <!-- company-register-form -->
            <div class="" id="register-form">
            <h1>USER REGISTER</h1>
                <form action="" method="POST">
        <!-- userName -->
                    <label for="">Username</label><br>
                    <input type="text" id="userName" class="input" name="userName" required style="background-color:grey;color:white">
                    <br>
        <!-- password -->
                    <label for="">Password</label><br>
                    <input type="password" id="password" class="input" name="password" placeholder=""required style="background-color:grey;color:white">
                    <br>
        <!-- confirm-password -->
                    <label for="">Confirm Password</label><br>
                    <input type="password" id="confirm-password" class="input" name="confirm-password" required style="background-color:grey;color:white">
                    <br>
        <!-- usermail -->
                    <label for="">Mail</label><br>
                    <input type="email" id="user-mail" class="input" name="user-mail" style="background-color:grey;color:white" required>
                    <br>
                    <div class="error"><?=$msg?></div> 
        <!-- submission -->
                    <input type="submit" value="Register" id="submit" class="" name="submit" >
                </form>
            <a href="user_login.php" style="color:white">Got an account? Login!</a>

        </div>
        <div>
        </div>
    </div>
</body>
</html>