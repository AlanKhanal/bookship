<?php
    include ('../private/dbconnect.php');
    include('../private/admin-header-nav.php');
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
        $adminName=$row['adminName'];
        $adminEmail=$row['email'];
        $companyName=$row['companyName'];
        $companyAddress=$row['companyAddress'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Extra Management</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../private/AdminRegLog.css">
</head>
<body>
<div style="margin-left: 2rem;"><h2 style="font-family:Georgia, 'Times New Roman', Times, serif;">ADVANCE PRODUCT MANAGEMENT</h2></div>
    <div style="margin-left:4rem"><p style="font-family:Georgia, 'Times New Roman', Times, serif;"><b style="font-family:Georgia, 'Times New Roman', Times, serif;">UNHIDE OR DELETE YOUR CATEGORY PERMANENTLY. <br> Note:</b> The products here aren't displayed to customers.</p></div>
    <div>
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
                    $queryTable="SELECT * FROM products WHERE adminID=$adminID and productStatus=0 ORDER BY productPublished desc";
                    if(isset($_REQUEST['prdSearch'])){
                        $csrch=$_REQUEST['search'];
                        // echo $csrch;
                        $queryTable="SELECT * FROM products WHERE adminID=$adminID and productStatus=0 and productName LIKE '%$csrch%' ORDER BY productPublished desc";
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
                    <button class="btn btn-primary" ><a href="http://localhost:8081/bookship/private/Admin_product_unhide.php?productID=<?=$ID?>" class="text-light">UNHIDE</a></button>
                    <button class="btn btn-danger"><a href="http://localhost:8081/bookship/private/Admin_product_permDelete.php?deleteID=<?=$ID?>" class="text-light">DELETE</a></button>
                    </td>
                </tr>
                <?php
                        } 
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
