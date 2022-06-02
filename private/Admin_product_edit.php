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
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/AdminRegLog.css">
    <style>
        #tablr td{
            text-align: center;
        }
        td a{
            text-decoration: none;
            border: 2px solid grey;
            padding: 2px 10px;
        }
        input{
            padding:1px 5px;
        }
        textarea{
            padding:4px;
        }
    </style>
</head>
<body>
    <div>
        <h2 align=center>EDIT BOOK</h2>
    </div>
    <div class="body-separation">
        <div><?=$msg?></div>
        <div style="margin:2rem;">
            <table>
                <form action="" method="POST" enctype="multipart/form-data">

                <tr>
                    <td><label for="">Book Name:</label></td>
                    <td><input type="text" id="" class="" name="productNameEdit" value="<?=$productName?>"></td>

                </tr>
                <tr>
                <td>
                    <label for="">Book Category:</label>
                </td>
                <!-- SELECT CATEGORY INPUT -->
                <td><?php 
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
                ?></td>
</tr>
                <tr>
                    <td><label for="productDesc">Book Description:</label></td>
                    <td><textarea type="text" rows=8 cols=50 id="productDesc" maxlength="1000" class="" name="productDescEdit"><?=$productDesc?></textarea>
                    </td>
                </tr>

                <tr>
                <td><label for="productAuthor">Author Name:</label><br></td>
                <td><input type="text" id="productAuthor" class="" name="productAuthorEdit" value="<?=$productAuthor?>"><br></td>
                </tr>
                <tr>
                <td><label for="productCost">Book Cost:</label><br></td>
                <td><input type="number" id="productCost" class="" name="productCostEdit" min=1 value="<?=$productCost?>"><br></td>
                </tr>
                <tr>
                    <td><label for="productImg">Book Image:</label></td>
                    <td><input type="file" id="productImg" class="" name="productImgEdit" accept="image/*"></td>
                </tr>
                <tr>
                <td><br>Previous:<img src="<?=$pImg?>" alt="" height=50px width=40px><br></td>
                </tr>
                <tr>
                    <td><label for="productQty">Quantity:</label></td>
                    <td><input type="number" id="productQty" class="" name="productQtyEdit" min=1 value="<?=$productQty?>" ></td>
                </tr>
                <tr>
                <td><label for="pubDate">Published Date</label></td>
                <td><input type="date" id="pubDate" class="" name="productPublishedEdit" value="<?=$productDate?>"></td>
                </tr>
                
                    
                <tr>
                    <td><input type="submit" name="product-edit-submit" >  </td>
                </tr>
                    
                </form>
            </table>
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
        <div id="tablr">
            <table>
                <thead>
                <tr class="table-head" width=100% style="background:red;color:white;text-align:center">
                        <th width=10% scope="col" style="border-right:1px solid black;">Name</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Category</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Description</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Cost</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Image</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Quantity</th>
                        <th width=15% scope="col" style="border-right:1px solid black;">Published On</th>
                        <th width=15% scope="col" style="border-right:1px solid black;">Management</th>
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
                        
                        <td><a href='<?=$productImg?>' target="_blank" style="border:0px;"><img src='<?=$productImg?>'height='90px' width='70px'></a></td>
                        <td><?=$productQty?></td>
                        <td><?=$published?></td>
                        <td><a href='http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$ID?>' style="background-color:blue;color:white;">EDIT</a> <a href='http://localhost:8081/bookship/private/Admin_product_delete.php?deleteID=<?=$ID?>' style="background-color:red;color:white;">HIDE</a></td>
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