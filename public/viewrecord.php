<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <style>
        
        th,td{
            border:1px solid black;
            margin:0px 0px;
            padding:10px 20px;
        }
    </style>
</head>
<body>
    <h1>Admin Database</h1>
    <?php
    
        include '../private/dbconnect.php';
        
        $sql = "SELECT * FROM adminlogin WHERE admin_status=1";
        $result = mysqli_query($conn, $sql);

        

        echo '<table border=2px solid black>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>companyName</th>
                    <th>Company Address</th>
                    <th>Transation Name</th>
                    <th>Transaction Number</th>
                    <th>Company Established</th>
                </tr>';
        if (mysqli_num_rows($result) > 0){
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {

                $Id = $row["admin_id"];
                $username=$row["admin_username"];
                $password=$row["admin_password"];
                $companyName=$row["admin_companyName"];
                $compAdd = $row['admin_companyAddress'];
                //$compDetails = trim($row['admin_companyDetails']);
                $transName =$row['admin_transactionName'];
                $transNumb = $row['admin_transactionNumber'];
                
                $estd = $row['admin_estdDate'];

                    echo'<tr>
                        <td>'.$Id.'</td>
                        <td>'.$username.'</td>
                        <td>'.$password.'</td>
                        <td>'.$companyName.'</td>
                        <td>'.$compAdd.'</td>
                        <td>'.$transName.'</td>
                        <td>'.$transNumb.'</td>
                        <td>'.$estd.'</td>
                    </tr>';
                
            }
        } else {
            echo "No data in table.";
        }
    ?>
</body>
</html>