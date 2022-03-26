<?php
include '../private/adminheader.php';
    echo '<h1 align=center>Books on Store</h1>';

    include '../private/dbconnect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Products | Bookship</title>
    <style>
        td{
            padding:10px;
            text-align: center;
        }
        td,th{
            border-bottom:1px solid lightgray;
        }
    </style>
</head>
<body>
    <table align=center>
        <tr>
            <th width=15%>NAME</th>
            <th width=40%>DESCRIPTION</th>
            <th width=15%>CATEGORY</th>
            <th>IMAGE</th>
            <th width=5%>PRICE</th>
            <th width=10%>QUANTITY</th>
            <th width=13%>MANAGE</th>
        </tr>
            <?php
                $query="SELECT * FROM products GROUP BY Date desc";
                $run=mysqli_query($conn,$query);
                while ($row = mysqli_fetch_array($run)){
                    $ID=$row['productID'];
                    $productName=$row['productName'];
                    $productDesc=$row['productDesc'];
                    $productCat=$row['productCat'];
                    $productCost=$row['productCost'];
                    $productQty=$row['productQty'];
                    $productImg=$row['productImg'];
                    $productAuthor=$row['productAuthor'];
            ?>
                    <tr>
                    <td><b><?=$productName?></b><br><br><div align=left><i>By <?=$productAuthor?></i><div></td>
                    <td><?=$productDesc?></td>
                    <td><?=$productCat?></td>
                    <td><a href='<?=$productImg?>' target="_blank"><img src='<?=$productImg?>'height='90px' width='70px'></a></td>
                    <td>Rs.<?=$productCost?></td>
                    <td><?=$productQty?></td>
                    <td><a href='editproduct.php?id=<?=$ID?>'>[EDIT]</a> <a href='dltproduct.php'>[HIDE]</a></td>
                    </tr>
            <?php
                    } 
            ?>
            </table>
</body>
</html>
