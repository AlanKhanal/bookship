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
<html>
<head>
    <title>Analyze | Bookship</title>
</head>
<style>
    .subParts,.parts{
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .heads{
            border: 2px solid #003399;
            border-radius: 5px;
            padding:1rem;
            margin:1rem;
            text-decoration: none;
            background-color: #003399;
            color:white;
            font-weight: 600;
        }
        .heads:hover{
            transform: scaleY(1.1);
        }
        .parts a{
            text-decoration: none;
        }
        hr{
            margin:0rem 1rem;
        }
    body{
            background:rgb(202, 205, 212);
        }
    .miniRow{
            margin: 1rem;
        }
        .dashboard{
            display: block;
        }
        .row1,.row2{
            /* display: flex;
            justify-content: space-around; */
            /* flex-wrap: wrap; */
            margin: 2rem 0rem;
        }
        .delivered table th{
            background-color: #00cc00;
            color:white;
            padding:0.2rem 0.5rem;
            font-size: 18px;
        }
        .delivered table td,.delivered table td a{
            background-color: whitesmoke;
            color:black;
            padding:0.2rem 0.5rem;
        }
        .delivered table .main:hover{
            transform: scale(1.1);
        }
        .users table th{
            background-color: purple;
            color:white;
            padding:0.2rem 0.5rem;
            font-size: 18px;
        }
        .users table td,.users table td a{
            background-color: whitesmoke;
            color:black;
            padding:0.2rem 0.5rem;
        }
        .main a{
            text-decoration: none;
            color: black;
            font-weight: 600;
        }
        .users table .main:hover{
            transform: scale(1.1);
        }
        .empty table th{
            background-color: #ff3333;
            color:white;
            padding:0.2rem 0.5rem;
            font-size: 18px;
        }
        .empty table td,.users table td a{
            background-color: whitesmoke;
            color:black;
            padding:0.2rem 0.5rem;
        }
        .empty table .main:hover{
            transform: scale(1.1);
        }
        .sales table th{
            background-color: #20214a;
            color:white;
            padding:0.2rem 0.5rem;
            font-size: 18px;
        }
        .sales table td,.sales table td a{
            background-color: whitesmoke;
            color:black;
            padding:0.2rem 0.5rem;
        }
        .sales table .main:hover{
            transform: scale(1.1);
        }
        .empty table,.delivered table,.users table,.sales table{
            /* display: flex;
            justify-content: space-between; */
            margin: 1rem 1rem;
            /* text-align: center; */
        }
        .dashboard{
            margin: 0.5rem 0.5rem;
        }
        .head{
            font-weight: 600;
            font-size: 24px;
            padding: 5px;
        }
        .view{
            font-weight: 600;
            font-size: 14px;
            padding-top: 10px;
            text-align: center;
        }
</style>
<body>
<div class="parts">
        <div class="subParts">
           <a href="Admin_category_management.php"><div class="heads" id="cat">MANAGE CATEGORY</div></a>
            <a href="Admin_product_management.php"><div class="heads" id="prod">MANAGE PRODUCT</div></a>
        </div>
        <div class="subParts">
            <a href="Admin_placedbooks.php"><div class="heads" id="placed">ORDERS RECEIVED</div></a>
            <a href="Admin_shippedbooks.php"><div class="heads" id="ship">ORDERS SHIPPED</div></a>
            <!-- <a href="Admin_placedbooks.php"><div class="heads" id="placed">ORDERS CANCELLED</div></a>
            <a href="Admin_shippedbooks.php"><div class="heads" id="ship">ORDERS DELIVERED</div></a> -->
        </div>
    </div>  
    <hr>
<?php
if(isset($_REQUEST['num'])){
    $num=$_REQUEST['num'];
    if($num==1){
        ?>
                <div class="empty">
                <div class="miniRow">
                    <div class="head" style="color:#ff3333">OUT OF STOCK</div>
                </div>
                <table>
                    <tr>
                        <!-- <th>Image</th> -->
                        <th>BOOK</th>
                        <th>CATEGORY</th>
                        <th>OPTION</th>
                    </tr>
                        <?php
                            $get=mysqli_query($conn,"SELECT * FROM products WHERE productQty=0 ");
                            $numget=mysqli_num_rows($get);
                            if($numget>0){
                                while($fetch=mysqli_fetch_assoc($get)){
                                    $pCat=$fetch['productCategory'];
                                    $pID=$fetch['productID'];
                                    $image=$fetch['productImg'];
                                    $pName=$fetch['productName'];
                                    ?>
                                        <tr>
                                            <!-- <td class="main"><a href="http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$pID?>"><img src="<?=$image?>" alt="" width=70 height="100"></a></td> -->
                                            <td class="main"><a href="http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$pID?>"><?=$pName?></a></td>
                                            <td><?=$pCat?></td>
                                            <td class="main"><a href="http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$pID?>">UPDATE</a></td>
                                        </tr>
                                    <?php
                                }
                            } 
                            else{
                                echo "<tr><td>-</td><td>-</td><td>-</td></tr>";
                            }                       
                        ?>
                    
                </table>
</div>
        <?php

    }
    elseif($num==2){
?>
                <div class="users">
                <div class="miniRow">
                    <div class="head" style="color:purple">SIGNED</div>
                </div>
                <table>
                        <tr>
                            <th>USER</th>
                            <th>E-MAIL</th>
                            <th>JOINED DATE</th>
                        </tr>
                    
                    <?php
                        $placed2=mysqli_query($conn,"SELECT * FROM users WHERE userStatus=1 and emailVerification=1 ORDER BY joinedDate desc ");
                        if($rowplaced2=mysqli_num_rows($placed2)>0){
                            while($get=mysqli_fetch_assoc($placed2)){
                                $id=$get['userID'];
                                $name2=$get['userName'];
                                $email=$get['email'];
                                $joined=$get['joinedDate'];
                                echo "<tr><td class='main'><a href='userSummary.php?id=$id'>$name2</a></td><td>$email</td><td>$joined</td></tr>";
                            }
                        }
                        else{
                            $msg.="-";
                            echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";

                        }
                    ?>
                    </table>
                </div>
<?php
    }
    elseif($num==3){
?>
                <div class="delivered">
                <div class="miniRow">
                    <div class="head" style="color:#00cc00">DELIVERED</div>
                </div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>ORDERED BY</th>
                        <th>BOOKS TYPE</th>
                        <th>PAYMENT</th>
                    </tr>
                
                <?php
                    $placed=mysqli_query($conn,"SELECT uniqueorder,sum(qty) AS qty,method,customer FROM orders WHERE orderStatus=3 GROUP BY uniqueorder ORDER BY orderedTime desc ");
                    if($rowplaced=mysqli_num_rows($placed)>0){
                        while($getPlaced=mysqli_fetch_assoc($placed)){
                            $name2=$getPlaced['customer'];
                            $uqorid2=$getPlaced['uniqueorder'];
                            $orqty=$getPlaced['qty'];
                            $ordTime3=$getPlaced['method'];
                            $totprod223=mysqli_query($conn,"SELECT * FROM orders WHERE uniqueorder='$uqorid2' and orderStatus=3");
                            $numqty2=mysqli_num_rows($totprod223);
                            echo "<tr><td class='main'><a href='Admin_orderSummary.php?id=$uqorid2'>$uqorid2</a></td><td>$name2</td><td>$numqty2</td><td>$ordTime3</td></tr>";
                        }
                    }
                    else{
                        $msg.="-";
                        echo "<tr><td>-</td><td>-</td><td>-</td><td>-</td></tr>";

                    }
                ?>
                </table>
                </div>
<?php
    }
    elseif($num==4){
?>
    <div class="sales">
        <div class="miniRow">
            <div class="head" style="color:#20214a">SALES</div>
        </div>
        <table>
            <tr>
                <th>BOOK NAME</th>
                <th>QUANTITY SOLD</th>
                <th>PER PIECE</th>
                <th>TOTAL</th>
            </tr>
        <?php
            $fet=mysqli_query($conn,"SELECT orders.productID,products.productName,sum(orders.qty) AS qty,products.productCost,orders.totPrice,products.productCategory,products.productImg
            FROM orders 
            INNER JOIN products
            ON orders.productID = products.productID WHERE orderStatus=3 GROUP BY orders.productID ");

            while($info=mysqli_fetch_assoc($fet)){
                $spid=$info['productID'];
                $spname=$info['productName'];
                $spqty=$info['qty'];
                $spcost=$info['productCost'];
                $sptot=$info['qty']*$info['productCost'];
                echo "<tr><td class='main'><a href='.php?<?=$spid?>'>$spname</a></td><td>$spqty</td><td>$spcost</td><td>$sptot</td></tr>";

            }
        ?>
        </table>
    </div>
<?php
    }
    else{
        header("location:Admin_home.php");
    }
}
else{
    header("location:Admin_home.php");
}
?> 
<hr>
</body>
</html>