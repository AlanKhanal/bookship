<?php
$msg="";
//session
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

//categoryAdd
    $isvalid=true;
    if(isset($_POST['submit'])){
        $newcat = trim($_POST['categoryName']);
        $catDesc=trim($_POST['categoryDesc']);
        if($newcat == ""){
            $msg.='Insert Category Name.';
            $isvalid=false;
        } 
        else if(strlen($newcat)>50){
            $msg.='Only 50 characters allowed.*';
            $isvalid=false;
        }
        if(strlen($catDesc)>500){
            $msg.='Only 500 characters allowed.*';
            $isvalid=false;
        }
        //check if category already exist
        $catcheck=strtoupper($newcat);
        $catadd="SELECT upper(`categoryName`) FROM categories WHERE categoryName='$catcheck' AND adminID=$adminID and categoryStatus=1 ";
        $check = mysqli_query($conn, $catadd);
        $catnum = mysqli_num_rows($check);
        if($catnum>0){
            $msg.='Category already Exists.';
            $isvalid=false;
        }
        
    }

    if(isset($_POST['submit'])){
        if($isvalid){
            $catsql = "INSERT INTO categories(`adminID`,`categoryName`,`categoryDesc`) VALUES($adminID,'$newcat','$catDesc')";
            $cataddsql = mysqli_query($conn,$catsql);
            if($cataddsql){            
                $msg.='Category added successfully.';
            }
        } 
    }
    //tabledata fetch
    $fecthQuery="SELECT * FROM categories WHERE adminID=$adminID and categoryStatus=1 ORDER BY categoryName";
    if(isset($_REQUEST['catSearch'])){
        $csrch=$_REQUEST['search'];
        // echo $csrch;
        $fecthQuery="SELECT * FROM categories WHERE adminID=$adminID and categoryStatus=1 and categoryName LIKE '%$csrch%'";
        // echo "Search result for $csrch";
    }
    $runFetch=mysqli_query($conn,$fecthQuery);
?>