<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        *{
            padding:0px;
            margin:0px;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

        }
        body{
            background:rgb(202, 205, 212);
        }
        .bottom{
            margin-top: 2rem;
            background-color: #20214a;
            display: flex;
            justify-content: space-around;
            border-top:5px solid #fa5012;
            border-bottom:5px solid #fa5012;
            padding-bottom: 1rem;

        }
        .bottom a{
            text-decoration: none;
            color:white;
            font-weight: 600;
            font-size: 16px;
            padding-left: 3px;
        }
        .bottom .cont{
            text-decoration: none;
            color:white;
            font-weight: 600;
            font-size: 16px;
            padding-left: 3px;
        }
        .boldy{
            color: #fa5012;
            font-size:20px;
            /* color: black; */
            font-weight: 700;
            padding-top:1rem;
        }
    </style>
</head>
<body>
    <div class="bottom">
            <?php
            include ('../private/dbconnect.php');
            $query = "SELECT * FROM admins";
            $run=mysqli_query($conn,$query);
            if (mysqli_num_rows($run) > 0){
                $row = mysqli_fetch_assoc($run);
                $adminID=$row['adminID'];
                $adminName=$row['adminName'];
                $adminEmail=$row['email'];
                $companyName=strtoupper($row['companyName']);
                $companyAddress=$row['companyAddress'];
            }
            ?>
       <div class="boldy">
            <?=$companyName?>
       </div>
       <div>
            <ul type=none>
                <li>
                    <div class="boldy">Quick Access</div>
                </li>
                <li>
                    <a href="collection.php">Collection</a>
                </li>
                <li>
                    <a href="newArrivals.php">New Arrivals</a>
                </li>
                <li>
                    <a href="cart.php">Cart</a>
                </li>
                <li>
                    <a href="wishlist.php">Wishlist</a>
                </li>
            </ul>
       </div>
       <div>
            <div class="boldy">Physical Store</div>
            <div class="cont">
                <div><?=$companyAddress?></div>
                <div><?=$companyName?></div>
                <div><?=$adminEmail?></div>
            </div>
       </div>
    </div>
    <div align="center" style="font-size:14px;padding:2px 5px;">
        <b>Developed by Bookship.</b>
    </div>
</body>
</html>