<!DOCTYPE html>
<html>
<head>
    <style>
        *{
            padding:0px;
            margin:0px;
        }
        .w-body{
            background-color: #ff3333;
        }
        .w-body input,.w-body{
            font-size: 22px;
        }
        .w-body div{
            padding: 0px 5%;
        }
        .nav1{
            text-align: center;
        }
        .nav1-1{
            display: flex;
            justify-content: space-between;
        }
        .nav1-1 div{
           padding: 5px 5px;
        }
        .nav1 div{
            padding:5px 5px;
        }
        .nav2{
            display: flex;
            justify-content: space-between;
        }
        .nav2 div{
            padding: 5px 5px;
        }
        .search{
            padding:0px;
            margin:0px;
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
                            $new=$getComp['companyName'];
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
                    <div id="catHead" onclick="catHide()" id="" style="cursor:pointer;color:white;">Categories</div>
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
                    <table style="border:1px solid #ff3333;padding:4px 8px;background-color:#ff3333;color:white">
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
                <input type="text" placeholder="Search">
                <input type="submit" name="submit" value="SEARCH">
            </div>
            <div class="nav1-1">
                <div class="cart">
                    <a href="../public/cart.php">Cart</a>
                </div>
                <div class="wishlist">
                <a href="../public/wishlist.php">Wishlist</a>
                </div>
                <div class="profile">
                <a href="../public/profile.php">Profile</a>
                </div>
            </div>
        </div>
        <hr/>
    </div>
</body>
</html>