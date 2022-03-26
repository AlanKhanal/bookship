<?php
    include '../private/adminheader.php';
    include '../private/dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product|Bookship</title>
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
            <input type="text" id="productName" class="" name="productName" ><br>

            <label for="">Book Category:</label><br>
            <?php 
            echo '<select name="productCat">';
                $query="SELECT `cat_name` FROM categories where cat_display=0";
                echo '<option>Select Category</option>';
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
            <textarea type="text" rows=8 cols=50 id="productDesc" maxlength="1000" class="" name="productDesc"></textarea><br>

            <label for="productAuthor">Author Name:</label><br>
            <input type="text" id="productAuthor" class="" name="productAuthor" ><br>

            <label for="productCost">Book Cost:</label><br>
            <input type="number" id="productCost" class="" name="productCost" min=1 value=1><br>

            <label for="productImg">Book Image:</label>
            <input type="file" id="productImg" class="" name="productImg" accept="image/*"><br>
            
            <label for="productQty">Quantity:</label><br>
            <input type="number" id="productQty" class="" name="productQty" min=1 value=1 ><br>

            <label for="pubDate">Published Date</label><br>
            <input type="date" id="pubDate" class="" name="pubDate"><br>
            
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
        $bookImage = $target_dir.basename($_FILES["productImg"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($bookImage,PATHINFO_EXTENSION));
            
            $check =$_FILES["productImg"]["tmp_name"];
            if($check==""){
                echo 'Insert Book Photo';
            }
            else{
                if($check !== false) {
                    if (file_exists($bookImage)) {
                        echo "<br>Sorry, file already exists.";
                        $uploadOk = 0;
                        $isvalid=false;
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
                $isvalid=false;  
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
            $prdtsql = "INSERT INTO products(`productName`,`productCat`,`productDesc`,`productAuthor`,`productCost`,`productImg`,`productQty`,`pubDate`) 
            VALUES('$bookName','$bookCategory','$bookDescription','$bookAuthor',$bookCost,'$bookImage',$bookQuantity,'$bookPublished')";
            $productsql = mysqli_query($conn,$prdtsql);
            if($productsql){
                header('location:viewproduct.php');
            }
    }    
}
    
?>