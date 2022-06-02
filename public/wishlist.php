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
        $id2=$_REQUEST['id'];
        //FETCHprdtData
        $fetch2="SELECT * FROM wishlist WHERE productID=$id2 and userID=$userID";
            $runfetch2=mysqli_query($conn,$fetch2);
            if($runfetch2){
                $numData2=mysqli_num_rows($runfetch2);
                if($numData2<1){
                    $fetch="SELECT * FROM products WHERE productID=$id2";
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
                                    $wishlistInsertion="INSERT INTO wishlist(`userID`,`productID`,`qty`,`price`,`prdPrice`,`name`,`pDesc`,`auth`,`img`,`orgqty`,`totPrice`) VALUES($userID,$id2,1,$productCost2,$prdPrice,'$productName','$productDesc','$productAuthor','$img',$orgqty,1*$productCost2)";
                                    if(mysqli_query($conn,$wishlistInsertion)){
                                        header("location:wishlist.php");
                                    }
                                // $totPrice="SELECT SUM(prdPrice) AS totPrice FROM OrderDetails WHERE userID=$userID";
                                // $runtot=mysqli_query($conn,$totPrice);
                                // $get=$getRow['totPrice'];
                            }
                        }
                }
            }
            else{
                $msg= "Book Already exist in wishlist.<br>";
            }
            
        }
        // INSERT INTO CART
    }
?>
    
<?php
    if(isset($_REQUEST["remove"])){
        $wListID = $_REQUEST['valued'];
        $dltQuery="DELETE FROM wishlist WHERE `wListID`=$wListID";
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
    <title>Wishlist || Bookship</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="allBody"> 
        <div class="cartbody" style="border:3px solid red;width:600px;padding:5px;border-radius:10px;background-color:#E75480">
        <div class="myCartHead" style="color:white;font-weight:bold;display:flex;justify-content:space-between">
            <div>Wishlist</div>
            <div>PRICE</div>
        </div>
        
        <hr class="boldHR">

        <div class="msg" style="text-align:center;color:yellow"><?=$msg?></div>
            <?php
                $cartQuery="SELECT * FROM wishlist WHERE userID=$userID";
                $runcartQuery=mysqli_query($conn,$cartQuery);
                if($runcartQuery){
                    if(($totRows=mysqli_num_rows($runcartQuery)) > 0){
                        while($Row32=mysqli_fetch_array($runcartQuery)){
                            $id2=$Row32['wListID'];
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
                                                            <input type="number" value="<?=$id2?>" name="valued" hidden>
                                                           
                                                            <div id="manage">
                                                                <a href="cart.php?id=<?=$Row32['productID']?>" style="text-decoration:none;background-color:#ff3333;border:1px solid #ff751a;padding:2px;color:white;font-size:14px">ADD TO CART</a>
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
                    $query32 = "SELECT * FROM wishlist WHERE userID=$userID";
                    $query_run = mysqli_query($conn,$query32);
                    $qty= 0;
                    while ($num = mysqli_fetch_assoc ($query_run)) {
                        $qty += $num['totPrice'];
                    }
                    echo "<b>NPR.".$qty."</b>";
                ?></div>
            </div>
        </div>
    </div>
    
    <div style="display:flex;justify-content:space-between;margin:1rem 3rem;">
        <a href="User_home.php" style="text-decoration:dashed;color:brown;font-size:24px;font-weight:bold"><p><< <u>CONTINUE SHOPPING</u></p></a>
        <a href="cart.php" style="text-decoration:dashed;color:brown;font-size:24px;font-weight:bold"><p><u>CHECK CART</u> >></p></a>
    </div>
</body>
</html>
<?php
include('User_footer.php');
?>