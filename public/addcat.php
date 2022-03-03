<?php 
    include '../private/dbconnect.php';
    include '../private/adminheader.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add category</title>
    <style>
        .add,input{
            text-align:center;
            font-size:30px;
            margin:10px;
            border-radius:15px;
        }
        .error{
            color:red;
            text-align:center;
            font-size:18px;
        }
        .message{
            color:blue;
            text-align:center;
            font-size:18px;
        }
    </style>
</head>
<body>
    <div class="add">
        <form action="" method="POST">
            <label for="addcat"><b>ADD CATEGORY</b></label><br>
            <input type="text" id="addcat" name="cat_name" placeholder="Enter new category"><br>
            <input type="submit">
        </form>
    </div>
</body>
</html>
<?php
    $isvalid=true;
    if($_POST){
        $newcat = trim(strtoupper($_POST['cat_name']));
        if($newcat == ""){
            echo '<div class="error">Insert Category Name.</div>';
            $isvalid=false;
        }    
        $catsql = "INSERT INTO categories(`cat_name`) VALUES('$newcat')";

        $catadd="SELECT * FROM categories WHERE cat_name='$newcat'";
        $check = mysqli_query($conn, $catadd);
        $catnum = mysqli_num_rows($check);
        if($catnum>0){
            echo '<div class="error">Category already Exists</div>';
            $isvalid=false;
        } 
    }
    if($_POST){
        if($isvalid){
            $cataddsql = mysqli_query($conn,$catsql);
            if($cataddsql){
                echo'<div class="message">Added Successfully</div>';
            }
        } 
    }
?>
<?php include '../private/management.php';?>