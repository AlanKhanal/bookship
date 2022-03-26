<?php include '../private/adminheader.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Categories</title>
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
        <h1 align=center>Categories Details</h1>
        <?php
        include '../private/dbconnect.php';
        $sql = "SELECT * FROM categories WHERE cat_display=0";
        $result = mysqli_query($conn, $sql);
        echo '<table border=2px solid black align=center>
                <tr>
                    <th>ID</th>
                    <th>Category<br>name</th>
                    <th>Total<br>Products</th>
                    <th>Added<br>Date</th>
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
  