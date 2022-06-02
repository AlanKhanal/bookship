
<?php
    include ('../private/dbconnect.php');
    // session_start();
    // if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    // {
    //     // header("location: ../public/User_login.php");
    // }
    // $user = $_SESSION['userName'];
    include("../private/User_nav.php");
    // $query = "SELECT * FROM users WHERE userName='$user'";
    // $run=mysqli_query($conn,$query);
    // if (mysqli_num_rows($run) > 0){
    //     $row = mysqli_fetch_assoc($run);
    //     $userID=$row['userID'];
    //     $userName=$row['userName'];
    //     $userEmail=$row['email'];
    // }
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Category</title>
            <link rel="stylesheet" href="../private/userhome.css">
        </head>
        <body>
            <div style="display:flex;justify-content:space-between;">
                <div style="margin:0rem 2rem;padding:0px;font-size:30px;color:#ff3333;">
                    Collection
                </div>
                <!-- <div style="margin:0rem 2rem;padding:0px;padding-top:10px;font-size:15px;color:#ff3333;">
                    sort by
                </div> -->
            </div>
            <!-- SORT BY -->
            <!-- <div style="display:flex;justify-content:flex-end;">
                <div>
                    <a href=""></a>
                </div>
                <div>
                    s
                </div>
            </div> -->
            <hr style="margin:0rem 1rem;border-top:1px solid #ff3333;">
            <br>
    <div class="productsHome" style="display:flex;flex-wrap:wrap;padding-left:50px;"> 
    <?php
        $getQuery="SELECT * FROM products WHERE productStatus=1 and productQty>0";
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
                if(strlen($productName)>17){
                    $productName=substr($productName, 0, 17)."...";
                }
?> 
                <!-- Data fetched -->
                <div class="content" align=center>
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
</body>
</html>
<?php
include('User_footer.php');
?>