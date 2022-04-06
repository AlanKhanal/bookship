<?php
$msg="";
//get
if(isset($_REQUEST['category'])){
    
    $category2=$_REQUEST['category'];
    
    $getData= "SELECT * FROM categories WHERE categoryName='$category2' AND adminID=$adminID";
    $runQuery = mysqli_query($conn,$getData);
    if (mysqli_num_rows($runQuery) ==1){
        // output data of each row
        while($row2 = mysqli_fetch_assoc($runQuery)) {
            $categoryName2=$row2["categoryName"];
            $catDesc2=$row2["categoryDesc"];
        }
    }
    else{
        $msg.="Invalid category. Couldn't update.";
    }
    // if($categoryName2!=$category2){
    //     header('location:../public/Admin_category_management.php');
    // }
} 

else{
    $msg.="No update";

}
// include 'Admin_category_edit_BE';
//categoryAdd

    
    if(isset($_POST['edit-submit'])){
        $isvalid=true;
        $category3 = trim($_POST['editedcategoryName']);
        $catDesc3=trim($_POST['editedcategoryDesc']);
        if($category3 == ""){
            $msg.='Insert Category Name.';
            header('location:../public/Admin_category_management.php');
            $isvalid=false;
        } 
        else if(strlen($category3)>50){
            $msg.='Only 50 characters allowed.*';
            $isvalid=false;
        }
        if($category3==""){
            $msg.="Invalid category. Couldn't update.";
            $isvalid=false;
        }
        // if($catDesc3=="")
        if(strlen($catDesc3)>500){
            $msg.='Only 500 characters allowed.*';
            $isvalid=false;
        }
        else if($catDesc3=="")
        {
            $catDesc3="";
        }
     }

    if(isset($_POST['edit-submit'])){
        if($isvalid){
            // $msg.= $catDesc3;
            // fetch categoryID
            $catsql = "UPDATE categories SET `categoryName`='$category3', `categoryDesc`='$catDesc3' WHERE adminID=$adminID AND categoryname='$category2'";
            $cataddsql = mysqli_query($conn,$catsql);
            if($cataddsql){            
                
            }


            
        } 
    }

    //tabledata fetch
    $fecthQuery="SELECT * FROM categories WHERE adminID=$adminID and categoryStatus=1";
    $runFetch=mysqli_query($conn,$fecthQuery);
    
?>