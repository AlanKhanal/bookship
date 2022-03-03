<?php include '../private/adminheader.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Category</title>
    <link rel="stylesheet" href="../private/management.css">
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
        <h1 align=center>Delete Category</h1>
        <?php
        include '../private/dbconnect.php';
        
        $sql = "SELECT * FROM categories WHERE cat_display=1 ORDER BY cat_date desc";
        $result = mysqli_query($conn, $sql);
        if(isset($_REQUEST['del'])){
            $del_id=$_REQUEST['del'];
            $delete = "DELETE FROM categories where cat_id='$del_id'";
            $sql = mysqli_query($conn,$delete);
            if($sql===true){
                header("location:dltcat.php");
            }
        }
        echo '<table border=2px solid black align=center>
                <tr>
                    <th>ID</th>
                    <th>Category<br>name</th>
                    <th>Total<br>Products</th>
                    <th>Added<br>Date</th>
                    <th>Delete</th>
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
                        <td><a href="dltcat.php?del=<?=$Id?>">Delete</a></td>
                    </tr>
            <?php   
                }
            } 
            else {
                echo "<div class=message>No data hidden yet.<br>First, hide the category from update category section.</div>";
            }
        ?>
        </div>
    </div>
</body>
</html>
  