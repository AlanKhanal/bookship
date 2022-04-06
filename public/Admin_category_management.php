<?php 
    include '../private/dbconnect.php';
    include '../private/admin-header-nav.php';
    include '../private/Admin_category_management_BE.php'
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add category</title>
</head>
<body>
<div><?=$msg?></div>
    <div class="add">
        <form action="" method="POST">
            <label for="addcat"><b>ADD CATEGORY</b></label><br>
            <input type="text" id="addcat" name="categoryName" placeholder="Enter Category"><br>
            <label for="addcat"><b>Category Description</b></label><br>
            <textarea id="catDesc" name="categoryDesc" placeholder="Category description"cols="45" rows="10"></textarea><br>
            
            <input type="submit" name="submit">
        </form>
    </div>
    <hr>
    <div class="everyCategory">
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Recorded date</th>
                    <th>Manage</th>
                    <!-- <th>Total Product</th> -->
                </tr>
            </thead>
            <tbody><?php
            if (mysqli_num_rows($runFetch) > 0){
        // output data of each row
        while($row = mysqli_fetch_assoc($runFetch)) {
                    $categoryName=$row["categoryName"];
                    $catDesc=$row["categoryDesc"];
                    $updated=$row["UpdateDate"];
                    // $catId=$row["categoryID"];
                    ?>
                    <tr>
                        <td><?=$categoryName?></td>
                        <td><?=$catDesc?></td>
                        <td><?=$updated?></td>
                        <td>
                            <a href="http://localhost:8081/bookship/private/Admin_category_edit.php?category=<?=$categoryName?>">EDIT</a>
                            <a href="http://localhost:8081/bookship/private/Admin_category_delete.php?category=<?=$categoryName?>">DELETE</a>
                        </td>
                        
            <?php   
                }
            } 
            else {
                echo "No data in table.";
            }
            ?>
                    </tr>  
            </tbody>
        </table>
    </div>
</body>
</html>
