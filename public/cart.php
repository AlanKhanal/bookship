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
    else{
        header("location:User_login.php?set=0");
    }

    if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        //FETCHprdtData
        $fetch2="SELECT * FROM cart WHERE productID=$id and userID=$userID";
            $runfetch2=mysqli_query($conn,$fetch2);
            if($runfetch2){
                $numData2=mysqli_num_rows($runfetch2);
                if($numData2<1){
                    $fetch="SELECT * FROM products WHERE productID=$id and productQty>0";
                    $runfetch=mysqli_query($conn,$fetch);
                    if($runfetch){
                        $numData=mysqli_num_rows($runfetch);
                            if($numData){
                                while ($getRow = mysqli_fetch_array($runfetch)){
                                    $productName=$getRow['productName'];
                                    $productDesc=$getRow['productDesc'];
                                    $productAuthor=$getRow['productAuthor'];
                                    $productCost2=$getRow['productCost'];
                                    $productQty2=$getRow['productQty'];
                                    $img=$getRow['productImg'];
                                    $orgqty=$getRow['productQty'];

                                    $unique=uniqid();

                                    $prdPrice=$productCost2*$productQty2;
                                    $cartInsertion="INSERT INTO cart(`userID`,`productID`,`qty`,`price`,`prdPrice`,`name`,`pDesc`,`auth`,`img`,`orgqty`,`totPrice`,`uniquecart`) 
                                    VALUES($userID,$id,1,$productCost2,$prdPrice,'$productName','$productDesc','$productAuthor','$img',$orgqty,1*$productCost2,'62961f8211776-23cart$userID')";
                                    if(mysqli_query($conn,$cartInsertion)){
                                        header("location:cart.php");
                                    }
                                // $totPrice="SELECT SUM(prdPrice) AS totPrice FROM OrderDetails WHERE userID=$userID";
                                // $runtot=mysqli_query($conn,$totPrice);
                                // $get=$getRow['totPrice'];
                            }
                        }
                }
            }
            else{
                $msg= "BOOK ALREADY EXIST IN CART.<br>";
            }
            
        }
        // INSERT INTO CART
    }
?>
    
<?php
    if(isset($_REQUEST["manage"])){
        $named=$_REQUEST['name'];
        $cartID = $_REQUEST['valued'];
        $qty = $_REQUEST['qty'];
        
        $tot=mysqli_query($conn,"SELECT * FROM cart WHERE `cartID`=$cartID");
        $getT = mysqli_fetch_assoc($tot);
        $myprice=$qty*$getT['price'];



        $qtyQuery="UPDATE cart 
                SET `qty`=$qty,`totPrice`=$myprice
                WHERE `cartID`=$cartID";
        if(mysqli_query($conn,$qtyQuery)){
            // echo "Successfully updated quantity of Book <b>".$named."</b>.";
            // header("http://localhost:8081/bookship/public/cart.php#");
        }
    }
    if(isset($_REQUEST["remove"])){
        $named=$_REQUEST['name'];
        $cartID = $_REQUEST['valued'];
        $qty = $_REQUEST['qty'];

        $dltQuery="DELETE FROM cart WHERE `cartID`=$cartID";
        if(mysqli_query($conn,$dltQuery)){
            // echo "Successfully updated quantity of Book <b>".$named."</b>.";
            // header("http://localhost:8081/bookship/public/cart.php#");
        }
    }
?>

<?php
    include ('../private/User_nav.php');
?>
<!-- GET CART -->
<!DOCTYPE html>
<html>
<head>
    <title>Cart || Bookship</title>
    <link rel="stylesheet" href="cart.css">
    <style>
        
        .cont{
            color:coral;
        }
        .cont:hover{
            color: #fa5012;
        }
        #buy{
            text-decoration:none;
            color:white;
            font-size:24px;
            font-weight:bold;
            border:2px solid coral;
            border-radius:5px;
            padding:2px 20px;
            background-color:#fa5012;
        }
        #buy:hover{
            transform: scaleX(1.07);
            background-color:orangered;
        }
    </style>
</head>
<body>
    <div style="padding-left:140px">
        <a href="User_home.php" style="text-decoration:dashed;color:#fa5012;font-size:24px;font-weight:bold"><p class="cont">::<u>CONTINUE SHOPPING</u>::</p></a>
    </div>
    <div class="allBody"> 
        <div class="cartbody" style="border:3px solid coral;width:600px;padding:5px;background-color:#20214a">
        <div class="myCartHead" style="color:white;font-weight:bold;display:flex;justify-content:space-between">
            <div>MY CART</div>
            <div>PRICE</div>
        </div>
        
        <hr class="boldHR">

        <div class="msg" style="text-align:center;color:yellow"><?=$msg?></div>
            <?php
                $cartQuery="SELECT * FROM cart WHERE userID=$userID ";
                $runcartQuery=mysqli_query($conn,$cartQuery);
                if($runcartQuery){
                    if(($totRows=mysqli_num_rows($runcartQuery)) > 0){
                        while($Row32=mysqli_fetch_array($runcartQuery)){
                            $id=$Row32['cartID'];
                            $pID=$Row32['productID'];
                            $name=$Row32['name'];
                            $author=$Row32['auth'];
                            $desc=$Row32['pDesc'];
                            $qty=$Row32['qty'];
                            $price=$Row32['price'];
                            $prdPrice=$Row32['prdPrice'];
                            $img=$Row32['img'];
                            $orgqty=$Row32['orgqty'];
                            ?>
                            <!-- BOXBOX -->
                            <div>
                                <div class="mid-div">
                                    <ul type=none>
                                        <div class="perBookImg" style="display:flex;">
                                            <div style="padding:5px 7px">
                                                <li><img src="<?=$img?>" alt="" height=130px width=100px style="border:1px solid white;"></li>
                                            </div>
                                            <div class="perBookDesc" style="margin-top:8px;padding:8px;">
                                                <li style="display:flex;justify-content:space-between;color:white;"><div><?="$name"?></div><div style="color:white;padding-left:200px;padding-right:5px">NPR.<?=$qty*$price?></div></li>
                                                <li style="padding:2px 5px;font-size:16px;color:white"><i><?="by $author"?></i></li>
                                                <div class="cartDown">
                                                    <li>
                                                        <form action="" method=POST>
                                                            <input type="text" value="<?=$name?>" name="name" hidden>
                                                            <input type="number" value="<?=$id?>" name="valued" hidden>
                                                            <li style="padding:2px 5px;font-size:16px;color:white">Quantity
                                                            <?php
                                                            $orders=mysqli_query($conn,"SELECT * FROM orders WHERE productID=$pID");
                                                            $ordered= 0;
                                                            if(($totRows=mysqli_num_rows($orders)) > 0){
                                                                                while ($numor = mysqli_fetch_assoc ($orders)) {
                                                                                    $ordered += $numor['qty'];
                                                                                }
                                                            }
                                                            // echo "<b>NPR.".$ordered."</b>";
                                                            ?>
                                                            <input type="number" value=<?=$qty?> name="qty" id="qty" onclick="touch()" min=1 max=<?=$orgqty?> style="width:40px;text-align:center;border:1px solid black;padding:1px;border-radius:5px;font-weight:700;"></li>
                                                            <div id="manage">
                                                            <input type="submit" name="manage" value="SAVE" style="background-color:orange;border:1px solid orange;padding:2px;color:white;border-radius:2px" >
                                                                <a href="wishlist.php?id=<?=$Row32['productID']?>" style="text-decoration:none;background-color:#E75480;border:1px solid #E75480;padding:1px;color:white;font-size:14px;border-radius:2px">ADD TO WISHLIST</a>
                                                                <input type="submit" name="remove" value="DELETE" style="background-color:grey;border:1px solid grey;padding:2px;color:white;border-radius:2px">
                                                            </div>
                                                            
                                                        </form>
                                                    </li>
                                                </div>
                                                <!-- managementbox -->
                                                
                                                <!-- managementbox ends here up -->
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                                
                            <?php
                        }
                    }
                    else{
                        $msg= "NO ITEMS.";
                    }
                }
            ?>
            <div style="display:flex;justify-content:space-between">
            
                <div style="font-style:italic;color:white">TOTAL</div>
                <div><?php
                    $query32 = "SELECT * FROM cart WHERE userID=$userID";
                    $query_run = mysqli_query($conn,$query32);
                    $qty= 0;
                    while ($num = mysqli_fetch_assoc ($query_run)) {
                        $qty += $num['totPrice'];
                    }
                    echo "<i style='color:white;'>NPR.".$qty."</i>";
                ?></div>
            </div>
        </div>
    </div>
    <div style="display:flex;justify-content:space-around;text-align:center;margin:0rem 7rem">
        <a href="buyerInfo.php?uqid=62961f8211776-23cart<?=$userID?>"><button id="buy">PROCEED</button></a>
        <!-- <form action="https://uat.esewa.com.np/epay/main" method="POST">
            <input value="<?=$qty?>" name="tAmt" type="hidden">
            <input value="<?=$qty?>" name="amt" type="hidden">
            <input value="0" name="txAmt" type="hidden">
            <input value="0" name="psc" type="hidden">
            <input value="0" name="pdc" type="hidden">
            <input value="EPAYTEST" name="scd" type="hidden">
            <input value="ee2c3ca" name="pid" type="hidden">
            <input value="http://merchant.com.np/page/esewa_payment_success?q=su" type="hidden" name="su">
            <input value="http://merchant.com.np/page/esewa_payment_failed?q=fu" type="hidden" name="fu">
            <input value="BUY" id="buy" type="submit">
        </form> -->
    </div>
</body>
</html>
<?php
include('User_footer.php');
?>