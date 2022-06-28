
<?php
include ('../private/dbconnect.php');
$msg="";
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
//
// fetching cartinfo
    $query32 = "SELECT * FROM cart WHERE userID=$userID";
    $query_run = mysqli_query($conn,$query32);
    $qtytot= 0;
    while ($num = mysqli_fetch_assoc ($query_run)) {
        $qtytot += $num['totPrice'];
    }
    $query33 = "SELECT * FROM cart WHERE userID=$userID";
    $query_run2 = mysqli_query($conn,$query33);
    $qty2= 0;
    while ($num = mysqli_fetch_assoc ($query_run2)) {
        $qty2 += $num['qty'];
    }
    // $query34 = "SELECT distinct(`uniquecart`) FROM cart WHERE userID=$userID";
    // $query_run34 = mysqli_query($conn,$query34);
    // // $qtytot= 0;
    // while ($num34 = mysqli_fetch_assoc ($query_run34)) {
    //     echo $num34['uniquecart'];
    // }
    if(isset($_REQUEST['uqid'])){
        $uqid=$_REQUEST['uqid'];
    }
//
// personDetails
if(isset($_REQUEST['submit'])){
    $valid=true;

    $name=trim($_REQUEST['name']);
    $email=trim($_REQUEST['mail']);
    $number=trim($_REQUEST['number']);

    if($name==""){
        $msg.="Insert Full Name.*<br>";
        $valid=false;
    }
    elseif(strlen($name)<2){
        $msg.="Please insert full name.*";
    }
    if($email==""){
        $msg.="Insert email.*<br>";
        $valid=false;
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg.= "Invalid email format*.<br>";
        $valid=false;
      }
    if($number==""){
        $msg.="Insert Phone number.*<br>";
        $valid=false;
    }
// address
    $state=trim($_REQUEST['state']);
    $city=trim($_REQUEST['city']);
    $street=trim($_REQUEST['street']);
    $hoNo=trim($_REQUEST['houseNumber']);
    $pCode=trim($_REQUEST['pCode']);

    if($state==""){
        $msg.="Insert state number.*<br>";
        $valid=false;
    }
    if($city==""){
        $msg.="Insert city.*<br>";
        $valid=false;
    }
    if($street==""){
        $msg.="Insert street.*<br>";
        $valid=false;
    }
// payment
    if(empty($_REQUEST['payment'])){
        $msg.="Payment method required to proceed.*<br>";
        $valid=false;
    }
    else{
        $pay=$_REQUEST['payment'];
    }
//ifvalid
    if($valid){
        $uqidCheck="SELECT * FROM customerinfo WHERE uniquecart='$uqid'";
        $run_check=mysqli_query($conn,$uqidCheck);
        if (mysqli_num_rows($run_check) == 0){
            $userInfo="INSERT INTO customerinfo(`userID`,`customer`,`mail`,`phno`,`state`,`city`,`street`,`hono`,`postC`,`method`,`uniquecart`) 
            VALUES($userID,'$name','$email','$number','$state','$city','$street','$hoNo','$pCode','$pay','$uqid')";
            if(mysqli_query($conn,$userInfo)){
                if($pay=="esewa"){
                    header("location:esewa.php?trsid=$uqid");
                }
                elseif($pay=="cash"){
                    header("location:onhand.php?trsid=$uqid");
                }
            }
        }
        elseif(mysqli_num_rows($run_check) ==1){
                $userInfo="UPDATE customerinfo SET `customer`='$name',`mail`='$email',`phno`='$number',`state`='$state',`city`='$city',`street`='$street',`hono`='$hoNo',`postC`='$pCode',`method`='$pay' WHERE userID=$userID and uniquecart='$uqid'";
                if(mysqli_query($conn,$userInfo)){
                    if($pay=="esewa"){
                        header("location:esewa.php?trsid=$uqid");
                    }
                    elseif($pay=="cash"){
                        header("location:onhand.php?trsid=$uqid");
                    }
                }
        }

        // $uniqueID=uniqid();
        // if($pay=="esewa"){
        //     $userInfo="INSERT INTO customerinfo(`customer`,`mail`,`phno`,`state`,`city`,`street`,`hono`,`postC`,`method`,`uniquecart`) VALUES('$name','$email','$number','$state','$city','$street','$hoNo','$pCode','$pay','$uqid')";
        //     if(mysqli_query($conn,$userInfo)){
        //         header("location:esewa.php");
        //     }
        //     else{
        //         echo"unable to pay by eSewa.";
        //     }
        // }
        // elseif($pay=="cash"){
        //     $userInfo="INSERT INTO customerinfo(`userID`,`customer`,`mail`,`phno`,`state`,`city`,`street`,`hono`,`postC`,`method`,`uniquecart`) 
        //     VALUES($userID,'$name','$email','$number','$state','$city','$street','$hoNo','$pCode','$pay','$uqid')";
        //     if(mysqli_query($conn,$userInfo)){
        //         header("location:onhand.php?ID=$userID");
        //     }
        //     else{
        //         echo"unable to pay on delivery.";
        //     }
        // }
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
    <title>Information || Bookship</title>
    <link rel="stylesheet" href="cart.css">
    <style>
    
        body{
            background-color:white !important; 
        }
        #buy{
            text-decoration:none;
            color:white;
            font-size:20px;
            font-weight:bold;
            border:2px solid #00cc00;
            border-radius:5px;
            padding:2px 20px;
            background-color:#00cc00;
            margin: 0.5rem 0rem;
        }
        #buy:hover{
            transform: scaleX(1.1);
            border:2px solid green;
            background-color: green;
        }
        td{
            padding:1rem 5rem;
            background-color: #20214a;
            color: white;
        }
        th{
            background-color: #fa5012;
            color:white;
            padding:0.5rem;
        }
        /* infor */
        #information{
            border: 2px solid #20214a;
            /* padding:1rem; */
            margin:2rem;
            margin: 2% 20%;
        }
        #perInfo{
        /* display:flex;
        justify-content:space-around;
        flex-wrap: wrap; */
        padding:0.5rem;
        text-align: center;        
    }
        .combo{
        font-weight: 600;
            /* display:flex; */
        }
        .combo input{
            width: 55%;
            padding: 3px;
            margin: 4px;
            font-size: 18px;
            border:2px solid #20214a;
            border-radius: 5px;
        }
        label{
            margin: 5px;
            font-size: 20px;
        }
        .infoHead{
            background-color: #fa5012;
            color:white;
            padding:2px 10px;
            margin: 0px;
            text-align: center;
        }
        .pay{
            display: flex;
            border: 2px solid #20214a;
            padding:5px;
            margin-right: 1rem;
        }
        /* .combo{
            background-color: #20214a;
            color: white;
        } */
    </style>
</head>
<body>
        <div align="center">
    <h1 align="center">ORDER SUMMARY</h1>
        <table>
                                    <tr>
                                        <th>BOOK(QTY)</th>
                                        <th>PER BOOK</th>
                                        <th>TOTAL PRICE</th>
                                    </tr>
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
                            <!-- <div style="display:flex;justify-content:space-between;"> -->
                                    <tr>
                                        <td><?=$name." <b>(".$qty.")</b>"?></td>
                                        <td><?="NPR.".$price?></td>
                                        <td><?="NPR.".$qty*$price?></td>
                                    </tr>
                                
                            </div>
                                
                            <?php
                        }?>
                            <tr>
                                <td ><b>TOTAL<?=" (".$qty2.")"?></b></td>
                                <td ></td>
                                <td ><b><?="NPR.".$qtytot?></b></td>
                            </tr>
                        </table>
                        </div>
                        <?php
                    }
                }
            ?>
<!-- information -->
<h1 align="center">SHIPPING DETAILS</h1>
<div style="color:red;font-style:italic;text-align:center;">
            <?php echo $msg;?>
        </div>
<div id="information">
    <!-- Personal Details -->
    <h2 class="infoHead">PERSONAL DETAILS</h2>
    <div id="perInfo">
        <form action="" method="POST">
            <input type="text" value=<?=$userID?> name="userID" hidden>
            <div class="combo">
                <label for="">Full Name*</label><br>
                <input type="text" class="inputInfor" placeholder="<?=$userName?>" name="name">
            </div>
            <div class="combo">
                <label for="">E-mail*</label><br>
                <input type="email" class="inputInfor" placeholder="<?=$userEmail?>" name="mail">
            </div>
            <div class="combo">
                <label for="">Contact Number*</label><br>
                <input type="text" class="inputInfor" name="number">
            </div>
    </div>
    <!-- Shipping details -->
    <h2 class="infoHead">ADDRESS DETAILS</h2>
    <div id="perInfo">
            <div class="combo">
                <label for="">State*</label><br>
                <input type="number" class="inputInfor" placeholder="Eg:3" name="state" min=1 max=7>
            </div>
            <div class="combo">
                <label for="">City*</label><br>
                <input type="text" class="inputInfor" placeholder="Eg:Gandaki" name="city">
            </div>
            <div class="combo">
                <label for="">Street*</label><br>
                <input type="text" class="inputInfor" name="street">
            </div>
            <div class="combo">
                <label for="">House Number</label><br>
                <input type="text" class="inputInfor" name="houseNumber">
            </div>
            <div class="combo">
                <label for="">Postal code</label><br>
                <input type="text" class="inputInfor" name="pCode">
            </div>
            <div>
            </div>
    </div>
    <div id="paymentBox">
        <h2 class="infoHead">PAYMENT OPTIONS</h2>
        <div id="perInfo" style="display:flex;flex-wrap:wrap;">
                <div class="pay">                    
                    <div>
                        <input type="image" src="../icon/esewa.png" width="100px" height="100px"><br>
                        <label for="eSewa">eSewa</label>
                    </div>
                    <div>
                    <input type="radio" id="eSewa" name="payment" value="esewa">
                    </div>
                </div>
                <div class="pay">
                    <div>
                        <label for="onhand"><input type="image" src="../icon/oncash.png" alt="" width="100px" height="100px"><br>
                        On hand</label>
                    </div>
                    <div><input type="radio" id="onhand" name="payment" value="cash"></div>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div align="center">
        <input type="submit" name="submit" value="BUY" id="buy">
    </div>
</form>
        
</body>
</html>
<?php
include('User_footer.php');
?>
