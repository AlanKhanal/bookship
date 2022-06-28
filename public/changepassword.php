
<?php
$msg="";
    include ('../private/dbconnect.php');
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location:User_login.php");
    }
    $user = $_SESSION['userName'];

    include("../private/User_nav.php");


    $query = "SELECT * FROM users WHERE userName='$user'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $userID=$row['userID'];
        $userName=$row['userName'];
        $userEmail=$row['email'];
    }
    else{
    }
?><!-- connect and navigation -->
<!-- fetch -->
<?php
if(isset($_REQUEST['updatePass'])){
    $password=$_REQUEST['pass'];
    $newPassword=$_REQUEST['newPassword'];
    $pValid=true;

    if($password==""){
        $msg.='Enter your current password.<br>';
        $pValid=false;
    }
    else if(strlen($password)<6 || strlen($password)>255){
        $msg.='Password length must be greated than 6.<br>';
        $pValid=false;
    }
    if($newPassword==""){
        $msg.='Enter your new password.<br>';
        $pValid=false;
    }
    else if(strlen($newPassword)<6 || strlen($newPassword)>255){
        $msg.='Password length must be greater than 6.<br>';
        $pValid=false;
    }

    if($pValid){
        // echo "sss";
        $searchQuery="SELECT * FROM users WHERE `userID`=$userID and `password`='$password'";
        $runsearchQuery=mysqli_query($conn,$searchQuery);
        // if(password_verify($password,$row['password'])){
            if(mysqli_num_rows($runsearchQuery)==1){
                // $hashed = password_hash($password, PASSWORD_DEFAULT);
                $update2="UPDATE users SET `password`='$newPassword' WHERE `userID`=$userID";
                $run32=mysqli_query($conn,$update2);
                if($run32){
                    header('location:profile.php');
                }
                else{
                    $msg.= 'Failed to change password.<br>';
                }
        }
        else{
            // echo 'Incorrect password. Forgot password?<br>';
        }
    // }
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile | Change Password </title>
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
                <a href="profile.php">Change password</a>
            </div>
            <div>
                <a href="User_logout.php">Logout</a>
            </div>
        </div>
        <!-- setting -->
        <div id="orders">
            <div class="headings">
                Change Password
            </div>
            <hr>
            <div class="infoCh">
                    <table>
                        <form action="" method="POST">
                            <!-- <th>
                                <td><div class="infoInput"><b>CHANGE PASSWORD</b></div></td>
                            </th> -->
                            <tr>
                                <td><div class="infoInput">Current password:</div></td>
                                <td><div class="infoInput"><input type="password" name="pass"></div></td>
                            </tr>
                            <tr>
                                <td><div class="infoInput">New password:</div></td>
                                <td><div class="infoInput"><input type="password" name="newPassword"></div></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="infoInput" style="color:red"><?php echo $msg?></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="infoInput"><input type="submit" Value="CHANGE PASSWORD" name="updatePass" class="input"></div>
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
