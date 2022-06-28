<?php

include ('../private/dbconnect.php');

if(isset($_REQUEST['fdID'])){
    $id=$_REQUEST['fdID'];
    $delete=mysqli_query($conn,"DELETE FROM feedback WHERE feedbackID=$id");
    if($delete){
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <script>
            function backed(){
                history.back();
            }
            
        </script>
        </head>
        <body>
        <script>backed();</script>
        </body>
        </html>
        <?php
    }
}
?>