<?php
    include ('../private/dbconnect.php');
    // session_start();
    // if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    // {
    //     // header("location: user_login.php");
    //     echo"Login to buy books";
    // }
    // if(isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    // {
    // $user = $_SESSION['userName'];
    // $query = "SELECT * FROM users WHERE userName='$user'";
    // $run=mysqli_query($conn,$query);
    // if (mysqli_num_rows($run) > 0){
    //     $row = mysqli_fetch_assoc($run);
    //     $userID=$row['userID'];
    //     $userName=$row['userName'];
    //     $userEmail=$row['email'];
    // }
    // }
    
?>

<!-- Main Body -->
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="../private/userhome.css">
</head>
<body>
    <?php
    include("../private/User_nav.php");
    ?>
    <div id="message"></div>
    <div class="shelf">   
    <div class="homecat">
            <div>Collection</div>
            <div class="view"><a href="collection.php" style="text-decoration:none;color:black">VIEW ALL</a></div>
    </div>
        <div class="productsHome">  
    <?php
        $getQuery="SELECT * FROM products WHERE productStatus=1 and productQty>0 ORDER BY productPublished desc LIMIT 5";
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
                if(strlen($productName)>16){
                    $productName=substr($productName, 0, 16)."...";
                }
                if(strlen($productAuthor)>17){
                    $productAuthor=substr($productAuthor, 0, 17)."...";
                }
                ?>
                <!-- Data fetched -->
                <div class="content">
                    <div><a href="../public/User_ProductView.php?product=<?=$ID?>"><img src="<?=$productImg?>" alt="" width=180px height=240px></a></div>
                    <div class="name"><a href="../public/User_ProductView.php?product=<?=$ID?>"><?=$productName?></a></div>
                    <div class="author"><a href=""><?="By ".$productAuthor?></a></div>
                    <div class="price">NPR.<?=$productCost?></div>
                    <div class="cart">
                        <a href='cart.php?id=<?=$ID?>'>
                            <div class="button">Add to cart</div>
                        </a>
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

        <div class="homecat">
            <div>New Arrivals</div>
            <div class="view"><a href="newArrivals.php" style="text-decoration:none;color:black">VIEW ALL</a></div>
        </div>
        <div class="productsHome">    
            <?php
                $getQuery="SELECT * FROM products WHERE productStatus=1 and productQty>0 ORDER BY `setDate` LIMIT 5";
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
                        if(strlen($productName)>16){
                            $productName=substr($productName, 0, 16)."...";
                        }
                        if(strlen($productAuthor)>17){
                            $productAuthor=substr($productAuthor, 0, 17)."...";
                        }

                        ?>
                        <!-- Data fetched -->
                        <div class="content">
                            <div><a href="../public/User_ProductView.php?product=<?=$ID?>"><img src="<?=$productImg?>" alt="" width=180px height=240px></a></div>
                            <div class="name"><a href="../public/User_ProductView.php?product=<?=$ID?>"><?=$productName?></a></div>
                            <div class="author"><a href=""><?="By ".$productAuthor?></a></div>
                            <div class="price">NPR.<?=$productCost?></div>
                            <div class="cart">
                                <a href='cart.php?id=<?=$ID?>'>
                                    <div class="button">Add to cart</div>
                                </a>
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
        <div>    
        <!-- <div class="homecat">
            <div>Our Suggestions</div>
            <div class="view">VIEW ALL</div>
        </div>
        <div class="productsHome">     -->
            <?php
                // $getQuery="SELECT * FROM products WHERE productStatus=1 and productQty>0 AND productPriority=1  Limit 5";
                // $runGet=mysqli_query($conn,$getQuery);
                // $numData=mysqli_num_rows($runGet)>0;

                // if($numData){
                //     while ($getRow = mysqli_fetch_array($runGet)){
                //         $ID=$getRow['productID'];
                //         $productName=$getRow['productName'];
                //         $productDesc=$getRow['productDesc'];
                //         $productCat=$getRow['productCategory'];
                //         $productCost=$getRow['productCost'];
                //         $productQty=$getRow['productQty'];
                //         $productImg=$getRow['productImg'];
                //         $productAuthor=$getRow['productAuthor'];
                //         $published=$getRow['productPublished'];
                //         if(strlen($productName)>16){
                //             $productName=substr($productName, 0, 16)."...";
                //         }
                        ?>
                        <!-- Data fetched -->
                        <!-- <div class="content">
                            <div><a href="../public/User_ProductView.php?product=<?=$ID?>"><img src="<?=$productImg?>" alt="" width=180px height=240px></a></div>
                            <div class="name"><a href="../public/User_ProductView.php?product=<?=$ID?>"><?=$productName?></a></div>
                            <div class="author"><a href=""><?="By ".$productAuthor?></a></div>
                            <div class="price">NPR.<?=$productCost?></div>
                            <div class="cart">
                                <a href='cart.php?id=<?=$ID?>'>
                                    <div class="button">Add to cart</div>
                                </a>
                            </div>
                        </div> -->
                        <!-- data fetch end -->
                        <?php
                //     }
                // }
                // else{
                //     echo 'No data found.';
                // }
            ?>
        </div>    
        </div>
    </div>
</body>
</html>
<div width="100%">
<?php
include('User_footer.php');
?>
</div>