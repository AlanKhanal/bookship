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

    if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        //FETCHprdtData
        $fetch2="SELECT * FROM cart WHERE productID=$id and userID=$userID";
            $runfetch2=mysqli_query($conn,$fetch2);
            if($runfetch2){
                $numData2=mysqli_num_rows($runfetch2);
                if($numData2<1){
                    $fetch="SELECT * FROM products WHERE productID=$id";
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

                                    $prdPrice=$productCost2*$productQty2;
                                    $cartInsertion="INSERT INTO cart(`userID`,`productID`,`qty`,`price`,`prdPrice`,`name`,`pDesc`,`auth`,`img`,`orgqty`,`totPrice`) VALUES($userID,$id,1,$productCost2,$prdPrice,'$productName','$productDesc','$productAuthor','$img',$orgqty,1*$productCost2)";
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
</head>
<body>
    <div class="allBody"> 
        <div class="cartbody" style="border:3px solid red;width:600px;padding:5px;border-radius:10px;background-color:#ff3333">
        <div class="myCartHead" style="color:white;font-weight:bold;">MY CART<hr class="boldHR"></div>
        <div class="msg" style="text-align:center;color:yellow"><?=$msg?></div>
            <?php
                $cartQuery="SELECT * FROM cart WHERE userID=$userID";
                $runcartQuery=mysqli_query($conn,$cartQuery);
                if($runcartQuery){
                    if(($totRows=mysqli_num_rows($runcartQuery)) > 0){
                        while($Row32=mysqli_fetch_array($runcartQuery)){
                            $id=$Row32['cartID'];
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
                                                <li style="display:flex;justify-content:space-between;width:400px;color:white;"><div><?="$name"?></div><div style="color:black">NPR.<?=$qty*$price?></div></li>
                                                <li style="padding:2px 5px;font-size:16px;color:white"><?="by $author"?></li>
                                                <div class="cartDown">
                                                    <li>
                                                        <form action="" method=POST>
                                                            <input type="text" value="<?=$name?>" name="name" hidden>
                                                            <input type="number" value="<?=$id?>" name="valued" hidden>
                                                            <li style="padding:2px 5px;font-size:16px;color:white">Quantity
                                                            <input type="number" value="<?=$qty?>" name="qty" id="qty" onclick="touch()" min=1 max=<?=$orgqty?> style="width:40px;text-align:center;border:1px solid black;padding:1px;border-radius:5px"></li>
                                                            <div id="manage">
                                                            <input type="submit" name="manage" value="SAVE" style="background-color:#1a1aff;border:1px solid #1a1aff;padding:2px;color:white;" >
                                                                <input type="submit" name="wishlist" value="ADD TO WISHLIST" style="background-color:#ff751a;border:1px solid #ff751a;padding:2px;color:white">
                                                                <input type="submit" name="remove" value="DELETE" style="background-color:black;border:1px solid black;padding:2px;color:white">
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
            
                <div style="font-weight:bold">TOTAL</div>
                <div><?php
                    $query32 = "SELECT * FROM cart WHERE userID=$userID";
                    $query_run = mysqli_query($conn,$query32);
                    $qty= 0;
                    while ($num = mysqli_fetch_assoc ($query_run)) {
                        $qty += $num['totPrice'];
                    }
                    echo "<b>NPR.".$qty."</b>";
                ?></div>
            </div>
        </div>
        <!-- PaymentSection -->
        Payment
    </div>
</body>
</html