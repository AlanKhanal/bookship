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
    <style>
        th{
            background-color: red;
            color: white;
        }
        td{
            background-color: wheat;
            padding:2px 20px
        }
    </style>
</head>
<body>
    <div align=center><h2>Category Management</h2></div>
    <br>
    <div align=center>
        <table align=center>
            <thead>
                <tr align="center">
                    <th style="border-right:1px solid white">Book Name</th>
                    <th style="border-right:1px solid white">Book Description</th>
                    <th style="border-right:1px solid white">Manage</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $query2="SELECT * FROM categories WHERE adminID=$adminID and categoryStatus=0";
                        $run2=mysqli_query($conn,$query2);
                        if (mysqli_num_rows($run2) > 0){
                        while($row2 = mysqli_fetch_array($run2)){
                            $ID=$row2['categoryID'];
                            $categoryName=$row2['categoryName'];
                            $categoryDesc=$row2['categoryDesc'];
                        }
                    }
                        else{
                            die('0 HIDDEN category.') ;
                        }
                    ?>
                <tr>
                        <td><b><?=$categoryName?></b></td>
                        <td><textarea name="" id="" cols="20" rows="2"><?=$categoryDesc?></textarea></td>
                        <td>
                            <button class="btn btn-primary"><a href="http://localhost:8081/bookship/private/Admin_category_unhide.php?categoryID=<?=$ID?>" class="text-light">UNHIDE</a></button>
                            <button class="btn btn-danger"><a href="http://localhost:8081/bookship/private/Admin_category_permDelete.php?deleteID=<?=$ID?>" class="text-light">DELETE</a></button>
                        </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>