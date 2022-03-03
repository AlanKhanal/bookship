<?php
    include '../private/dbconnect.php';
    include '../private/adminheader.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile | Admin</title>
    <style>
        .profile{
            margin-top:1rem;
            display:flex;
            justify-content:space-around;
            font-size:25px;
        }
        .management{
            margin-top:1rem;
        }
        .head{
            text-align:center;
            font-weight:bold;
            font-size:50px;
        }
        .details{
            padding:20px;
            border:2px solid black;
            border-radius:15px;
            width:50%;
            height:100%;
        }
        .addition{
            text-align:center;
            display:flex;
            justify-content:space-around;
            
        }
    </style>
</head>
<body>
    <div class="profile">
        <div class=details>
            <div class=admindetails>
                <div class=head>Bookship</div>
                <div><b>Admin Details</b></div>
                Admin: XXXXXXXXXX <br>
                eSewa Name: <br>
                eSewa Number: <br>
            </div>
            <br><br>
            <div class=companydetails>
                <div><b>Company Details</b></div>
                Company Name: XXXXXXXXXX<br>
                Company Description: <br>
                Company Number: <br>
                Established Date:
            </div>
        </div>
        <div class=management>
            <div class=head>Manage Store</div>
            <div class=addition>
                <?php include '../private/management.php'; ?>
            </div>
        </div>
        
    </div>
    
</body>
</html>