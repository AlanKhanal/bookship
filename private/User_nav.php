<?php
    if(isset($_REQUEST['searchSub'])){
        $sr=trim($_REQUEST['searchTxt']);
        $valid=true;
        if($sr==""){

        }
        else{
            header("location:../public/User_search.php?sr=$sr");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            padding:0px;
            margin:0px;
        }
        .w-body{
            background-color: #20214a;
            width: auto;
        }
        .w-body input,.w-body{
            font-size: 22px;
        }
        .w-body div{
            padding: 0px 0%;
        }
        .nav1{
            text-align: center;
        }
        .nav1-1{
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .nav1-1 div{
           padding-left: 30px;
           padding-bottom: 5px;
           padding-top:5px;
           /* padding-right:1rem; */
        }
        .nav1 div{
            padding:5px 5px;
        }
        .home:hover{
            /* padding:5px 5px; */
            transform: scaleX(1.1);
        }
        .cat #catHead:hover{
            /* padding:5px 5px; */
            transform: scaleX(1.1);
        }
        .nav2{
            display: flex;
            justify-content: space-around;
        }
        .search{
            padding:0px;
            margin:0px;
            /* font-size: 12px; */
        }
        .w-body a{
            text-decoration:none;
            color:white;
        }
        .w-body input{
            padding:1px 5px;
        }
        .catList2{
            font-size: 22px;
        }   
        .icon img:hover{
            /* width:37px; */
            transform: scaleX(1.1);
        }
        .home,.cat{
            padding-left:1rem;
        }
        .logo a h3{
            text-decoration: underline dotted;
        }
        .src{
            padding: 0px;
            background-color: #fa5012;
            border: 2px solid coral;
            color:white;

            border-left: white;
            border-top-right-radius:5px;
            border-bottom-right-radius: 5px;
        }
        .inpsrc{
            border: 2px solid coral;
            border-top-left-radius:5px;
            border-bottom-left-radius: 5px;
            border-right: none;
        }
    </style>
</head>
<body>
    <div class="w-body">
        <div class="nav1">
            <div class="logo">
                <a href="../public/User_home.php">
                    <?php
                        // COMPANY_NAME
                        $adminName=mysqli_query($conn,"SELECT companyName FROM admins");
                        while($getComp=mysqli_fetch_array($adminName)){
                            $new=strtoupper($getComp['companyName']);
                            ?><u><b><h3><?=$new?></h3></b></u>
                            <?php
                        }
                    ?>
                </a>
            </div>
        </div>
        <!-- <hr/> -->
        <div class="nav2">
            <div class="nav1-1">
                <div class="home">
                    <div><a href="../public/User_home.php">Home</a></div>
                </div>
                <div class="cat">
                    <div id="catHead" onclick="catHide()" style="cursor:pointer;color:white;">Categories</div>
                    <script>
                        function catHide(){
                            var x = document.getElementById("catList");
                            if (x.style.display === "none") {
                                x.style.display = "block";
                            } else {
                                x.style.display = "none";
                            }
                        }
                    </script>
                    <div id="catList" style="font-size:18px;position:fixed;" hidden>
                    <table style="border:1px solid red;padding:4px 8px;background-color:#20214a;color:white">
                        <?php
                        $getCats="SELECT * FROM categories WHERE categoryStatus=1";
                        $runGet29=mysqli_query($conn,$getCats);
                        $numData32=mysqli_num_rows($runGet29)>0;
                
                        if($numData32){
                            while ($getRow33 = mysqli_fetch_array($runGet29)){
                                $catss=$getRow33['categoryName'];
                                $catssID=$getRow33['categoryID'];
                                ?>
                                <tr>
                                    <td class="catList2"><a href="../public/User_category.php?cat=<?=$catss?>"><?=$catss?></a><hr></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                    
                    </div>
                </div>
            </div>
            <div class="search">
                <form action="" method="POST">
                    <div style="display:flex;justify-content:flex-start;">
                        <input type="text" placeholder="Search" name="searchTxt" class="inpsrc">
                    <input type="submit" name="searchSub" value="Go" class="src">
                </div>
            </div>
            <div class="nav1-1">
                <div class="icon">
                <a href="../public/wishlist.php"><img src="../icon/listIcon.jpg" alt="" width=35px height=35px style="margin-top:-11px"></a>
                </div>
                <div class="icon">
                    <a href="../public/cart.php"><img src="../icon/cartIcon.jpg" alt="" width=35px height=35px style="margin-top:-11px"></a>
                </div>
                <div class="icon">
                <a href="../public/profile.php"><img src="../icon/profIcon.jpg" alt="" width=35px height=33px style="margin-top:-11px"></a>
                </div>
            </div>
        </div>
        <hr/>
    </div>
</body>
</html>