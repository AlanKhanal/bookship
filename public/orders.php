<?php
$msg="";
include ('../private/dbconnect.php');
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: user_login.php");
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
include('../private/User_nav.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bookship | My Orders</title>
    <style>
        #orderBody{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        #placed,#ship{
        text-align: center;
        margin:1rem;
        }
        #orderBody table{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        #orderBody th{
            padding:0.5rem 1rem;
            background-color: #00cc99;
        }
        #orderBody td{
            padding:0.5rem 1rem;
            background-color: whitesmoke;
        }
        .data:hover{
            transform: scaleX(1.2);
        }
        #orderBody td a{
           text-decoration: none;
           color:black;
           text-decoration: underline; 
        }
    </style>
</head>
<body>
    <div style="margin:1rem 1rem;color:#20214a">
        <h1>MY ORDERS</h1>
        <hr>
    </div>
    <div id="orderBody">
        
        <!-- placed -->
        <div id="placed">
            <div style="display:flex;justify-content:space-between">
                <h2>PLACED</h2>
                <h4></h4>
            </div>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Ordered By</th>
                    <th>Books Type</th>
                    <th>Payment Method</th>
                </tr>
            
            <?php
                $placed=mysqli_query($conn,"SELECT uniqueorder,sum(qty) AS qty,method,customer FROM orders WHERE userID=$userID and orderstatus=0 GROUP BY uniqueorder ORDER BY orderedTime desc LIMIT 6");
                if($rowplaced=mysqli_num_rows($placed)>0){
                    while($getPlaced=mysqli_fetch_assoc($placed)){
                        $name=$getPlaced['customer'];
                        $uqorid=$getPlaced['uniqueorder'];
                        $orqty=$getPlaced['qty'];
                        $ordTime=$getPlaced['method'];
                        $totprod22=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$uqorid' and orderStatus=0");
                        $numqty2=mysqli_num_rows($totprod22);
                        echo "<tr><td class='data'><a href='orderSummary.php?id=$uqorid'>$uqorid</a></td><td>$name</td><td>$numqty2</td><td>$ordTime</td></tr>";
                    }
                }
                else{
                    $msg.="-";
                    echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";

                }
            ?>
            </table>
            <div>
                <?php 
                    if($rowplaced>=6){
                        echo "<a href='orderall.php?st=0' style='text-decoration:none;color:black;'>VIEW ALL</a>";
                    }
                ?>
            </div>
        </div>
        <!-- ship -->
        <div id="placed">
            <div style="display:flex;justify-content:space-between">
                <h2>SHIPPED</h2>
                <h4></h4>
            </div>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Ordered By</th>
                    <th>Books Type</th>
                    <th>Payment Method</th>
                </tr>
            
            <?php
                $placed2=mysqli_query($conn,"SELECT uniqueorder,sum(qty) AS qty,method,customer FROM orders WHERE userID=$userID and orderstatus=1 GROUP BY uniqueorder ORDER BY orderedTime desc LIMIT 6");
                if($rowplaced2=mysqli_num_rows($placed2)>0){
                    while($getPlaced=mysqli_fetch_assoc($placed2)){
                        $name=$getPlaced['customer'];
                        $uqorid=$getPlaced['uniqueorder'];
                        $orqty=$getPlaced['qty'];
                        $ordTime=$getPlaced['method'];
                        $totprod2=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$uqorid' and orderStatus=1");
                        $numqty=mysqli_num_rows($totprod2);
                        echo "<tr><td class='data'><a href='orderSummary.php?id=$uqorid'>$uqorid </a></td><td>$name</td><td>$numqty</td><td>$ordTime</td></tr>";
                    }
                }
                else{
                    $msg.="-";
                    echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";

                }
            ?>
            </table>
            <div>
                <?php 
                    if($rowplaced2>6){
                        echo $msg="<a href='orderall.php?st=1' style='text-decoration:none;color:black;'>VIEW ALL</a>";
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="orderBody">
    <div id="placed">
            <div style="display:flex;justify-content:space-between">
                <h2>DELIVERED</h2>
                <h4></h4>
            </div>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Ordered By</th>
                    <th>Books Type</th>
                    <th>Payment Method</th>
                </tr>
            
            <?php
                $placed=mysqli_query($conn,"SELECT uniqueorder,sum(qty) AS qty,method,customer FROM orders WHERE userID=$userID and orderStatus=3 GROUP BY uniqueorder ORDER BY orderedTime desc LIMIT 6");
                if($rowplaced=mysqli_num_rows($placed)>0){
                    while($getPlaced=mysqli_fetch_assoc($placed)){
                        $name2=$getPlaced['customer'];
                        $uqorid2=$getPlaced['uniqueorder'];
                        $orqty=$getPlaced['qty'];
                        $ordTime3=$getPlaced['method'];
                        $totprod223=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$uqorid2' and orderStatus=3");
                        $numqty2=mysqli_num_rows($totprod223);
                        echo "<tr><td class='data'><a href='orderSummary.php?id=$uqorid2'>$uqorid2</a></td><td>$name2</td><td>$numqty2</td><td>$ordTime3</td></tr>";
                    }
                }
                else{
                    $msg.="-";
                    echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";

                }
            ?>
            </table>
            <div>
                <?php 
                    if($rowplaced>=6){
                        echo "<a href='orderall.php?st=3' style='text-decoration:none;color:black;'>VIEW ALL</a>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include('User_footer.php');
?>