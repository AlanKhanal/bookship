<?php
if(isset($_REQUEST['product-submit'])){
    $valid=true;
    $msg="";
    $productName=$_REQUEST["productName"];
    $productDesc=$_REQUEST["productDesc"];
    $productCategory=$_REQUEST["productCategory"];
    $productAuthor=$_REQUEST["productAuthor"];
    $productCost=$_REQUEST["productCost"];
    $productQty=$_REQUEST["productQty"];
    $productDate=$_REQUEST["productPublished"];
    
    //validation
    //productName
    if($productName==""){
        $msg.="Enter book name.<br>";
        $valid=false;
    }
    elseif(strlen($productName)>250){
        $msg.="Book name can only be of 250 characters.<br>";
        $valid=false;
    }
    //productDesc
    
    if(strlen($productDesc)>2000){
        $msg.="Book name can only be of 2000 characters.<br>";
        $valid=false;
    }
    //productCategory
    if($productCategory==""){
        $msg.="Select category.<br>";
        $valid=false;
    }
    elseif($productCategory=="Select Category"){
        $msg.="Select category.<br>";
        $valid=false;
    }
    //productAuthor
    if($productAuthor==""){
        $msg.="Enter Author name<br>";
        $valid=false;
    }
    elseif(strlen($productAuthor)>250){
        $msg.="Author name can only be of 250 characters.<br>";
        $valid=false;
    }
    //productQty
    if($productQty==""){
        $msg.="Enter book quantity.<br>";
        $valid=false;
    }
    elseif($productQty<1){
        $msg.="Product quantity cannot be 0.<br>";
        $valid=false;
    }
    //productCost
    if($productCost==""){
        $msg.="Enter product cost.<br>";
        $valid=false;
    }
    else if($productCost<0){
        $msg.="Book cost cannot be negative.<br>";
        $valid=false;
    }
    //productImg
    $target_dir = "../images/ProductImg/";
        $bookImage = $target_dir.basename($_FILES["productImg"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($bookImage,PATHINFO_EXTENSION));
            
            $check =$_FILES["productImg"]["tmp_name"];
            if($check==""){
                $msg.= 'Insert Book Photo.<br>';
            }
            else{
                if($check !== false) {
                    if (file_exists($bookImage)) {
                        // $msg.= "<br>Sorry, file already exists.<br>";
                        // $uploadOk = 0;
                        // $valid=false;
                    }
                    else{
                        $uploadOk = 1;
                        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                            $msg.= "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                            $uploadOk = 0;
                            $valid=false;
                        }
                    }
                } else {
                    $msg.= "File is not an image.<br>";
                    $uploadOk = 0;
                    $valid=false;
                }
            }
            if ($uploadOk == 0) {
                $valid=false;  
            } else {
                //echo "<br>".$bookImage."<br>";
                if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $bookImage)) {
                } 
                else {
                $valid=false;
            }
            //date
            // if($productDate==""){
            //     $msg.="Enter published date";
            // }
        }
        if($valid){
            //Check if the product is already in database
            $checkProduct2="SELECT `adminID`,`productName`,`productAuthor`,`productCategory` FROM products WHERE adminID=$adminID AND productName='$productName' AND productAuthor='$productAuthor' AND productCategory='$productCategory'";
            $runcheck2=mysqli_query($conn,$checkProduct2);
            if(mysqli_num_rows($runcheck2)>0){
                $msg.="Book already exists";
                header('location:../private/Admin_product_edit.php');
                $valid=false;
            }
            else{
                $insertProduct="INSERT INTO products(`adminID`,`productName`,`productDesc`,`productCost`,`productQty`,`productPublished`,`productImg`,`productCategory`,`productAuthor`) 
                VALUES($adminID,'$productName','$productDesc','$productCost',$productQty,'$productDate','$bookImage','$productCategory','$productAuthor')";
                $runInsert=mysqli_query($conn,$insertProduct);
            }
            
        }
}

?>