<?php
include ('../private/dbconnect.php');
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: Admin_login.php");
}
$admin = $_SESSION['adminName'];
$query = "SELECT * FROM admins WHERE adminName='$admin'";
$run=mysqli_query($conn,$query);
if (mysqli_num_rows($run) > 0){
    $row = mysqli_fetch_assoc($run);
    $adminID=$row['adminID'];
    $adminName=$row['adminName'];
    $adminEmail=$row['email'];
    $companyName=$row['companyName'];
    $companyAddress=$row['companyAddress'];
}
include('../private/admin-header-nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bookship| Placed Orders</title>
    <style>
        *{
            padding:0px;
            margin:0px;
        }
        body{
            background-color: #cce6ff;
        }
        .bodycover th,td{
            font-size: 1.17rem;
            width: 10rem;
        }
        .bodycover td i{
            /* margin:1rem; */
            color: white;
        }
        .bodycover th i{
            /* margin:1rem; */
            color: white;
        }
        div form{
            margin:1rem;
        }
        .body1 table{
            /* border: 4px solid blueviolet; */
            /* border-radius:1rem; */
            background-color: cornflowerblue;
            margin:1rem;
            padding:0px;
        }
        .body1 th{
            /* border: 2px solid cornflowerblue; */
            text-align: left;
            padding:0.1rem 0.5rem;
            
        }
        .body1 td{
            /* border: 2px solid cornflowerblue; */
            text-align: left;
            padding:0.1rem 0.5rem;
        }
        .tbhead{
            padding:0.1rem 0.5rem;
            font-weight:400;
            border:2px solid #1a75ff;
            background-color:#1a75ff;
        }
        .tbdata{
            padding:0.1rem 0.5rem;
            border:2px solid grey;
            background-color:grey;
        }
        
        .filter{
            display:flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin: 0.2rem 2rem;
        }
        .filters{
            background-color: #003366;
            position: absolute;
            padding:0px;
        }
        .filters input{
            border: 0px;
            background-color: #003366;
            padding:0rem 0.5rem;
            font-size: 1rem;
            color: white;
            margin:0rem -1rem;
        }
        .filters input:hover{
            transform: scaleX(1.1);
        }
        .filterhead img:hover{
            transform: scaleX(1.1);

        }
        .filterhead,.filterhead input{
            font-size: 1rem;
            padding: 0.1rem 1rem;
        }
        .choice{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            text-align:center;
        }
        .choice a{
            text-decoration: none;
        }
        .confirm{
            border: 2px solid green;
            background-color: #00cc00;
            padding:0.1rem 1rem;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            font-weight: 600;
            margin:0.1rem;
        }
        .confirm:hover{
            background-color: green;
            transform: scaleX(1.1);

        }
        .cancel{
            border: 2px solid darkred;
            background-color: #ff3333;
            padding:0.1rem 1rem;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            font-weight: 600;
            margin:0.1rem;
        }
        .cancel:hover{
            background-color: darkred;
            transform: scaleX(1.1);
        }
    </style>
</head>
<body>
    <div class="filter">
        <div>
            <div onclick="myFunction()" class="filterhead" style="cursor:pointer;margin-top:1rem;">
                <img src="../icon/filter.png" alt="" width=40rem>
            </div>
            <div class="filters" id="filters" hidden>
                <form method="POST">
                    <input type="submit" name="latest" value="Latest" style='cursor:pointer'>
                </form>
                <form method="POST">
                    <input type="submit" name="oldest" value="Oldest" style='cursor:pointer'>
                </form>
                <form method="POST">
                    <input type="submit" name="cash" value="cash" style='cursor:pointer'>
                </form>
                <form method="POST">
                    <input type="submit" name="esewa" value="eSewa" style='cursor:pointer'>
                </form>
                <form method="POST">
                    <input type="submit" name="remove" value="Reset" style='background-color:red;cursor:pointer'>
                </form>
            </div>
            <script>
            function myFunction() {
            var x = document.getElementById("filters");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            }
            </script>
        </div>
        <div class="filterhead" >
            <form action="" method="POST">
                <input type="text" name="srch" placeholder="SEARCH ID" style="border:2px solid black;">
                <input type="submit" name="search" VALUE="CHECK" style="border:2px solid black;">
            </form>
        </div>
    </div>
</body>
</html>
<?php
$filter=mysqli_query($conn,"SELECT uniqueorder,mail,phno,customer,`state`,city,street,hono,postC,method,orderedTime FROM orders WHERE orderStatus=1 GROUP BY uniqueorder");
$fil="null";//fil is used to confirm filtered orders
if(isset($_REQUEST['latest'])){
    $filter=mysqli_query($conn,"SELECT uniqueorder,mail,phno,customer,`state`,city,street,hono,postC,method,orderedTime FROM orders WHERE orderStatus=1 GROUP BY uniqueorder ORDER BY orderedTime desc");
    $fil="latest";
}
if(isset($_REQUEST['oldest'])){
    $filter=mysqli_query($conn,"SELECT uniqueorder,mail,phno,customer,`state`,city,street,hono,postC,method,orderedTime FROM orders WHERE orderStatus=1 GROUP BY uniqueorder ORDER BY orderedTime asc");
    $fil="oldest";
}
if(isset($_REQUEST['esewa'])){
    $filter=mysqli_query($conn,"SELECT uniqueorder,mail,phno,customer,`state`,city,street,hono,postC,method,orderedTime FROM orders WHERE orderStatus=1 and method='esewa' GROUP BY uniqueorder");
    $fil="esewa";
}
if(isset($_REQUEST['cash'])){
    $filter=mysqli_query($conn,"SELECT uniqueorder,mail,phno,customer,`state`,city,street,hono,postC,method,orderedTime FROM orders WHERE orderStatus=1 and method='cash' GROUP BY uniqueorder");
    $fil="cash";
}
if(isset($_REQUEST['remove'])){
    $filter=mysqli_query($conn,"SELECT uniqueorder,mail,phno,customer,`state`,city,street,hono,postC,method,orderedTime FROM orders WHERE orderStatus=1 GROUP BY uniqueorder");
    $fil="remove";
}
if(isset($_REQUEST['search'])){
    $srch=$_REQUEST['srch'];
    $filter=mysqli_query($conn,"SELECT uniqueorder,mail,phno,customer,`state`,city,street,hono,postC,method,orderedTime FROM orders WHERE orderStatus=1 and uniqueorder LIKE '%$srch%' GROUP BY uniqueorder");
    $fil="search";

}

if(mysqli_num_rows($filter)>0){
?>
<div align="center" style="margin-bottom:1rem">
<h2><u>ORDERS SHIPPED</u></h2>
</div>
<!-- <div align="center" style="margin:1rem" class="all">
    <a href="shipmentdecision.php?oID=all&des=1&fil=<?=$fil?>" id="co" class="confirm" style="text-decoration:none;font-size:20px;">CONFIRM ALL ORDERS</a>
    <a href="shipmentdecision.php?oID=all&des=cancel&fil=<?=$fil?>" id="xo" class="cancel" style="text-decoration:none;font-size:20px;">CANCEL ALL ORDERS</a>
</div> -->
<?php    
    while($row=mysqli_fetch_assoc($filter)){
        $uID=$row['uniqueorder'];
        $name=$row['customer'];
        $mail=$row['mail'];
        $ph=$row['phno'];
        // address
        $state=$row['state'];
        $city=$row['city'];
        $street=$row['street'];
        $hono=$row['hono'];
        $postC=$row['postC'];
        // method
        $method=$row['method'];
        $date=$row['orderedTime'];
        //display
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ORDERS</title>
</head>
<body>

    <div class="bodycover" align="center"><!--MainDIV-->
        <div class="body1" align="center"><!--Sub div- information-->
        <div style="font-weight:600">ID:<?=$uID?></div>
            <Table class="maintable" align="center">
                <tr>
                    <th colspan="5" style="text-align:center;background-color:#ffff66;"><h3>CUSTOMER INFORMATION</h3></th>
                </tr>
                <tr>
                    <th class="tbhead">ORDER ID</th>
                    <th class="tbhead">RECEIVER</th>
                    <th class="tbhead">METHOD</th>
                    <th class="tbhead" colspan="2">ORDERED DATE TIME</th>
                </tr>
                <tr>
                    <td class="tbdata"><i><?=$uID?></i></td>
                    <td class="tbdata"><i><?=$name?></i></td>
                    <td class="tbdata"><i><?=$method?></i></td>
                    <td  class="tbdata" colspan="2"><i><?=$date?></i></td>
                </tr>
                <tr>
                    <th colspan="5" style="text-align:center;background-color:#ffff66;"><h3>CUSTOMER ADDRESS</h3></th>
                </tr>
                <tr>
                    <tr>
                        <!-- <th style="padding:0.1rem 0.5rem;">Address:</th> -->
                        <th class="tbhead">STATE</th>
                        <th class="tbhead">CITY</th>
                        <th class="tbhead">STREET</th>
                        <th class="tbhead">HOUSE NO.</th>
                        <th class="tbhead">POSTAL CODE</th>
                    </tr>
                    <tr>
                            <!-- <td></td> -->
                            <td class="tbdata"><i><?=$state?></i></td>
                            <td class="tbdata"><i><?=$city?></i></td>
                            <td class="tbdata"><i><?=$street?></i></td>
                            <td class="tbdata"><i><?=$hono?></i></td>
                            <td class="tbdata"><i><?=$postC?></i></td>
                    </tr>
                    </tr>
                <tr>
                    <th colspan="5" style="text-align:center;background-color:#ffff66;"><h3>ORDERS</h3></th>
                </tr>
                <tr>
                    <th class="tbhead">BOOK</th>
                    <th class="tbhead">CATEGORY</th>
                    <th class="tbhead">QUANTITY</th>
                    <th class="tbhead">PER BOOK</th>
                    <th class="tbhead">TOTAL</th>
                <!-- <th></th> -->
            </tr>
            
                <!-- </tr>             -->
<?php

        // get summary of uID
        $get=mysqli_query($conn,"SELECT products.productName,orders.qty,products.productCost,orders.totPrice,products.productCategory,products.productImg
        FROM orders
        INNER JOIN products
        ON orders.productID = products.productID WHERE uniqueorder='$uID'");
        if($num=mysqli_num_rows($get)){
        while($fetch=mysqli_fetch_assoc($get)){
            $name=$fetch['productName'];
            $qty=$fetch['qty'];
            $price=$fetch['productCost'];
            $totPrice=$fetch['totPrice'];
            $cat=$fetch['productCategory'];
            $img=$fetch['productImg'];
            ?>
            <tr>
                <td class="tbdata"><u><b><a href="<?=$img?>" target="_blank" style="text-decoration:none;color:white"><?=$name?></a></b></u></td>
                <td class="tbdata"><i><?=$cat?></i></td>
                <td class="tbdata"><i><?=$qty?></i></td>
                <td class="tbdata"><i>NPR.<?=$price?></i></td>
                <td class="tbdata"><i style="font-weight:600">NPR.<?=$totPrice?></i></td>
            </tr>
            <?php
        }
    }?>
    <tr>
        <th colspan="2" style="border-top:2px solid #ffff66;color:white;font-size:17px">
        <?php
            $query32 = "SELECT * FROM orders WHERE uniqueorder='$uID'";
            $query_run = mysqli_query($conn,$query32);
            $qty= 0;
            while ($num = mysqli_fetch_assoc ($query_run)) {
                $qty += $num['totPrice'];
            }
            echo "TOTAL: <b>NPR.".$qty."</b>";
        ?>
        </th>
        <th style="border-top:2px solid #ffff66;color:white;font-size:17px">
        <?php
            $query32 = "SELECT * FROM orders WHERE uniqueorder='$uID'";
            $query_run = mysqli_query($conn,$query32);
            $qty2= 0;
            while ($num = mysqli_fetch_assoc ($query_run)) {
                $qty2 += $num['qty'];
            }
            echo "TOTAL QUANTITY: $qty2";
        ?>
        </th>
                <th colspan="3" style="border-top:2px solid #ffff66;">
                <div class="choice" >
                    <i style="color:#ffff66">SHIPPED</i>
                </div>
                </th>
            </tr>
    <!-- ?> -->
    </table>
    <hr style="border:1px solid cornflowerblue; margin:1rem">
    <?php
    }
}
else{
    echo "<div style='margin:1rem 2rem;'>NO SHIPMENT FOUND.";
}
?>        </div>
    </div>
</body>
</html>