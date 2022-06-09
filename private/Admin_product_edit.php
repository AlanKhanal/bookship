<?php
include 'dbconnect.php';
$msg="";
$tablemsg="";
//session start
session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location:Admin_login.php");
    }
    else{

    }
    $admin = $_SESSION['adminName'];
    $query = "SELECT * FROM admins WHERE adminName='$admin'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $adminID=$row['adminID'];
        // $adminName=$row['adminName'];
        // $adminEmail=$row['email'];
        // $companyName=$row['companyName'];
        // $companyAddress=$row['companyAddress'];
    }
include '../private/admin-header-nav.php';
include '../private/Admin_product_management_BE.php';

if(isset($_REQUEST['productID'])){
    $productIDedit=$_REQUEST['productID'];

    if($productIDedit!=is_numeric($productIDedit)){
        header("location:../public/Admin_product_management.php");
    }
}
else{
    header("location:../public/Admin_product_management.php");
}
?>

<!-- FETCH TABLE DATA -->
<?php
    $queryfetch="SELECT * FROM products WHERE productStatus=1 and adminID=$adminID and productID=$productIDedit";
    $runQuery1=mysqli_query($conn,$queryfetch);
    if (mysqli_num_rows($runQuery1) > 0){
        while($row = mysqli_fetch_assoc($runQuery1)) {
            $productName=$row['productName'];
            $productDesc=$row['productDesc'];
            $productAuthor=$row['productAuthor'];
            $productCost=$row['productCost'];
            $productQty=$row['productQty'];
            $productDate=$row['productPublished'];
            $productCat=$row['productCategory'];
            $pImg=$row['productImg'];
            //Table data here
        }
    }
    else{
        header("location:../public/Admin_product_management.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <!-- <style>
        .body-separation{
            display: flex;
            justify-content: space-around;
            margin:0px 5px;
        }
    </style> -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/AdminRegLog.css">
    <style>
        .container label{
            font-weight: 600;

        }
        .container input,textarea,select{
            border:2px solid black;
            margin-bottom: 1rem;
            padding: 0.2rem 0.4rem;
            border-radius: 7px;
            width: 72%;
        }
        .container td a{
            text-decoration: none;
            color:white;
        }
        .container td a:hover{
            color:gray;
        }
        .container td textarea{
            border: 1px solid white;
            background-color:beige;
            color:gray;
        }
        .container .submit:hover{
            transform: scaleX(1.1);
        }
        .container .submit{
            padding: 0.2rem;
            border: 2px solid white;
            background-color: #212529;
            color:white;
            font-weight: 600;
            padding:0.4rem 0.5rem;
            width: 100%;
        }
        .prtable{
            width:100%;
        }
        .prtable td{
            width:auto;
        }
    </style>
</head>
<body>
<h2 style="margin-left:2rem;font-family:Georgia, 'Times New Roman', Times, serif">UPDATE BOOK</h2>
     <div class="container">
        <div class="add">
            <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="">NAME:</label></td>
                    <td><input type="text" id="" class="" name="productNameEdit" value="<?=$productName?>"></td>
                    <td><label for="productCost">PRICE:</label></td>
                    <td><input type="number" id="productCost" class="" name="productCostEdit" min=1 value=<?=$productCost?>></td>
                </tr>
                <!-- SELECT CATEGORY INPUT -->

               <tr>
               <td><label for="productAuthor">AUTHOR:</label></td>
                    <td><input type="text" id="productAuthor" class="" name="productAuthorEdit" value="<?=$productAuthor?>"><br></td>
                   <td><label for="">CATEGORY:</label></td>
                    <td>
                        <?php 
                        echo '<select name="productCategoryEdit">';
                            $query="SELECT `categoryName` FROM categories where categoryStatus=1 ORDER BY categoryName asc";
                            echo '<option>'.$productCat.'</option>';
                            if($run=mysqli_query($conn,$query)){
                            if(mysqli_num_rows($run)>0){
                                while($row=mysqli_fetch_array($run)){
                                    echo '<option>'.$row['categoryName'].'</option>';//category options 
                                }
                            }
                        }     
                        echo '</select>';  //Selection closed       
                        ?>
                    </td>
                </tr>    
                <tr>
                    <td><label for="productQty">QUANTITY:</label></td>
                    <td><input type="number" id="productQty" class="" name="productQtyEdit" min=1 value=<?=$productQty?>></td>

                    <td><label for="pubDate">PUBLISHED ON: </label></td>
                    <td><input type="date" id="pubDate" class="" name="productPublishedEdit" value="<?=$productDate?>"></td>
                </tr>
                <tr>
                    <td><label for="productImg">IMAGE:</label></td>
                    <td><input type="file" id="productImg" class="imageClass" name="productImgEdit" accept="image/*" style="border:none"></td>
                </tr>
                <tr>
                    <td><label><i>previous image:</i></label></td><td><img src="<?=$pImg?>" alt="" height=50px width=40px><br></td>
                </tr>
                <tr>
                    <td> <label for="productDesc">DESCRIPTION:</label></td>
                    <td colspan="3"><textarea type="text" rows=3 cols="" id="productDesc" maxlength="1000" class="" name="productDescEdit" style="border:2px solid black;background:white;"><?=$productDesc?></textarea></td>
                </tr>  
                <tr>
                    <td><input type="submit" name="product-edit-submit" class="submit" value="UPDATE"> </td> 
                </tr>
                <tr>
                <div><?=$msg?></div>
                </tr>
            </table> 
            </form>
        </div>
     </div>
<?php

$valid=true;
if(isset($_REQUEST['product-edit-submit'])){
    
    $editmsg="";
    $editName=$_REQUEST['productNameEdit'];
    $editDesc=$_REQUEST['productDescEdit'];
    $editAuthor=$_REQUEST['productAuthorEdit'];
    $editCost=$_REQUEST['productCostEdit'];
    $editQty=$_REQUEST['productQtyEdit'];
    $editDate=$_REQUEST['productPublishedEdit'];
    $editCat=$_REQUEST['productCategoryEdit'];
    // ImageUpload
    $target_dir = "../images/ProductImg/";
        
    $uploadOk = 1;    
    $check =$_FILES["productImgEdit"]["tmp_name"];
    if($check==""){
        $bookImage=$pImg;
        // echo 'nice';
    }
    else{
        $bookImage = $target_dir.basename($_FILES["productImgEdit"]["name"]);
        
        $imageFileType = strtolower(pathinfo($bookImage,PATHINFO_EXTENSION));
        if($check !== false) {
            if (file_exists($bookImage)) {
                echo "<br>Sorry, Image already exists.<br>";
                $uploadOk = 0;
                $valid=false;
            }
            else{
                $uploadOk = 1;
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $valid=false;
                }
            }
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
            $valid=false;
        }
    }
    if ($uploadOk == 0) {
        // $isvalid=false;  
    } else {
        // echo "<br>".$bookImage."<br>";
        if (move_uploaded_file($_FILES["productImgEdit"]["tmp_name"], $bookImage)) {
        } 
        else {
        $valid=false;
    }
}
//ImageUploadEnd

if($editName==""){
    echo '<div class="error">Insert Book Name</div>';
    $valid=false;
}
if($editCat==""){
    echo '<div class="error">Insert Cateogory Name</div>';
    $valid=false;
}
// elseif($productCategory==$productCat){
//     $msg.="Select category.<br>";
//     $valid=false;
// }
if(strlen($editDesc)>2000){
    echo '<div class="error">Book Description can only be of 2000 characters.</div>';
    $valid=false;
}
if($editAuthor==""){
    echo '<div class="error">Insert Author Name</div>';
    $valid=false;
}
elseif(strlen($editAuthor)>250){
    $msg.="Author name can only be of 250 characters.<br>";
    $valid=false;
}
if($editCost==""){
    echo '<div class="error">Insert Book Cost</div>';
    $valid=false;
}
if($editCost<0){
    echo '<div class="error">Cost cannot be less than 0.</div>';
    $valid=false;
}
if($editQty==""){
    echo '<div class="error">Insert Book Quantity</div>';
    $valid=false;
}
if($editQty<1){
    echo '<div class="error">Quantity cannot be less than 1.</div>';
    $valid=false;
}
if($editDate==""){
    echo '<div class="error">Insert Book Quantity</div>';
    $valid=false;
}
if($valid=true){
        $prdtsql = "UPDATE products 
        SET `productName`='$editName',`productCategory`='$editCat',`productDesc`='$editDesc',
        `productAuthor`='$editAuthor',`productCost`=$editCost,`productImg`='$bookImage',`productQty`=$editQty,`productpublished`='$editDate'
        WHERE `productID`=$productIDedit AND adminID=$adminID";
        $productsql = mysqli_query($conn,$prdtsql);
        if($productsql){
            echo "<b><i style='color:blue;margin:0rem 2rem;'>Successfully edited.</i></b>";
        } 
     
}
}
?>
<hr>
        <!-- ********************************************DIVISION********************************************* -->
        <div style="display:flex;justify-content:space-between;margin:0rem 2rem;">
            <div><h2 align=center style="font-family:Georgia, 'Times New Roman', Times, serif">BOOKS</h2></div>
            <form action="" method="POST">
              <input type="text" name="search" placeholder="Search Category">
              <input type="submit" name="prdSearch" value="SEARCH" style="background-color:#212529;color:white;border:2px solid white;font-weight:600;padding:0.rem 0.4rem;border-radius:5px">
          </form>
            <!-- <div>
                <form action="" method="POST">
                    <input type="search" name="search">
                    <input type="submit" name="search" value="SEARCH">
                </form>
            </div> -->
        </div>
        <div><?=$tablemsg?></div>
        <div class="prtable">
            <table class="table table-striped table-dark" width=auto style="font-size:1rem;">
                <thead>
                <tr style="background:black;color:white;text-align:center;border-top:2px solid white;">
                        <th style="background:black;color:white;text-align:center">Name</th>
                        <th style="background:black;color:white;text-align:center">Category</th>
                        <th style="background:black;color:white;text-align:center">Desc</th>
                        <th style="background:black;color:white;text-align:center">Cost</th>
                        <th style="background:black;color:white;text-align:center">Image</th>
                        <th style="background:black;color:white;text-align:center">Qty</th>
                        <th style="background:black;color:white;text-align:center">Date</th>
                        <th style="background:black;color:white;text-align:center">Option</th>
                  </tr>
                </thead>


                <tbody>
                    <?php
                        $queryTable="SELECT * FROM products WHERE adminID=$adminID and productStatus=1 ORDER BY productPublished desc";
                        if(isset($_REQUEST['prdSearch'])){
                            $csrch=$_REQUEST['search'];
                            // echo $csrch;
                            $queryTable="SELECT * FROM products WHERE adminID=$adminID and productStatus=1 and productName LIKE '%$csrch%' ORDER BY productPublished desc";
                            // echo "Search result for $csrch";
                        }
                        $runTable=mysqli_query($conn,$queryTable);
                        while ($row = mysqli_fetch_array($runTable)){
                            $ID=$row['productID'];
                            $productName=$row['productName'];
                            $productDesc=$row['productDesc'];
                            $productCat=$row['productCategory'];
                            $productCost=$row['productCost'];
                            $productQty=$row['productQty'];
                            $productImg=$row['productImg'];
                            $productAuthor=$row['productAuthor'];
                            $published=$row['productPublished'];
                    ?>


                    <tr>
                        <!-- <th scope="row"></th> -->
                        <td><b><?=$productName?></b><br><br><div align=left><i>By <?=$productAuthor?></i><div></td>
                        <td><?=$productCat?></td>
                        <td><textarea name="" id="" cols="20" rows="2"><?=$productDesc?></textarea></td>
                        
                        <td>NPR.<?=$productCost?></td>
                        <td><a href='<?=$productImg?>' target="_blank"><img src='<?=$productImg?>'height='90px' width='70px'></a></td>
                        <td><?=$productQty?></td>
                        <td><?=$published?></td>
                        <td>
                            <button class="btn btn-primary"><a href="http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$ID?>" class="text-light">EDIT</a></button>
                            <button class="btn btn-danger"><a href="http://localhost:8081/bookship/private/Admin_product_delete.php?deleteID=<?=$ID?>" class="text-light">HIDE</a></button>
                        </td>
                    </tr>
                    <!-- <?php
                            } 
                    ?> -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
include '../private/Admin_product_management_BE.php';
?>