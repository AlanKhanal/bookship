<!DOCTYPE html>
<html>
<head>
        <title>Document</title>
        <style>
                nav{
    background: cornflowerblue;
}

nav::after{
    content: '';
    clear: both;
    display: table;
}

nav .logo{
    float: left;
    color: white;
    font-size: 27px;
    font-weight: 600;
    line-height: 70px;
    padding-left: 60px;
}

nav ul{
    float: right;
    list-style-type: none;
    margin-right: 40px;
    position: relative;
    margin-bottom: 0;
}

nav ul li{
    /* float: left; */
    display: inline-block;
    background: cornflowerblue;
    margin: 0 5px;
}

nav ul li a{
    color: black;
    text-decoration: none;
    line-height: 70px;
    font-size: 18px;
    padding: 5px 10px;
}

nav ul li a:hover{
    color: white;
    /* border-radius: 5px;
    box-shadow: 0 0 5px royalblue,
                0 0 5px purple; */
}


nav ul ul{
        
    position: absolute;
    top: 90px;
    /* display: none; */
    opacity: 0;
    visibility: hidden;
    transition: top .5s;
}

nav ul li:hover > ul{
    top: 70px;
    /* display: block; */
    opacity: 1;
    visibility: visible;
}

nav ul ul li{
    position: relative;
    margin: 0;
    /* width: 100px; */
    float: none;
    display: list-item;
    border-bottom: 1px solid black;
}
        </style>
</head>
<body>
<nav>
        <div class="logo">Bookship</div>
            <ul>
                <li><a href="../public/Admin_home.php">Home</a></li>

                <li>
                    <a href="">Manage</a>
                    <ul>
                        <li><a href="../public/Admin_product_management.php">Product</a></li>
                        <li><a href="../public/Admin_category_management.php">Categories</a></li>
                    </ul>
                </li>

                <li><a href="">About Us</a></li>

                <li>
                        <a href="">Settings</a>
                        <ul>
                            <li><a href="../private/Admin_changePassword.php">Change Password</a></li>
                            <li><a href="../private/Admin_changeInfo.php">Edit Profile</a></li>
                            <li><a href="">Dump ></a>
                                <ul>
                                <li><a href="../private/Admin_moreManagement.php">Product</a></li>
                                <li><a href="../private/Admin_moreManagementCat.php">Category</a></li>
                                </ul>
                            </li>
                        </ul>
                </li>

                <li><a href="">Switch</a>
                    <ul>
                        <li><a href="Admin_login.php">Admin</a></li>
                        <li><a href="User_login.php">User</a></li>
                    </ul>
                </li>

                <li>
                        <a href="../private/Admin-logout.php">Logout</a>
                </li>
            </ul>
    </nav>
</body>
</html>