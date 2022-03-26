<?php
    include '../private/adminheader.php';
    require '../private/dbconnect.php';

    if(isset($_REQUEST['id'])){
        $ID = $_REQUEST['id'];
    
        $editProduct = "SELECT * FROM products WHERE productID='$ID'";
        $run = mysqli_query($conn, $editProduct);
        $rowProduct=mysqli_fetch_array($run);
    
        $pName = $rowProduct['productName'];
        $pCat= $rowProduct['productCat'];
        $pDesc=$rowProduct['productDesc'];
        $pAuthor=$rowProduct['productAuthor'];
        $pCost=$rowProduct['productCost'];
        $pQty=$rowProduct['productQty'];
        $pImg=$rowProduct['productImg'];
        $pDate=$rowProduct['pubDate'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product|Bookship</title>
    <style>
        textarea{
            resize:none;
        }
    </style>
</head>
<body>
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="productName">Book Name:</label><br>
            <input type="text" id="" class="" name="productName" value="<?=$pName?>"><br>

            <label for="">Book Category:</label><br>
            <?php 
            echo '<select name="productCat">';
                $query="SELECT `cat_name` FROM categories where cat_display=0";
                echo '<option style="background:black;color:blue;">'.$pCat.'</option>';
                if($run=mysqli_query($conn,$query)){
                if(mysqli_num_rows($run)>0){
                    while($row=mysqli_fetch_array($run)){
                        echo '<option>'.$row['cat_name'].'</option>';
                    }
                }
            }     
            echo '</select>';         
            ?>
            <!-- <input type="text" id="productCat" class="" name="productCat" ><br> -->
            <br>
            <label for="productDesc">Book Description:</label><br>
            <textarea type="text" rows=8 cols=50 id="productDesc" maxlength="1000" class="" name="productDesc"><?=$pDesc?></textarea><br>

            <label for="productAuthor">Author Name:</label><br>
            <input type="text" id="productAuthor" class="" name="productAuthor" value="<?=$pAuthor?>"><br>

            <label for="productCost">Book Cost:</label><br>
            <input type="number" id="productCost" class="" name="productCost" min=1 value="<?=$pCost?>"><br>
            <div>
            <label for="productImg">Book Image:</label>
            <input type="file" id="productImg" class="" name="productImg" accept="image/*">
            <br>Previous:<img src="<?=$pImg?>" alt="" height=50px width=40px>
            </div>
            <label for="productQty">Quantity:</label><br>
            <input type="number" id="productQty" class="" name="productQty" min=1 value="<?=$pQty?>"><br>

            <label for="pubDate">Published Date</label><br>
            <input type="date" id="pubDate" class="" name="pubDate" value=<?=$pDate?>><br>
            
            <input type="submit">
        </form>
    </div>
</body>
</html>
<?php
    $isvalid=true;
    if($_POST){
        $bookName=$_REQUEST['productName'];
        $bookCategory=$_REQUEST['productCat'];
        $bookDescription=$_REQUEST['productDesc'];
        $bookAuthor=$_REQUEST['productAuthor'];
        $bookCost=$_REQUEST['productCost'];
        // ImageUpload
        $target_dir = "../images/ProductImg/";
        
            
            $check =$_FILES["productImg"]["tmp_name"];
            if($check==""){
                $bookImage=$pImg;
            }
            else{
                $bookImage = $target_dir.basename($_FILES["productImg"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($bookImage,PATHINFO_EXTENSION));
                if($check !== false) {
                    if (file_exists($bookImage)) {
                        echo "<br>Sorry, file already exists.";
                        // $uploadOk = 0;
                        // $isvalid=false;
                    }
                    else{
                        $uploadOk = 1;
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                            echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                            $uploadOk = 0;
                            $isvalid=false;
                        }
                    }
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                    $isvalid=false;
                }
            }
            if ($uploadOk == 0) {
                // $isvalid=false;  
            } else {
                //echo "<br>".$bookImage."<br>";
                if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $bookImage)) {
                } 
                else {
                $isvalid=false;
            }
        }
        //ImageUploadEnd
        $bookQuantity=$_REQUEST['productQty'];
        $bookPublished=$_REQUEST['pubDate'];
        
        if($bookName==""){
            echo '<div class="error">Insert Book Name</div>';
            $isvalid=false;
        }
        if($bookCategory==""){
            echo '<div class="error">Insert Cateogory Name</div>';
            $isvalid=false;
        }
        if($bookDescription==""){
            echo '<div class="error">Insert Book Description</div>';
            $isvalid=false;
        }
        if($bookAuthor==""){
            echo '<div class="error">Insert Author Name</div>';
            $isvalid=false;
        }
        if($bookCost==""){
            echo '<div class="error">Insert Book Cost</div>';
            $isvalid=false;
        }
        if($bookQuantity==""){
            echo '<div class="error">Insert Book Quantity</div>';
            $isvalid=false;
        }
    }
if($_POST){
        if($isvalid){
            $prdtsql = "UPDATE products 
                        SET `productName`='$bookName',`productCat`='$bookCategory',`productDesc`='$bookDescription',
                        `productAuthor`='$bookAuthor',`productCost`=$bookCost,`productImg`='$bookImage',`productQty`=$bookQuantity,`pubDate`='$bookPublished'
                        WHERE `productID`='$ID'";
            $productsql = mysqli_query($conn,$prdtsql);
            if($productsql){
                header('location:viewproduct.php');
            }
    }    
}
    
?>