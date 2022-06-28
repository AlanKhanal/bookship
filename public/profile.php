
<?php
$msg="";
    include ('../private/dbconnect.php');
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location:User_login.php");
    }
    $user = $_SESSION['userName'];


    $query = "SELECT * FROM users WHERE userName='$user'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $userID=$row['userID'];
        $userName=$row['userName'];
        $userEmail=$row['email'];
    }
    else{
        header("location:User_login.php?set=0");
    }
    include("../private/User_nav.php");
?><!-- connect and navigation -->
<!-- fetch -->
<?php
if(isset($_REQUEST['updatePass'])){
    $name=$_REQUEST['username'];
    $mail=$_REQUEST['email'];
    $pValid=true;

    if($name==""){
        $msg.="Enter your username";
        $pValid=false;
    }
    if($mail==""){
        $msg.="Enter your email<br>";
        $pValid=false;
    }
    elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $msg.= "Invalid email format.<br>";
        $pValid=false;
    }

    // if($pValid){
    //     $change=mysqli_query($conn,"UPDATE users SET userName='$name' and email='$mail' WHERE email='$userEmail' and emailVerification=1");
    // }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile | <?=$userName?> </title>
    <style>
        *{
            margin:0px;
            padding:0px;
        }
        body{
            background:rgb(202, 205, 212);
        }
        .menu{
            margin-top: 2rem;
            right:0;
            height:355px;
            width:240px;
            background-color: #20214a;
            border: 3px solid #fa5012 ;
            border-left: none;
            border-top-right-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }
        .menu div{
            padding-left: 1rem;
            padding-top: 1rem;
        }
        .menu div a{
            text-decoration: none;
            color:white;
            font-size: 20px;
        }
        .username .username2{
            text-decoration: none;
            font-size: 2rem;
            font-weight: 600;
            color: white;
        }

        #orders{
            margin-top: 3rem;
            margin-left: 3rem;
            margin-right:5rem;
        }
        .infoCh{
            margin: 0.5rem;
        }
        .infoInput{
            padding:0.5rem;
            font-size: 20px;
        }
        .infoInput .input{
            padding:1px 10px;
            font-size: 18px;
            border:2px solid coral;
            background-color: #fa5012;
            color: white;
        }
        .infoInput .input:hover{
            transform: scaleY(1.1);
            /* font-weight: 5; */
        }
        .infoInput input{
            padding:1px 10px;
            font-size: 18px;
            border:2px solid #20214a;
            background-color: white;
            border-radius: 5px;
        }
        .usermail{
            color: grey;
        }
        .headings{
            color:black;
            font-weight: 600;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div style="display:flex;">
        <!-- menu -->
        <div class="menu">
            <div class="username">
                <a href="profile.php" class="username2"><?=strtoupper($userName)?></a>
            </div>
            <div class="usermail">
                <?=$userEmail?>
            </div>
            <br>
            <div>
                <a href="orders.php">My orders</a>
            </div>
            <div>
                <a href="cart.php">My cart</a>
            </div>
            <div>
                <a href="wishlist.php">My wishlist</a>
            </div>
            <div>
                <a href="changepassword.php">Change password</a>
            </div>
            <div>
                <a href="User_logout.php">Logout</a>
            </div>
        </div>
        <!-- setting -->
        <div id="orders">
            <div class="headings">
                Personal Information
            </div>
            <hr>
            <div class="infoCh">
                    <table>
                        <form action="" method="POST">
                            <tr>
                                <td><div class="infoInput">Username:</div></td>
                                <td><div class="infoInput"><input type="text" name="username" value="<?=$userName?>"></div></td>
                            </tr>
                            <tr>
                                <td><div class="infoInput">Email:</div></td>
                                <td><div class="infoInput"><input type="email" name="email" value="<?=$userEmail?>"></div></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="infoInput" style="color:red"><?php echo $msg?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="infoInput"><input type="submit" Value="CHANGE INFORMATION" name="updatePass" class="input"></div>
                                </td>
                            </tr>
                            </form>
                        </table>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- </html>footer -->
<?php
    include('../public/User_footer.php');
?>
