<!DOCTYPE html>
<html>
<head>
<style>
*{
    margin:0px;
    padding: 0px;    
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;

}
    nav{
    background: #003399;
    width: auto;
}
.logo{
  animation: color-change 25s infinite;
}

@keyframes color-change {
  0% { color: white; }
  20% { color: lightcoral; }
  40% { color: burlywood; }
  60% { color: lightgreen; }
  80% { color: rgb(249, 249, 83); }
  100% { color: white; }
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
    background: #003399;
    margin: 0 5px;
}

nav ul li a{
    color: white;
    text-decoration: none;
    line-height: 70px;
    font-size: 18px;
    padding: 5px 10px;
}

nav ul li a:hover{
    color: cornflowerblue;
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
        <div class="logo">BOOKSHIP</div>
            <ul>
                <li>
                    <a href="../public/Admin_login.php">Login</a>
                </li>

                <li>
                    <a href="../public/Admin_register.php">Register</a>
                </li>

                <li>
                    <a href="../public/user_login.php">User</a>
                </li>
            </ul>
    </nav>
</body>
</html>






