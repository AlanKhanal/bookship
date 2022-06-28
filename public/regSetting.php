<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
    body{
        background:rgb(202, 205, 212);;
    }
        form{
            text-align: center;
        }
        .pw{
            border: 2px solid black;
        }
        .but input{
            border:2px solid black;
            background-color: grey;
        }
    </style>
</head>
<body>
    <?php
    include ('../private/dbconnect.php');
        if(isset($_REQUEST['guess'])){
            $pass=$_REQUEST['pwguess'];
            // if()
        }
    ?>
<form action="" method="POST">
        <label for=""><h4><u>GUESS PASSWORD</u></h4></label>
        <div><input type="password" name="pwguess" class="pw"></div>
        <div class="but" style="margin:1rem;"><input type="submit" name="guess" value="GUESS">
        <input type="submit" name="hint" value="HINT"></div>
    </form>
    <hr border="2px solid grey">
    <div>
    <h1>Contact Information</h1>
        <hr width="300rem" align="left">
        <div><h4>Phone: 9804916838</h4></div>
        <div><h4>Mail: alankhanal2001@gmail.com</h4></div>
    </div>
</body>
</html>