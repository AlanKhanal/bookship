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
    if(isset($_REQUEST['trsid'])){
        $uqid=$_REQUEST['trsid'];
        if(strlen($uqid)==0){
            header("location:User_home.php");
        }
    }
    include ('../private/User_nav.php');

        $getcustInfo="SELECT * FROM customerinfo WHERE uniquecart='$uqid' and userID=$userID";
        $rungetcust=mysqli_query($conn,$getcustInfo);
        if (mysqli_num_rows($rungetcust) > 0){
            $row2 = mysqli_fetch_assoc($rungetcust);
            $custname=$row2['customer'];
            $email=$row2['mail'];
            $street=$row2['street'];
            $state=$row2['state'];
            $city=$row2['city'];
            $hono=$row2['hono'];
            $postC=$row2['postC'];
            $method=$row2['method'];
            $status=$row2['status'];
            $phno=$row2['phno'];
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Purchase | on delivery</title>
    <style>
        td{
            padding:3px 6px;
            font-size: 18px;
        }
        .heads{
            /* font-weight: 600; */
            padding: 2px 10px;
        }
        .detail{
            font-weight: 700;
            padding: 2px 10px;
        }
        ul{
            padding:5px 30px;
        }
        .purchase{
            margin:1rem;
        }
        h2{
            padding:0rem 1rem;
        }
        .cancel{
            padding:0.4rem 1rem;
            margin:0.2rem;
            border-radius:5px;
            color: white;
            border:1px solid red;
            background-color: red;
            font-weight: 600;
        }
        .conf{
            padding:0.4rem 1rem;
            margin:0.2rem;
            border-radius:5px;
            color: white;
            border:1px solid #00cc00;
            background-color: #00cc00;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div align="center" class="purchase">
        <h2>CONFIRM PURCHASE</h2>
            <table align="center" border="2px solid grey">
                <tr>
                    <td class="heads">Receiver name</td>
                    <td class="detail"><?=$custname?></td>
                </tr>
                <tr>
                    <td class="heads">Address</td>
                    <td class="detail"><?="State:".$state."<br>City:".$city."<br>Street:".$street."<br>House number:".$hono."<br>Postal Code:".$postC?></td>
                </tr>
                <tr>
                    <td class="heads">Contact</td>
                    <td class="detail"><?=$phno?></td>
                </tr>
                <tr>
                    <td class="heads">Books</td>
                    <td class="detail">
                        <div>
                            <?php
                                $books="SELECT * FROM cart WHERE uniquecart='$uqid' and userID='$userID'";
                                $connbook=mysqli_query($conn,$books);
                                if(($totRows=mysqli_num_rows($connbook)) > 0){
                                    while($Row3=mysqli_fetch_array($connbook)){
                                        $name=$Row3['name'];
                                        $author=$Row3['auth'];
                                        $desc=$Row3['pDesc'];
                                        $qty=$Row3['qty'];
                                        $price=$Row3['price'];
                                        $prdPrice=$Row3['prdPrice'];
                                        $img=$Row3['img'];
                                        $orgqty=$Row3['orgqty'];
                                        $totPrice=$Row3['totPrice'];
                            ?>
                            <ul type="square">
                                <li><?="<u>".$name."</u>"."<div style='font-size:16px;font-weight:500'>Quantity: ".$qty?>
                                    <br>
                                    <?="per book: NPR.".$price."<br>TOTAL: ".$totPrice."</div>"?>
                                </li>
                            </ul>
                            <?php
                                    }
                                }
                            ?>
                        </div>    
                    </td>
                </tr>
                <tr>
                    <td class="heads">Price</td>
                    <td class="detail"><?php
                    $query32 = "SELECT * FROM cart WHERE userID=$userID";
                    $query_run = mysqli_query($conn,$query32);
                    $qty2= 0;
                    while ($num = mysqli_fetch_assoc ($query_run)) {
                        $qty2 += $num['totPrice'];
                    }
                    echo "<b>NPR.".$qty2."</b>";
                ?></td>
                </tr>
                <tr>
                    <td class="heads">Payment method</td>
                    <td class="detail"><?=$method?></td>
                </tr>
            </table>
            <?php $randomID=uniqid(); ?>
            <form action="" method="POST">
                    <input type="submit" name="cancelBuy" value="CANCEL" class="cancel"><br>
                    
            </form>
            <form action="https://uat.esewa.com.np/epay/main" method="POST">
                <input value="<?=$qty2?>" name="tAmt" type="hidden">
                <input value="<?=$qty2?>" name="amt" type="hidden">
                <input value="0" name="txAmt" type="hidden">
                <input value="0" name="psc" type="hidden">
                <input value="0" name="pdc" type="hidden">
                <input value="EPAYTEST" name="scd" type="hidden">
                <input value="<?=$randomID?>" name="pid" type="hidden">
                <input value="http://localhost:8081/bookship/public/purchaseConfirm.php?trsid=<?=$uqid?>" type="hidden" name="su">
                <input value="http://merchant.com.np/page/esewa_payment_failed?q=fu" type="hidden" name="fu">
                <input value="Submit" type="submit" class="conf">
            </form>
            <a href="buyerInfo.php">Incorrect detail?</a>
    </div>
</body>
</html>
<?php
include('User_footer.php');
?>