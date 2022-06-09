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
        /* th,td{
            border: 2px solid #212529;
        } */
    /* .add{
        margin:0rem 1rem;
    } */
        .container label{
            font-weight: 600;

        }
        .container input,textarea,select{
            border:2px solid black;
            margin-bottom: 1rem;
            padding: 0.2rem 0.4rem;
            border-radius: 7px;
            width: 72%;
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
            width: 100%;
        }
        .prtable{
            width:100%;
        }
        .prtable td{
            width:auto;
        }
    </style>
</head>
<body>
<h2 style="margin-left:2rem;font-family:Georgia, 'Times New Roman', Times, serif">ADD BOOK</h2>
     <div class="container">
        <div class="add">
            <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="">NAME:</label></td>
                    <td><input type="text" id="" class="" name="productName"></td>
                    <td><label for="productCost">PRICE:</label></td>
                    <td><input type="number" id="productCost" class="" name="productCost" min=1 value=1></td>
                </tr>
                <!-- SELECT CATEGORY INPUT -->

               <tr>
               <td><label for="productAuthor">AUTHOR:</label></td>
                    <td><input type="text" id="productAuthor" class="" name="productAuthor" ><br></td>
                   <td><label for="">CATEGORY:</label></td>
                    <td>
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
                        ?>
                    </td>
                </tr>    
                <tr>
                    <td><label for="productQty">QUANTITY:</label></td>
                    <td><input type="number" id="productQty" class="" name="productQty" min=1 value=1 ></td>

                    <td><label for="pubDate">PUBLISHED ON: </label></td>
                    <td><input type="date" id="pubDate" class="" name="productPublished"></td>
                </tr>
                <tr>
                    <td><label for="productImg">IMAGE:</label></td>
                    <td><input type="file" id="productImg" class="imageClass" name="productImg" accept="image/*" style="border:none"></td>
                </tr>
                <tr>
                    <td> <label for="productDesc">DESCRIPTION:</label></td>
                    <td colspan="3"><textarea type="text" rows=3 cols="" id="productDesc" maxlength="1000" class="" name="productDesc" style="border:2px solid black;background:white;"></textarea></td>
                </tr>  
                <tr>
                    <td><input type="submit" name="product-submit" class="submit" value="ADD BOOK"> </td> 
                </tr>
                <tr>
                <div><?=$msg?></div>
                </tr>
            </table> 
            </form>
        </div>
     </div>
        <hr>
        <!-- ********************************************DIVISION********************************************* -->
        <div style="display:flex;justify-content:space-between;margin:0rem 2rem;">
            <div><h2 align=center style="font-family:Georgia, 'Times New Roman', Times, serif">BOOK</h2></div>
            <form action="" method="POST">
              <input type="text" name="search" placeholder="Search Category" style="border:2px solid black;border-radius:5px;padding:0.1rem;">
              <input type="submit" name="prdSearch" value="SEARCH" style="background-color:#212529;color:white;border:2px solid white;font-weight:600;padding:0.1rem 0.4rem;border-radius:5px">
          </form>
            <!-- <div>
                <form action="" method="POST">
                    <input type="search" name="search">
                    <input type="submit" name="search" value="SEARCH">
                </form>
            </div> -->
        </div>
        <div><?=$tablemsg?></div>
        <div class="prtable">
            <table class="table table-striped table-dark" width=auto style="font-size:1rem;">
                <thead>
                <tr style="background:black;color:white;text-align:center;border-top:2px solid white;">
                        <th style="background:black;color:white;text-align:center">Name</th>
                        <th style="background:black;color:white;text-align:center">Category</th>
                        <th style="background:black;color:white;text-align:center">Desc</th>
                        <th style="background:black;color:white;text-align:center">Cost</th>
                        <th style="background:black;color:white;text-align:center">Image</th>
                        <th style="background:black;color:white;text-align:center">Qty</th>
                        <th style="background:black;color:white;text-align:center">Date</th>
                        <th style="background:black;color:white;text-align:center">Option</th>
                  </tr>
                </thead>


                <tbody>
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
                        
                        <td>NPR.<?=$productCost?></td>
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