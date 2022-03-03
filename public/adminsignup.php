
<!DOCTYPE html>
<html>
<head>
    <title>Bookship-Sign Up</title>
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
    <a href="adminlogin.php">Login</a>
    </div>
    <div class="signup-body">
        <div class="images">
            <img src="../images/signup.png">
        </div>
        <div class="error">
            
           <?php include '../private/adminsignupBE.php';?>
        </div>
        <div class="adminsignup-form">
            
            <form action = "" method = "POST">
                <fieldset>
                <div class=legend>ADMIN SIGNUP</div>
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
                        <td><label for="admin_confPassword">Confirm Password:</label><br>
                            <input type="password" id="admin-confPassword" name="admin_confPassword" ></td>
                        
                    </tr>
                    <tr>
                        <td><label for="admin_companyName">Company Name:</label><br>
                            <input type="text" id="admin_companyName" name="admin_companyName" ></td>
                     
                    </tr>
                    <tr>
                        <td><label for="admin_companyAddress">Company Address:</label><br>
                            <input type="text" id="admin_companyAddress" name="admin_companyAddress" ></td>
                     
                    </tr>
                    <!--<tr>
                        <td><label for="admin_companyDetails">Company Details:</label><br>
                            <input type="text" id="admin_companyDetails" name="admin_companyDetails" ></td>
                        <td><span id="cderror" class="error"></span><br></td>
                    <td> <span id="usererror" class="error"></span><br></td>
                        <td><span id="passerror" class="error"></span><br></td>
                        <td><span id="cpasserror" class="error"></span><br></td>
                        <td><span id="cnerror" class="error"></span><br></td>
                        <td><span id="caerror" class="error"></span><br></td>
                        <td><span id="estderror" class="error"></span><br></td>
                        <td><span id="tnaerror" class="error"></span><br></td>
                        <td><span id="tnuerror" class="error"></span><br></td>-->
                    </tr>
                    <tr>
                        <td><label for="admin_transactionName">eSewa Transaction Name:</label><br>
                            <input type="text" id="admin_transactionName" name="admin_transactionName" ></td>
                      
                    </tr>
                    <tr>
                        <td><label for="admin_transactionNumber">eSewa Transaction Number:</label><br>
                            <input type="text" id="admin_transactionNumber" name="admin_transactionNumber" ></td>
                      
                    </tr>
                    <tr>
                        <td><label for="admin_estdDate">Company Established Date:</label><br>
                            <input type="date" id="admin_estdDate" name="admin_estdDate" ></td>
                    </tr>
                    <tr>
                        <td><input type="submit"></td>
                    </tr>
                </table>            
                </fieldset>
            </form>
        </div>
        
    </div>
    
</body>
</html>