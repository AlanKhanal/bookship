
<!DOCTYPE html>
<html>
<head>
    <title>Bookship-Login</title>
    <style>
        *{
            font-family: "Goudy Bookletter 1911", sans-serif;;
            font-size:17px;
            margin: 2px 3px;
        }
        .nav{
            background:rgb(0, 64, 255);
            text-align:end;
            padding: 0.5% 1%;
            border-radius:5px;
        }
        a{
            text-decoration:none;
            color: white;
            font-weight:bold;

        }
        a:hover{
            color:black;
        }
        label{
            font-weight:bold;
        }
        input{
            padding-left:10px;
            border:2px solid black;

        }
        .signup-body{
            color:white;
            margin:2% 4%;
            display: flex;
            justify-content:space-between;
        }
        .images{
            width:50%;
            text-align:center;
        }
        .adminsignup-form{
           
        }
        fieldset{
            padding:25px;
            border:none;
            background:rgb(0, 64, 255,70%);
            box-shadow:0px 0px 5px rgb(0, 64, 255);
        }
        .legend{
            color:white;
            font-family:cursive;
            font-size: 24px;
            margin-bottom:5%;
            font-weight:bold;

        }
        .error{
            color:red;
            font-size:15px;
        }

    </style>
</head>
<body>
    <div class=nav>
    <a href="selectme.php">SelectMe</a>
    <a href="adminsignup.php">SignUp</a>
    </div>
    <div class="signup-body">
        <div class="images">
            <img src="../images/signup.png">
        </div>
        <div class="error">
           <?php include '../private/adminloginBE.php';?>
        </div>
        <div class="adminsignup-form">
            
            <form action = "" method = "POST">
                <fieldset>
                <div class=legend>ADMIN LOGIN</div>
                <table>
                    <tr>
                        <td><label for="admin_username">Username:</label><br>
                            <input type="text" id="admin-username" name="admin_username" ></td>
                        
                    </tr>
                    <tr>
                        <td><label for="admin_password">Password:</label><br>
                            <input type="password" id="admin-password" name="admin_password"></td>
                    </tr>
                    <tr>
                        <td><input type="submit"><br>
                    </tr>
                </table> 
                <i><a href="adminsignup.php" align=right>Sign Up?!</a>     </i>    
                </fieldset>
                
            </form>
            
        </div>
        
    </div>
    
</body>
</html>