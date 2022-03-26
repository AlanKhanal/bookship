<?php
include '../private/dbconnect.php';
?>
<!DOCTYPE html>
<html>

<head>
  <title>Upload file</title>
</head>

<body>
  <form method="POST" enctype="multipart/form-data" action="">
    <input type="file" name="productImg" required /><br />
    <input type="submit" value="Submit" name="submit" />
  </form>
</body>

</html>

<?php
if($_POST){
$target_dir = "../images/ProductImg/";
$bookImage = $target_dir.basename($_FILES["productImg"]["name"]);
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($bookImage,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["productImg"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($bookImage)) {
    echo "<br>Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
// if ($_FILES["productImg"]["size"] > 500000) {
//     echo "<br>Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<br>Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    //Only this code can be used to upload the file.
    echo "<br>".$bookImage."<br>";
    if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $bookImage)) {
        echo "The file ". basename( $_FILES["productImg"]["name"]). " has been uploaded.";
        $query="INSERT INTO products(`productImg`) VALUES('$bookImage')";
        $run=mysqli_query($conn,$query);
        if($run){
            echo 'Success';
        }
        else{
            echo 'error';
        }
    } else {
        echo "<br>Sorry, there was an error uploading your file.";
    }
}
}
?>