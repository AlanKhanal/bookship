<?php
    include ('../private/dbconnect.php');
    // session_start();
    // if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    // {
    //     header("location: user_login.php");
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
?>
<?php
    include('../private/User_nav.php');
?>
<?php
if(isset($_REQUEST['sr'])){
    $search=$_REQUEST['sr'];  

    if($search==""){    

    }     
    else{
        $searchQuery="SELECT * FROM products WHERE productStatus=1 and productName LIKE '%$search%'";
        $runSQ=mysqli_query($conn,$searchQuery);
        // count of result
        $count=mysqli_num_rows($runSQ);
 ?>   
<!DOCTYPE html>
<html>
<head>
    <title><?=$search?> - Search Result | Bookship</title>
    <style>
        button{
            padding-top: 1px;
            padding-bottom: 1px;
            width:90px;
            border-color: #ff3333;
            color: white;
            font-family:sans-serif;
            font-weight: bold;
            background-color:#ff3333;
            font-size: 14px;
            margin-bottom: 60px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div style="padding:0.5rem 2rem;color:#ff3333"><h2>SEARCH RESULT</h2></div>
    <div style="padding:0.5rem 4rem" class="resultDesc"><b><?=$count." "?></b>result found for <b>"<?="$search"?>"</b></div>
    <hr style="margin:10px;border-top:1px solid #ff3333">
<?php 
        // list count
        if($count>0){
            while ($getRow = mysqli_fetch_array($runSQ)){
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
<div style="padding:0rem 4rem">
        <div class="result">
            <div class="rBox" style="display:flex;">
                <div id="image" style="margin-top:1rem;"><a href="../public/User_ProductView.php?product=<?=$ID?>"><img src="<?=$productImg?>" alt="" width="100px" height=150px></a></div>
                <div id="details" style="padding:0rem 1rem;">
                    <div style="font-size:24px;padding-bottom:5px;padding-top:5px;"><b><a style="text-decoration:none;color:black;" href="../public/User_ProductView.php?product=<?=$ID?>"><?=$productName?></a></b></div>
                    <div><i><?="by "."$productAuthor"?></i></div>
                    <div style="padding-top:60px;">
                        <a href='cart.php?id=<?=$ID?>' style="text-decoration:none;color:#ff3333;font-size:20px;">
                            <div class="button" style="border:1px solid #ff3333;padding:2px 7px;width:100px;">Add to cart</div>
                        </a></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
            }
        }
    }
}
?>

<?php
include('User_footer.php');
?>
