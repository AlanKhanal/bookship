<?php 
include '../private/dbconnect.php';
include '../private/adminheader.php';

if(isset($_REQUEST['chcat'])){
    $edit_id = $_REQUEST['chcat'];

    $catview = "SELECT `cat_name` FROM categories WHERE cat_id='$edit_id'";
    $run = mysqli_query($conn, $catview);
    $row_cat=mysqli_fetch_array($run);

    $selected = $row_cat['cat_name'];
    if($selected == ""){
        echo 'Error occured!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Category Update</title>
    <link rel="stylesheet" href="../private/management.css">
    <style>
        form{
            text-align:center;
        }
    </style>
</head>
<body>
    <form action="" method=POST>
        <br><label for="catchange" class=add>CHANGE CATEGORY</label><br>
        <input type="text" value=<?php echo $selected?> id="catchange" name="changed_name"><br>
        <input type="submit">
    </form>
</body>
</html>
<?php
    include '../private/dbconnect.php';
    if($_POST){
        $chname = trim(strtoupper($_REQUEST['changed_name']));
        if($chname==""){
            echo '<div class="error">Please insert category name.<div>';
        }
        else{
             $sql = "UPDATE categories SET `cat_name`='$chname' WHERE `cat_name`='$selected'";
             $run = mysqli_query($conn, $sql);
             if($run===true){
                header("location:editcat.php");
            }
             

        }
    }
?>