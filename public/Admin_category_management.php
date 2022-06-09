<?php 
    include '../private/dbconnect.php';
    include '../private/admin-header-nav.php';
    include '../private/Admin_category_management_BE.php';

    if(isset($_REQUEST['cat'])){
        $vfCat=$_REQUEST['cat'];
        if($vfCat=='null'){
            $msg.="Add category to insert products.";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/AdminRegLog.css">
    <style>
        
        .container input,textarea{
            border:2px solid black;
            margin-bottom: 1rem;
            padding: 0.2rem 0.4rem;
            border-radius: 7px;
        }
        .container td a{
            text-decoration: none;
            color:white;
        }
        .container td a:hover{
            color:gray;
        }
        .container td textarea{
            border: 1px solid white;
            background-color:beige;
            color:gray;
        }
        .container .submit:hover{
            transform: scaleX(1.1);
        }
        .container .submit{
            padding: 0.2rem;
            border: 2px solid white;
            background-color: #212529;
            color:white;
            font-weight: 600;
            padding:0.4rem 0.5rem;
        }
    </style>
</head>
<body>
    <h2 style="margin-left:2rem;font-family:Georgia, 'Times New Roman', Times, serif">ADD CATEGORY</h2>
<div class="container">
          <div class="add">
              <form action="" method="POST">
                  <label for="addcat"><b>Name</b></label><br>
                  <input type="text" id="addcat" name="categoryName" placeholder="Enter Category"><br>
                  
                  <label for="addcat"><b>Description</b></label><br>
                  <textarea id="catDesc" name="categoryDesc" placeholder="Category description"cols="80" rows="5"></textarea><br>
                  
                  <input type="submit" name="submit" value="ADD CATEGORY" class="submit">
              </form>
          </div>
      <div><?=$msg?></div>
    </div>
          <hr style="margin:0.4rem 1rem;border:1px solid white">
          <div style="margin:0px 2rem;display:flex;justify-content:space-between">
            <div>
                <h3 style="font-family:Georgia, 'Times New Roman', Times, serif">CATEGORIES</h3>
            </div>
            <div >
                <form action="" method="POST" class="container">
                    <input type="text" name="search" placeholder="Search Category">
                    <input type="submit" name="catSearch" value="SEARCH" style="background-color:#212529;color:white;border:2px solid white;font-weight:600">
                </form>
            </div>
          </div>
          <table class="table table-striped table-dark">
              <thead>
                <tr style="background:black;color:white;text-align:center;border-top:2px solid white;">
                  <th style="background:black;color:white;text-align:center">NAME</th>
                  <th style="background:black;color:white;text-align:center">DESCRIPTION</th>
                  <th style="background:black;color:white;text-align:center">RECORDED ON</th>
                  <th style="background:black;color:white;text-align:center">MANAGE</th>
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
                        <td style="text-align:center;"><b><?=$categoryName?></b></td>
                        <td style="text-align:center;"><textarea name="" id="" cols="50" rows="2"><?=$catDesc?></textarea></td>
                        <td style="text-align:center;"><?=$updated?></td>
                        <td style="text-align:center;">
                        <a href="http://localhost:8081/bookship/private/Admin_category_edit.php?category=<?=$categoryName?>"><button class="btn btn-primary" style="font-weight:600">EDIT</button></a>
                        <a href="http://localhost:8081/bookship/private/Admin_category_delete.php?category=<?=$categoryName?>"><button class="btn btn-danger" style="font-weight:600">HIDE</button></a>
                        </td style="text-align:center">
                        
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
