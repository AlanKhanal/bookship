<?php
    // include '../private/selector.php';
    include '../private/dbconnect.php';
    include '../private/User_register_BE.php';

?>
<?php
$getinfo=mysqli_query($conn,"SELECT * FROM admins WHERE adminStatus=1 and emailverification=1");
if(mysqli_num_rows($getinfo)<=0){
    header("location:maintain.php");
}
else{
    while($info=mysqli_fetch_assoc($getinfo)){
        $comp=strtoupper($info['companyName']);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$comp?> | Register</title>
    <style>
        *{
            padding:0px;
            margin: 0px;
            font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        body{
            background-image: url('../icon/bg.jfif');
            background-size: cover;
            backdrop-filter: blur(0.1rem);
        }
        .box{
            display: flex;
            justify-content: center;
            background-color:#20214a;
            text-align: center;
            /* position: absolute; */
            padding: 0.1rem;
            width:70%;
            height: auto;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
            margin-top: 5%;
            border-right: none;
            border-radius: 1rem;
            box-shadow: 5px 5px 80px lightyellow;
        }
        .head{
            font-size: 25px;
            font-weight: 600;
            padding: 5px;
            color: white;
        }
        
        .Box .form{
            margin-top:3rem;
            margin-bottom:3rem;
           width: 100%;
        }
        .Box .input{
            font-size: 24px;
            padding: 5px;
            border-radius: 0.4rem;
            width: 70%;
            margin: 0.2rem;
        }
        .Box label{
            color:white
        }
        .rBox{
            width: 55%;
            display: flex;
        }
        .lBox{
            width: 45%;
            font-size: 24px;
        }
        .rBox .rlBox{
            padding: 30% 0%;
            width: 30%;
            background-color:grey;
            font-size: 18px;
        }
        .rlBox div:hover{
            transform: scaleY(1.3);
        }
        .rlBox div a{
            text-decoration: none;
            color:white;
            font-weight: 500;
        }
        .rlBox div a:hover{
            color:grey;
        }
        .rlbox div{
            background-color: #20214a;
            padding: 5px;
            /* border-right: 2px solid white; */
            border-radius: 0.5rem;
        }
        .rBox .rrBox{
            width:70%;
            background:linear-gradient(90deg,#20214a,white);
        }
        .error{
            text-align: center;
            padding: 0.5rem 1rem;
            position:sticky;
            background-color: #20214a;
            color: red;
            position: fixed;
            top: 0;
            left: 0;
            font-size: 18px;
            border:2px solid red;
            border-left: 0px;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
        .submit{
            border: 0px;
            background-color: #fa5012;
            color:white;
            padding: 5px;
            font-weight: 600;
            font-size: 24px;
            border-radius: 0.4rem;
            width: 50%;
            margin: 0.2rem;
        }
        .submit:hover{
            transform: scaleX(1.1);
        }
        .rrBox,.rrBox img{
            border-top-right-radius:1rem;
            border-bottom-right-radius:1rem;
        }
    </style>
</head>
<body>
<?php 
// if($msg){ ?>
    <div class="error">
        <?=$msg?>
    </div>
    <div class="box">
        <div class="lBox">
            <div class="head"><h3><?=$comp?> | REGISTER</h3></div>
            <hr style="margin:0rem 1rem;">
            <div class="form">
            <form action="" method="POST">
        <!-- userName -->
                    <label for="">Username</label><br>
                    <input type="text" id="userName" class="input" name="userName" >
                    <br>
        <!-- password -->
                    <label for="">Password</label><br>
                    <input type="password" id="password" class="input" name="password" >
                    <br>
        <!-- confirm-password -->
                    <label for="">Confirm Password</label><br>
                    <input type="password" id="confirm-password" class="input" name="confirm-password" >
                    <br>
        <!-- usermail -->
                    <label for="">Mail</label><br>
                    <input type="email" id="user-mail" class="input" name="user-mail" >
                    <br>
                    <div class="error"><?=$msg?></div> 
        <!-- submission -->
                    <input type="submit" value="Register" id="submit" class="submit" name="submit" >
                </form>
            </div>
        </div>
        <div class="rBox">
            <div class="rlBox">
                <div><a href="User_home.php">VISIT</a></div>
                <br>
                <div><a href="User_login.php">LOGIN</a></div>
                <br>
                <div><a href="User_register.php">REGISTER</a></div>
            </div>
            <div class="rrBox">
                <img src="../icon/yead.png" width="150%" height="100%" alt="">
            </div>
        </div>
    </div>
</body>
</html>