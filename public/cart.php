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
                                    $cartInsertion="INSERT INTO cart(`userID`,`productID`,`qty`,`price`,`prdPrice`,`name`,`pDesc`,`auth`,`img`,`orgqty`) VALUES($userID,$id,1,$productCost2,$prdPrice,'$productName','$productDesc','$productAuthor','$img',$orgqty)";
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
                echo "Already Exists";
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
        
        $qtyQuery="UPDATE cart SET `qty`=$qty WHERE `cartID`=$cartID";
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
    echo "Nav-bar.<br>";    //NavBar
?>
<!-- GET CART -->
<!DOCTYPE html>
<html>
<head>
    <title>Cart || Bookship</title>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
    <div class="msg"><?=$msg?></div>
    <div class="allBody"> 
        <div class="cartbody">
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
                                            <div>
                                                <li><img src="<?=$img?>" alt="" height=130px width=100px></li>
                                            </div>
                                            <div class="perBookDesc">
                                                <li><?="$name"?></li>
                                                <li><?="$author"?></li>
                                                <li>NPR.<?="$price"?></li>
                                                <li>
                                                    Quantity:<?=$qty?>
                                                </li>
                                                <div class="cartDown">
                                                    <li>
                                                        <form action="" method=POST>
                                                            <input type="text" value="<?=$name?>" name="name" hidden>
                                                            <input type="number" value="<?=$id?>" name="valued" hidden>
                                                            <input type="number" value="<?=$qty?>" name="qty" id="qty" onclick="touch()" min=1 max=<?=$orgqty?>>
                                                            <div id="manage">
                                                                <input type="submit" name="manage" value="Save" >
                                                                <input type="submit" name="remove" value="Delete" >
                                                                <input type="submit" name="wishlist" value="Add to Wishlist" >
                                                            </div>
                                                            
                                                        </form>
                                                    </li>
                                                </div>
                                                <!-- managementbox -->
                                                
                                                <!-- managementbox ends here up -->
                                            </div>
                                            <div id="myDIV">
                                                NPR.<?=$qty*$price?>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                                
                            <?php
                        }
                    }
                    else{
                        echo"No items in cart.";
                        $cartMsg="No items in cart.";
                    }
                }
            ?>
            <div style="display:flex;justify-content:space-between">
            <div>TOTAL</div>
            <div><?php
                $query32 = "SELECT * FROM cart WHERE userID=$userID";
                $query_run = mysqli_query($conn,$query32);
                $qty= 0;
                while ($num = mysqli_fetch_assoc ($query_run)) {
                    $qty += $num['prdPrice'];
                }
                echo $qty;
            ?></div>
        </div>
        </div>
        <!-- PaymentSection -->
        Payment
    </div>
</body>
</html