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
        $tablemsg='No data';
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
</head>
<body>
    <div>
        <h2>Edit Book</h2>
    </div>
    <div class="body-separation">
        <div><?=$msg?></div>
        <div>
            <form action="" method="POST" enctype="multipart/form-data">

            <label for="">Book Name:</label>
            <input type="text" id="" class="" name="productNameEdit" value="<?=$productName?>"><br>

            <label for="">Book Category:</label><br>
            <!-- SELECT CATEGORY INPUT -->
            <?php 
                echo '<select name="productCategoryEdit">';
                $queryeditcat="SELECT `categoryName` FROM categories where categoryStatus=1 and adminID=$adminID";
                echo '<option style="background:black;color:blue;">'.$productCat.'</option>';
                if($runeditcat=mysqli_query($conn,$queryeditcat)){
                    if(mysqli_num_rows($runeditcat)>0){
                        while($roweditcat=mysqli_fetch_array($runeditcat)){
                            echo '<option>'.$roweditcat['categoryName'].'</option>';
                        }
                    }
                }   
            echo '</select>';  //Selection closed       
            ?><br>

            <label for="productDesc">Book Description:</label><br>
            <textarea type="text" rows=8 cols=50 id="productDesc" maxlength="1000" class="" name="productDescEdit"><?=$productDesc?></textarea><br>

            <label for="productAuthor">Author Name:</label><br>
            <input type="text" id="productAuthor" class="" name="productAuthorEdit" value="<?=$productAuthor?>"><br>

            <label for="productCost">Book Cost:</label><br>
            <input type="number" id="productCost" class="" name="productCostEdit" min=1 value="<?=$productCost?>"><br>

            <label for="productImg">Book Image:</label>
            <input type="file" id="productImg" class="" name="productImgEdit" accept="image/*">
            <br>Previous:<img src="<?=$pImg?>" alt="" height=50px width=40px><br>
                
            <label for="productQty">Quantity:</label><br>
            <input type="number" id="productQty" class="" name="productQtyEdit" min=1 value="<?=$productQty?>" ><br>

            <label for="pubDate">Published Date</label><br>
            <input type="date" id="pubDate" class="" name="productPublishedEdit" value="<?=$productDate?>"><br>
                
            <input type="submit" name="product-edit-submit" >  
                
            </form>
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
            echo "Successfully edited.";
        } 
     
}
}
?>
<hr>
        <!-- ********************************************DIVISION********************************************* -->
        <div><?=$tablemsg?></div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Book category</th>
                        <th>Book Description</th>
                        <th>Book Cost</th>
                        <th>Book Image</th>
                        <th>Product Quantity</th>
                        <th>Published Date</th>
                        <th>Management</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $queryTable="SELECT * FROM products WHERE adminID=$adminID GROUP BY productPublished desc";
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
                        <td><b><?=$productName?></b><br><br><div align=left><i>By <?=$productAuthor?></i><div></td>
                        <td><?=$productCat?></td>
                        <td><textarea name="" id="" cols="30" rows="2"><?=$productDesc?></textarea></td>
                        <td><?=$productCost?></td>
                        
                        <td><a href='<?=$productImg?>' target="_blank"><img src='<?=$productImg?>'height='90px' width='70px'></a></td>
                        <td><?=$productQty?></td>
                        <td><?=$published?></td>
                        <td><a href='http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$ID?>'>[EDIT]</a> <a href='http://localhost:8081/bookship/private/Admin_product_delete.php?deleteID=<?=$ID?>'>[HIDE]</a></td>
                    </tr>
                    <?php
                            } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>