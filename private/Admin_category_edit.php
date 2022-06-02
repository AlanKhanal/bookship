<?php
include 'Admin_category_edit_BE.php';
include 'Admin_category_edit_change.php';
include 'admin-header-nav.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/AdminRegLog.css">
    <style>
        .add{
            margin: 2rem;
            text-align: center;
        }
        input{
            padding: 2px;
            font-size: 18px;
        }
        label{
            font-size: 18px;
        }
        textarea{
            padding: 5px;
        }
        .everycategory{
            margin: 2rem;
        }
        th{
            text-align: center;
        }
        td{
            padding-left: 3rem;
        }
        td a{
            text-decoration: none;
            border: 2px solid grey;
            padding: 3px 5px;
            color: white;
        }
    </style>
</head>
<body>
<div><?=$msg?></div>
    <div class="add">
        <form action="" method="POST">
            <label for="addcat" ><b>EDIT CATEGORY</b></label><br>
            <input type="text" id="addcat" name="editedcategoryName" placeholder="Enter Category" value="<?=$categoryName2?>"><br>
            <label for="addcat"><b>Category Description</b></label><br>
            <textarea id="catDesc" name="editedcategoryDesc" placeholder="Category description"cols="45" rows="10" ><?=$catDesc2?></textarea><br>
            
            <input type="submit" name="edit-submit">
        </form>
    </div>
    <hr>
    <div class="everycategory">
        <h3>CATEGORIES</h3>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
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
                    // $catID=$rw
                    ?>
                    <tr>
                        <td><?=$categoryName?></td>
                        <td><textarea name="" id="" cols="30" rows="2"><?=$catDesc?></textarea></td>
                        <td><?=$updated?></td>
                        <td>
                            <a href="http://localhost:8081/bookship/private/Admin_category_edit.php?category=<?=$categoryName?>" style="background:blue">EDIT</a>
                            <a href="http://localhost:8081/bookship/private/Admin_category_delete.php?category=<?=$categoryName?>" style="background:red">DELETE</a>
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