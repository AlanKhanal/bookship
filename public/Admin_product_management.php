<?php
$msg="";
$tablemsg="";
include '../private/dbconnect.php';
//session start
session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
    {
        header("location: Admin_login.php");
    }
    $admin = $_SESSION['adminName'];
    $query = "SELECT * FROM admins WHERE adminName='$admin'";
    $run=mysqli_query($conn,$query);
    if (mysqli_num_rows($run) > 0){
        $row = mysqli_fetch_assoc($run);
        $adminID=$row['adminID'];
        // $adminName=$row['adminName'];
        // $adminEmail=$row['email'];
        // $companyName=$row['companyName'];
        // $companyAddress=$row['companyAddress'];
    }
include '../private/admin-header-nav.php';
include '../private/Admin_product_management_BE.php';


?>
<!-- FETCH TABLE DATA -->
<?php
    $queryfetch="SELECT * FROM products WHERE productStatus=1 and adminID=$adminID";
    $runQuery1=mysqli_query($conn,$queryfetch);
    if (mysqli_num_rows($runQuery1) > 0){
        while($row = mysqli_fetch_assoc($runQuery1)) {
            $productName=$row['productName'];
            //Table data here
        }
    }
    else{
        $tablemsg='No data';
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Management</title>
    <!-- <style>
        .body-separation{
            display: flex;
            justify-content: space-around;
            margin:0px 5px;
        }
    </style> -->
</head>
<body>
    <div class="body-separation">
        <div><?=$msg?></div>
        <div>
            <form action="" method="POST" enctype="multipart/form-data">

            <label for="">Book Name:</label>
            <input type="text" id="" class="" name="productName"><br>

            <label for="">Book Category:</label><br>
            <!-- SELECT CATEGORY INPUT -->
            <?php 
            echo '<select name="productCategory">';
                $query="SELECT `categoryName` FROM categories where categoryStatus=1 ORDER BY categoryName asc";
                echo '<option>Select Category</option>';
                if($run=mysqli_query($conn,$query)){
                if(mysqli_num_rows($run)>0){
                    while($row=mysqli_fetch_array($run)){
                        echo '<option>'.$row['categoryName'].'</option>';//category options 
                    }
                }
            }     
            echo '</select>';  //Selection closed       
            ?><br>

            <label for="productDesc">Book Description:</label><br>
            <textarea type="text" rows=8 cols=50 id="productDesc" maxlength="1000" class="" name="productDesc"></textarea><br>

            <label for="productAuthor">Author Name:</label><br>
            <input type="text" id="productAuthor" class="" name="productAuthor" ><br>

            <label for="productCost">Book Cost:</label><br>
            <input type="number" id="productCost" class="" name="productCost" min=1 value=1><br>

            <label for="productImg">Book Image:</label>
            <input type="file" id="productImg" class="" name="productImg" accept="image/*"><br>
                
            <label for="productQty">Quantity:</label><br>
            <input type="number" id="productQty" class="" name="productQty" min=1 value=1 ><br>

            <label for="pubDate">Published Date</label><br>
            <input type="date" id="pubDate" class="" name="productPublished"><br>
                
            <input type="submit" name="product-submit">  
                
            </form>
        </div>
        <hr>
        <!-- ********************************************DIVISION********************************************* -->
        <div><?=$tablemsg?></div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Book category</th>
                        <th>Book Description</th>
                        <th>Author Name</th>
                        <th>Book Cost</th>
                        <th>Book Image</th>
                        <th>Product Quantity</th>
                        <th>Published Date</th>
                        <th>Management</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php
                        $queryTable="SELECT * FROM products WHERE adminID=$adminID and productStatus=1 GROUP BY productPublished desc";
                        $runTable=mysqli_query($conn,$queryTable);
                        while ($row = mysqli_fetch_array($runTable)){
                            $ID=$row['productID'];
                            $productName=$row['productName'];
                            $productDesc=$row['productDesc'];
                            $productCat=$row['productCategory'];
                            $productCost=$row['productCost'];
                            $productQty=$row['productQty'];
                            $productImg=$row['productImg'];
                            $productAuthor=$row['productAuthor'];
                            $published=$row['productPublished'];
                    ?>
                    <tr>
                        <td><b><?=$productName?></b><br><br><div align=left><i>By <?=$productAuthor?></i><div></td>
                        <td><?=$productCat?></td>
                        <td><?=$productDesc?></td>
                        <td><?=$productAuthor?></td>
                        <td><?=$productQty?></td>
                        
                        <td><a href='<?=$productImg?>' target="_blank"><img src='<?=$productImg?>'height='90px' width='70px'></a></td>
                        <td><?=$productCost?></td>
                        <td><?=$published?></td>
                        <td><a href='http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$ID?>'>[EDIT]</a> <a href='http://localhost:8081/bookship/private/Admin_product_delete.php?deleteID=<?=$ID?>'>[HIDE]</a></td>
                    </tr>
                    <?php
                            } 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
include '../private/Admin_product_management_BE.php';
?>