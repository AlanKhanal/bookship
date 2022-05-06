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
</head>
<body>
    <div>
        <table>
            <thead>
                <tr width=100% align=left>
                    <th width=10%>Book Name</th>
                    <th width=10%>Book Category</th>
                    <th width=10%>Book Description</th>
                    <th width=10%>Book Cost</th>
                    <th width=10%>Book Image</th>
                    <th width=10%>Product Quantity</th>
                    <th width=10%>Published Date</th>
                    <th width=10%>Manage</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $query2="SELECT * FROM products WHERE adminID=$adminID and productStatus=0";
                        $run2=mysqli_query($conn,$query2);
                        if (mysqli_num_rows($run2) > 0){
                        while($row2 = mysqli_fetch_array($run2)){
                            $ID=$row2['productID'];
                            $productName=$row2['productName'];
                            $productDesc=$row2['productDesc'];
                            $productCat=$row2['productCategory'];
                            $productCost=$row2['productCost'];
                            $productQty=$row2['productQty'];
                            $productImg=$row2['productImg'];
                            $productAuthor=$row2['productAuthor'];
                            $published=$row2['productPublished'];
                        }
                    }
                        else{
                            die('0 HIDDEN PRODUCT.') ;
                        }
                    ?>
                <tr>
                <td><b><?=$productName?></b><br><br><div align=left><i>By <?=$productAuthor?></i><div></td>
                        <td><?=$productCat?></td>
                        <td><textarea name="" id="" cols="20" rows="2"><?=$productDesc?></textarea></td>
                        
                        <td><?=$productCost?></td>
                        <td><a href='<?=$productImg?>' target="_blank"><img src='<?=$productImg?>'height='90px' width='70px'></a></td>
                        <td><?=$productQty?></td>
                        <td><?=$published?></td>
                        <td>
                            <button class="btn btn-primary"><a href="http://localhost:8081/bookship/private/Admin_product_unhide.php?productID=<?=$ID?>" class="text-light">UNHIDE</a></button>
                            <button class="btn btn-danger"><a href="http://localhost:8081/bookship/private/Admin_product_permDelete.php?deleteID=<?=$ID?>" class="text-light">DELETE</a></button>
                        </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>