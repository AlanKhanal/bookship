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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/AdminRegLog.css">
    <style>
        label{
            font-weight: bold;
        }
        label,input,textarea{
            font-size: 14px;
        }
        input,textarea{
            border:2px solid black;
            margin-bottom: 10px;
            padding-left: 5px;
            padding-right: 5px;
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
        .container{
            text-align: start;
        }
    </style>
</head>
<body>
     <div class="container">
         <h2>ADD BOOK</h2>
        <div><?=$msg?></div>
        <div class="add">
            <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="">Book Name:</label></td>
                    <td><input type="text" id="" class="" name="productName"></td>
                </tr>
                <tr>
                    <td><label for="">Book Category:</label></td>
                    <td><?php 
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
                        ?></td>
                </tr>
                <!-- SELECT CATEGORY INPUT -->

               <tr>
                   <td> <label for="productDesc">Book Description:</label></td>
                   <td><textarea type="text" rows=5 cols=50 id="productDesc" maxlength="1000" class="" name="productDesc" style="border:2px solid black;background:white"></textarea></td>
               </tr>
               <tr>
                    <td><label for="productAuthor">Author Name:</label></td>
                    <td><input type="text" id="productAuthor" class="" name="productAuthor" ><br></td>
               </tr>         

                <tr>
                    <td><label for="productCost">Book Cost:</label></td>
                    <td><input type="number" id="productCost" class="" name="productCost" min=1 value=1><br></td>
                </tr>

                <tr>
                    <td><label for="productImg">Book Image:</label></td>
                    <td><input type="file" id="productImg" class="" name="productImg" accept="image/*" style="border:none"></td>
                </tr>
                    
                <tr>
                    <td><label for="productQty">Quantity:</label></td>
                    <td><input type="number" id="productQty" class="" name="productQty" min=1 value=1 ></td>
                </tr>

                <tr>
                <td><label for="pubDate">Published Date</label></td>
                <td><input type="date" id="pubDate" class="" name="productPublished"></td>
                </tr>
                    
                <td><input type="submit" name="product-submit"> </td> 
            </table> 
            </form>
        </div>
        <hr>
        <!-- ********************************************DIVISION********************************************* -->
        <div style="display:flex;justify-content:space-between">
            <div><h2 align=center>BOOK</h2></div>
            <form action="" method="POST">
              <input type="text" name="search" placeholder="Search Category">
              <input type="submit" name="prdSearch" value="SEARCH">
          </form>
            <!-- <div>
                <form action="" method="POST">
                    <input type="search" name="search">
                    <input type="submit" name="search" value="SEARCH">
                </form>
            </div> -->
        </div>
        <div><?=$tablemsg?></div>
        <div>
            <table class="table table-striped" border=2px solid red>
                <thead>
                    <tr class="table-head" width=100% style="background:red;color:white;">
                        <th width=10% scope="col" style="border-right:1px solid black;">Name</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Category</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Description</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Cost</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Image</th>
                        <th width=10% scope="col" style="border-right:1px solid black;">Quantity</th>
                        <th width=15% scope="col" style="border-right:1px solid black;">Published On</th>
                        <th width=15% scope="col" style="border-right:1px solid black;">Management</th>
                  </tr>
                </thead>


                <tbody>
                    <tr>
                    <?php
                        $queryTable="SELECT * FROM products WHERE adminID=$adminID and productStatus=1 ORDER BY productPublished desc";
                        if(isset($_REQUEST['prdSearch'])){
                            $csrch=$_REQUEST['search'];
                            // echo $csrch;
                            $queryTable="SELECT * FROM products WHERE adminID=$adminID and productStatus=1 and productName LIKE '%$csrch%' ORDER BY productPublished desc";
                            // echo "Search result for $csrch";
                        }
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
                        <!-- <th scope="row"></th> -->
                        <td><b><?=$productName?></b><br><br><div align=left><i>By <?=$productAuthor?></i><div></td>
                        <td><?=$productCat?></td>
                        <td><textarea name="" id="" cols="20" rows="2"><?=$productDesc?></textarea></td>
                        
                        <td>Rs.<?=$productCost?></td>
                        <td><a href='<?=$productImg?>' target="_blank"><img src='<?=$productImg?>'height='90px' width='70px'></a></td>
                        <td><?=$productQty?></td>
                        <td><?=$published?></td>
                        <td>
                            <button class="btn btn-primary"><a href="http://localhost:8081/bookship/private/Admin_product_edit.php?productID=<?=$ID?>" class="text-light">EDIT</a></button>
                            <button class="btn btn-danger"><a href="http://localhost:8081/bookship/private/Admin_product_delete.php?deleteID=<?=$ID?>" class="text-light">HIDE</a></button>
                        </td>
                    </tr>
                    <!-- <?php
                            } 
                    ?> -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php
include '../private/Admin_product_management_BE.php';
?>