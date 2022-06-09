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
        .summary table{
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }
        .head th{
            padding:0.5rem 1rem;
            background-color: #ff3333;
        }
        #placed th{
            padding:0.5rem 1rem;
            background-color: #00cc99;
        }
        .summary td{
            text-align: left;
            padding:0.5rem 1rem;
            background-color: whitesmoke;
        }
        .data:hover{
            /* transform: scaleX(1.2); */
            transform: scaleY(1.1);
        }
        .cancellation:hover{
            transform: scaleX(1.05);
        }
        .summary a{
           text-decoration: none;
           color:black;
           /* text-decoration: underline;  */
        }
        .head{
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 3rem;
        }
    </style>
</head>
<body>
   <?php
 if(isset($_REQUEST['id'])){
    $orID=$_REQUEST['id'];
    $data=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$orID' and userID=$userID");
    if(mysqli_num_rows($data)>0){
        while($rowda=mysqli_fetch_assoc($data)){
            $name=$rowda['customer'];
            $productID=$rowda['productID'];
            $qty=$rowda['qty'];
            $price=$rowda['price'];
            $mail=$rowda['mail'];
            $phone=$rowda['phno'];
            $state=$rowda['state'];
            $city=$rowda['city'];
            $street=$rowda['street'];
            $hono=$rowda['hono'];
            $postC=$rowda['postC'];
            $method=$rowda['method'];
            $time=$rowda['orderedTime'];
                }
            }     
        }
if(isset($_REQUEST['st'])){
    $st=$_REQUEST['st'];
}
   ?>
    <div style="display:flex;justify-content:space-around;flex-wrap:wrap;" class="summary">
    <div class="head">
    <div>
        <table>
            <tr>
                <th colspan="2" style="color:white;background-color:grey;font-size:20px">CUSTOMER DETAILS</td>
            </tr>
            <tr>
                <th colspan="2"><b>PERSONAL DETAILS</b></td>
            </tr>
            <tr>
                <td>Order Id</td>
                <td><?=$orID?></td>
            </tr>
            <tr>
                <td>Ordered By</td>
                <td><?=$name?></td>
            </tr>
            <tr>
                <td>Phone number</td>
                <td><?=$phone?></td>
            </tr>
            <tr>
                <th colspan="2"><b>SHIPPING DETAILS</b></td>
            </tr>
            <tr>
                <td>State</td>
                <td><?=$state?></td>
            </tr>
            <tr>
                <td>City</td>
                <td><?=$city?></td>
            </tr>
            <tr>
                <td>Street</td>
                <td><?=$street?></td>
            </tr>
            <tr>
                <td>House number</td>
                <td><?=$hono?></td>
            </tr>
            <tr>
                <td>Postal Code</td>
                <td><?=$postC?></td>
            </tr>
            <tr>
                <th colspan="2"><b>PAYMENT OPTION</b></td>
            </tr>
            <tr>
                <td>Method</td>
                <td><?=$method?></td>
            </tr>
            <tr>
                <td>date & Time</td>
                <td><?=$time?></td>
            </tr>
        </table>
    </div>
    </div>
    <div id="placed">
            <table>
                <tr>
                    <th colspan="6" style="color:white;background-color:grey;font-size:20px">ORDER DETAILS</th>
                </tr>
                <tr>
                    <th colspan="2">Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Per Book</th>
                    <th>Price</th>
                </tr>
            
            <?php
            // INNERJOIN connect proDID and productTable
            $data2=mysqli_query($conn,"SELECT orders.totPrice,orders.productID,orders.method,orders.qty,products.productName,products.productCategory,products.productCost,products.productImg,products.productQty
            FROM orders 
            INNER JOIN products
            ON orders.productID = products.productID WHERE uniqueorder='$orID';");
            if(mysqli_num_rows($data2)>0){
                while($getPlaced2=mysqli_fetch_assoc($data2)){
                        $ID=$getPlaced2['productID'];
                        $prdqty=$getPlaced2['productQty'];
                        if($prdqty>=1){
                            $link="http://localhost:8081/bookship/public/User_ProductView.php?product=$ID";
                        }
                        else{
                            $link="";
                        }
                        $img=$getPlaced2['productImg'];
                        $name=$getPlaced2['productName'];
                        $proCat=$getPlaced2['productCategory'];
                        $ordMeth=$getPlaced2['method'];
                        $ordqty=$getPlaced2['qty'];
                        $perCost=$getPlaced2['productCost'];
                        $totPrice=$getPlaced2['totPrice'];
                        echo "<tr><td class='data'>
                        <a href='$link'>
                        <img src='$img' width='90rem' height='120rem' style='border:1px solid #ff3333;padding:2px'>
                        </a>
                        </td>
                        <td class='data'><a href='$link'>
                        <b>$name</b>
                        </a></td>
                        <td>$proCat</td><td>$ordqty</td><td>NPR.$perCost</td><td>NPR.$totPrice</td></tr>";
                    }
                }
                else{
                    $msg.="-";
                    echo "<tr><td>-</td><td>-</td><td>-</td></tr>";

                }
            ?>
            </table>
    <div align="right">
        <?php
        $query32 = "SELECT * FROM orders WHERE uniqueorder='$orID'";
        $query_run = mysqli_query($conn,$query32);
        $qty= 0;
        if($row32=mysqli_num_rows($query_run))
        while ($num = mysqli_fetch_assoc ($query_run)) {
            $qty += $num['totPrice'];
        }
        ?>
        <div style="display:flex;justify-content:space-between;margin:1rem;">
        <?php
        $cancel=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$orID' and orderStatus=0 GROUP BY uniqueorder");
        $numchq=mysqli_num_rows($cancel);
        if($numchq==1){
            ?>
            <a href="dltPlaced.php?orID=<?=$orID?>" class="cancellation" style="text-decoration:none;border:3px solid red;background-color:#ff3333;padding:0.3rem;border-radius:5px"><b>CANCEL ORDER</b></a>
        <?php
        }
        else{
            ?><a style="text-decoration:none;border:1px solid lightblue;background-color:lightblue;padding:0.3rem;color:white;border-radius:5px"><b>CANCEL ORDER</b></a>
        <?php
        }
        ?>
            <i><b>Total Price: NPR.<?=$qty?></b></i>
        </div>
    </div>
        </div>
    </div>
    <?php
include('User_footer.php');
?>