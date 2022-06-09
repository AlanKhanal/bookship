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
    <div style="margin-left: 2rem;"><h2 style="font-family:Georgia, 'Times New Roman', Times, serif;">ADVANCE CATEGORY MANAGEMENT</h2></div>
    <div style="margin-left:4rem"><p style="font-family:Georgia, 'Times New Roman', Times, serif;"><b style="font-family:Georgia, 'Times New Roman', Times, serif;">UNHIDE OR DELETE YOUR CATEGORY PERMANENTLY. <br> Note:</b> The products under the category here aren't displayed to customers. <br> If category is permanently deleted, products under the category will be deleted as well.</p></div>

    <br>
    <div align=center>
    <table class="table table-striped table-dark">
              <thead>
                <tr style="background:black;color:white;text-align:center;border-top:2px solid white;">
                  <th style="background:black;color:white;text-align:center">NAME</th>
                  <th style="background:black;color:white;text-align:center">DESCRIPTION</th>
                  <th style="background:black;color:white;text-align:center">RECORDED ON</th>
                  <th style="background:black;color:white;text-align:center">MANAGE</th>
                </tr>
              </thead>

            <?php
            $runFetch=mysqli_query($conn,"SELECT * FROM categories where categoryStatus=0");
            ?>
            <tbody><?php
            if (mysqli_num_rows($runFetch) > 0){
        // output data of each row
        while($row = mysqli_fetch_assoc($runFetch)) {
                    $categoryID=$row['categoryID'];
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
                        <button class="btn btn-primary" style="font-weight:600" ><a href="http://localhost:8081/bookship/private/Admin_category_unhide.php?categoryID=<?=$categoryID?>" style="text-decoration:none;color:white">UNHIDE</a></button>
                        <button class="btn btn-danger" style="font-weight:600"><a href="http://localhost:8081/bookship/private/Admin_category_permDelete.php?deleteID=<?=$categoryID?>" style="text-decoration:none;color:white">DELETE</a></button>
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