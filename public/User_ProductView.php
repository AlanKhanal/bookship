<?php
    include ('../private/dbconnect.php');
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location:User_login.php");
    }
    $user = $_SESSION['userName'];

    include("../private/User_nav.php");


    $query = "SELECT * FROM users WHERE userName='$user'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $userID=$row['userID'];
        $userName=$row['userName'];
        $userEmail=$row['email'];
    }
        if(isset($_REQUEST['product'])){
            $pID=$_REQUEST['product'];
        }
        $getQuery="SELECT * FROM products WHERE productStatus=1 and productID='$pID'";
        $runGet=mysqli_query($conn,$getQuery);
        $numData=mysqli_num_rows($runGet)>0;

        if($numData){
            while ($getRow = mysqli_fetch_array($runGet)){
                $ID=$getRow['productID'];
                $productName=$getRow['productName'];
                $productDesc=$getRow['productDesc'];
                $productCat=$getRow['productCategory'];
                $productCost=$getRow['productCost'];
                $productQty=$getRow['productQty'];
                $productImg=$getRow['productImg'];
                $productAuthor=$getRow['productAuthor'];
                $published=$getRow['productPublished'];
                
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book-[<?=$productName?>]</title>
    <link rel="stylesheet" href="../private/userhome.css">
</head>
<body>
    <div class="homecat">
    </div>
    <div>  
                <!-- Data fetched -->
                <div style="display:flex;margin:1rem 3rem;">
                    <div style="text-align:center;">
                        <div><a href="../public/User_ProductView.php?product=<?=$ID?>"><img src="<?=$productImg?>" alt="" width=250px height=340px style="border:2px solid #ff3333;padding:2px"></a></div>
                        <div>
                            <a href="cart.php?id=<?=$ID?>">
                                <button style="margin:5px 0px;padding:0px">Add to cart</button>
                            </a>
                        </div>
                        <div>
                            <a href="wishlist.php?id=<?=$ID?>">
                                <button>Add to wishlist</button>
                            </a>
                        </div>
                    </div>

                    <div style="padding:8px 20px;">
                        <div style="display:flex;justify-content:space-between"><div style="font-size:32px;font-weight:bold"><?=$productName?></div><div style="font-size:20px;font-weight:bold;color:red;">NPR.<?=$productCost?></div></div>
                        <div  style="font-size:20px;font-weight:bold;padding-left:8px"><i><a href="" style="text-decoration:none;color:black"><?="By ".$productAuthor?></a></i></div><br>
                        <div style="padding-left:10px">
                        <hr>
                            <b style="color:grey">Synopsis</b>
                            <br>
                            <textarea name="" id="" cols="90" rows="14" style="border:none;resize:none;padding:5px 5px;color:grey;" readonly><?=$productDesc?></textarea>
                        </div>
                    </div>
                </div>
                <!-- data fetch end -->
                <?php
            }
        }
        else{
            echo 'No data found.';
        }
    ?>
    </div>
</body>
</html>