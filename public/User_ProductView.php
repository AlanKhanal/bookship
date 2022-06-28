<?php
include ('../private/dbconnect.php');
    $delete="";
    // session_start();
    // if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    // {
    //     header("location:User_login.php");
    // }
    // $user = $_SESSION['userName'];

 


    // $query = "SELECT * FROM users WHERE userName='$user'";
    // $run=mysqli_query($conn,$query);
    // if (mysqli_num_rows($run) > 0){
    //     $row = mysqli_fetch_assoc($run);
    //     $userID=$row['userID'];
    //     $userName=$row['userName'];
    //     $userEmail=$row['email'];
    // }
        if(isset($_REQUEST['product'])){
            $pID=$_REQUEST['product'];
        }
        $fMsg="";
        if(isset($_REQUEST['fsend'])){
            $fValid=true;
        $feedback=trim($_REQUEST['feedback']);
            if($feedback==""){
                $fValid=false;
                $fMsg="ERROR: Empty Feedback";
            }
            elseif(strlen($feedback)>2000){
                $fValid=false;
                $fMsg="ERROR: Only 2000 characters allowed";
            }
            if($fValid){
            include("feedback.php");
            }
        }
        include("../private/User_nav.php");
        $getQuery="SELECT * FROM products WHERE productStatus=1 and productQty>0 and productID='$pID'";
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
                    <div style="text-align:center;margin-bottom:2px;">
                        <div><a href="<?=$productImg?>" target="_BLANK"><img src="<?=$productImg?>" alt="" width=250px height=340px style="border:2px solid #20214a;"></a></div>
                        <div align=center style="margin-top:3px;">
                            <a href='cart.php?id=<?=$ID?>'>
                                <div class="button">Add to cart</div>
                            </a>
                        </div>
                        <div align=center>
                            <a href='wishlist.php?id=<?=$ID?>'>
                                <div class="button" style="margin-top:-50px;">Add to wishlist</div>
                            </a>
                            <hr style="margin-top:-45px;border-top:1px solid #20214a;width:auto">
                        </div>
                    </div>

                    <div style="padding:8px 20px;">
                        <div style="display:flex;justify-content:space-between;flex-wrap:wrap;"><div style="font-size:30px;font-weight:bold"><?=$productName?></div><div style="font-size:20px;font-weight:bold;color:#20214a;">NPR.<?=$productCost?></div></div>
                        <div  style="font-size:20px;font-weight:bold;padding-left:8px"><i><a href="" style="text-decoration:none;color:black"><?="By ".$productAuthor?></a></i></div><br>
                        <div style="padding-left:10px">
                        <hr style="border-top:1px solid #20214a;width:100%">
                            <b style="color:grey;">Synopsis</b>
                            <br>
                            <textarea name="" id="" cols="90" rows="14" style="border:none;resize:none;padding:5px 5px;color:grey;background:none;width:100%" readonly><?=$productDesc?></textarea>
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
<!DOCTYPE html>
<html>
<head>
    
    <style>
        .feedback{
            margin-left: 3.5rem;
            margin-top: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 24px;
            font-weight: 700;
        }
        .inp{
            margin: 0.2rem 2rem;
            border-radius: 5px;
            border: 2px solid coral;
            padding: 0.05rem 0.4rem;
            font-size: 20px;
            background-color: #fa5012;
            color: white;
            font-weight: 600;
        }
        .inp:hover{
            transform: scale(1.05);
        }
        .txtA{
            margin-left: 2rem;
            margin-right: 0rem;
            border: 2px solid grey;
            font-weight: 500;
            padding: 0.2rem;
            resize: none;
        }
        .txtA:hover{
            border: 2px solid #20214a;
        }
        .fMsg{
            font-size: 16px;
            color: #ff3333;
        }
        .feeds{
            margin: 0.3rem 3rem;
            font-size: 16px;
        }
        .feeder{
            font-weight: 500;
        }
        .feeded{
            margin: 0rem 2rem;
            font-weight: 400;
        }
        .delete{
            text-decoration: none;
margin-top: -1rem;
        }
    </style>
</head>
<body>
    <div class="feedback">
    <div class="fHead">Feedback</div>
    <?php
    $getFeeds=mysqli_query($conn,"SELECT feedback.feedbackID,feedback.feed,users.userName
    FROM feedback
    INNER JOIN users
    ON feedback.userID = users.userID WHERE productID=$pID ORDER BY feededTime LIMIT 50");
    if(mysqli_num_rows($getFeeds)>=1){
        while($feeds=mysqli_fetch_assoc($getFeeds)){
            $fID=$feeds['feedbackID'];
            $user=$feeds['userName'];
            $feed=$feeds['feed'];
            ?>
              <div class="feeds">
                <div class="feeder"><u><?=$user?></u> <?=$delete?></div>
                <div class="feeded"><textarea name="" id="" cols="50" rows="2" style="resize:none;background:none;border:none;" readonly><?=$feed?></textarea>
                </div>
              </div>  
            <?php
        }
    }
    ?>
    <div class="fForm">
        <form method="POST">
            <textarea name="feedback" id="" cols="40" rows="3" class="txtA" name="feedback" placeholder="Feedback here."></textarea><br>
            <input type="submit" value="Send" name="fsend" id="" class="inp">
        </form>
        <div class="fMsg"><?=$fMsg?></div>
    </div>
    </div>
    <hr style="margin:0rem 3rem;border-top:1px solid #20214a">
</body>
</html>



<div style="display:flex;margin:1rem 3rem;display:flex;justify-content:space-between;">
<h2>Related</h2>
</div>
<div class="productsHome" style="display:flex;flex-wrap:wrap;">  
<!-- Cat Under Product -->
<?php
$getQuery2="SELECT * FROM products WHERE productStatus=1 and productID!=$ID and productCategory='$productCat' and productQty>0";
$runGet2=mysqli_query($conn,$getQuery2);
$numData2=mysqli_num_rows($runGet2)>0;

if($numData2){
    while($getRow2 = mysqli_fetch_array($runGet2)){
        $ID2=$getRow2['productID'];
        $productName2=$getRow2['productName'];
        $productDesc2=$getRow2['productDesc'];
        $productCat2=$getRow2['productCategory'];
        $productCost2=$getRow2['productCost'];
        $productQty2=$getRow2['productQty'];
        $productImg2=$getRow2['productImg'];
        $productAuthor2=$getRow2['productAuthor'];
        $published2=$getRow2['productPublished']; 
        if(strlen($productName2)>16){
            $productName2=substr($productName2, 0, 16)."...";
        }
        if(strlen($productAuthor)>17){
            $productAuthor2=substr($productAuthor2, 0, 17)."...";
        }

?>
                <!-- Data fetched -->
                <div class="content" align=center>
                    <div><a href="../public/User_ProductView.php?product=<?=$ID2?>"><img src="<?=$productImg2?>" alt="" width=180px height=240px></a></div>
                    <div class="name"><a href="../public/User_ProductView.php?product=<?=$ID?>"><?=$productName2?></a></div>
                    <div class="author"><a href=""><?="By ".$productAuthor2?></a></div>
                    <div class="price">NPR.<?=$productCost2?></div>
                    <div class="cart">
                        <a href='cart.php?id=<?=$ID2?>'>
                            <div class="button">Add to cart</div>
                        </a>
                    </div>
                </div>

                <!-- data fetch end -->
                <?php
            }
        }
        else{
            echo "<div style='padding:1rem 3rem;'>No related books found.</div>";
            }
        
    ?>
</div>
<div style="width:100%;">
    <?php
        include('User_footer.php');
    ?>
</div>