<?php include '../private/adminheader.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Category</title>
    <style>
        th,td{
            border:1px solid black;
            margin:0px 0px;
            padding:10px 20px;
        }
        
    </style>
</head>
<body>
    <div class=view>
        <div>
        <h1 align=center>Update Category</h1>
        <?php
        include '../private/dbconnect.php';
        
        $sql = "SELECT * FROM categories WHERE cat_display=0 ORDER BY cat_date desc";
        $result = mysqli_query($conn, $sql);
        if(isset($_REQUEST['edit'])){
            $edit_id=$_REQUEST['edit'];
            $editcat = "UPDATE categories SET `cat_display`='1' WHERE `cat_id`='$edit_id'";
            $sql2 = mysqli_query($conn,$editcat);
            if($sql2===true){
                header("location:editcat.php");
            }
        }
        echo '<table border=2px solid black align=center>
                <tr>
                    <th>ID</th>
                    <th>CATEGORY<br>NAME</th>
                    <th>TOTAL<br>PRODUCTS</th>
                    <th>ADDED<br>DATE</th>
                    <th>Update</th>
                </tr>';
                
        if (mysqli_num_rows($result) > 0){
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
                    $Id = $row["cat_id"];
                    $catname=$row["cat_name"];
                    $products=$row["products"];
                    $date=$row["cat_date"];
                    ?>
                    <tr>
                        <td><?=$Id?></td>
                        <td><?=$catname?></td>
                        <td><?=$products?></td>
                        <td><?=$date?></td>
                        <td><<a href="editcat.php?edit=<?=$Id?>">Hide</a>> <<a href="catchange.php?chcat=<?=$Id?>">Rename</a>></td>
                    </tr>
            <?php   
                }
            } 
            else {
                echo "No data in table.";
            }
        ?>
        </div>
    </div>
</body>
</html>
  