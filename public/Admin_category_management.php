<?php 
    include '../private/dbconnect.php';
    include '../private/admin-header-nav.php';
    include '../private/Admin_category_management_BE.php'
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/AdminRegLog.css">
    <style>
        
        input,textarea{
            border:2px solid black;
            margin-bottom: 20px;
            padding: 5px;
        }
        td a{
            text-decoration: none;
            color:white;
        }
        td a:hover{
            color:gray;
        }
        td textarea{
            border: 1px solid white;
            background-color:beige;
            color:gray;
        }
    </style>
</head>
<body>
<div class="container">
      <div><?=$msg?></div>
          <div class="add">
              <form action="" method="POST">
                  <label for="addcat"><b>ADD CATEGORY</b></label><br>
                  <input type="text" id="addcat" name="categoryName" placeholder="Enter Category"><br>
                  
                  <label for="addcat"><b>Category Description</b></label><br>
                  <textarea id="catDesc" name="categoryDesc" placeholder="Category description"cols="45" rows="10"></textarea><br>
                  
                  <input type="submit" name="submit" value="Add Category">
              </form>
          </div>
          <hr>
          <form action="" method="POST">
              <input type="text" name="search" placeholder="Search Category">
              <input type="submit" name="catSearch" value="SEARCH">
          </form>
          <table class="table table-striped">
              <thead>
                <tr style="background:black;color:white;text-align:center">
                  <th scope="col">Category Name</th>
                  <th scope="col">Category Description</th>
                  <th scope="col">Recorded date</th>
                  <th scope="col">Manage</th>
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
                        <td><b><?=$categoryName?></b></td>
                        <td><textarea name="" id="" cols="50" rows="2"><?=$catDesc?></textarea></td>
                        <td><?=$updated?></td>
                        <td>
                        <button class="btn btn-primary"><a href="http://localhost:8081/bookship/private/Admin_category_edit.php?category=<?=$categoryName?>">EDIT</a></button>
                        <button class="btn btn-danger"><a href="http://localhost:8081/bookship/private/Admin_category_delete.php?category=<?=$categoryName?>">DELETE</a></button>
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
