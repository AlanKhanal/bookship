<?php
    include ('../private/dbconnect.php');

// $query="INSERT INTO cart(`qty`) VALUES(2)";
// $run=mysqli_query($conn,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <input type="number" value=1 onclick="submission();" id="number">
        <input type="number" value=2 id="num2" name="num2" hidden>
    </form>
    <script>
        function submission(){
            num=document.getElementById("number").value;
            alert(document.getElementById("num2").value=num*5);

            // $(document).ready(()=>{
                        $.ajax({
                            url : 'demo32.php',
                            type: 'POST',
                            data: $('#num2').serialize(),
                            success : (data) =>{
                                alert(data);
                            }
                })
                    // });
                success();
            }
    </script>
</body>
</html>