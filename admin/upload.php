<?php
echo $_POST["product_description"];


include '../inc/config.php';
$target_dir = "../images/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }   
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        $category = mysqli_real_escape_string($dbConnect, $_POST["product_category"]);
        $productName = mysqli_real_escape_string($dbConnect, $_POST["product_name"]);
        $productPrice = mysqli_real_escape_string($dbConnect, $_POST["product_price"]);
        $productDescription = mysqli_real_escape_string($dbConnect, $_POST["product_description"]);
        $productSpecifications = mysqli_real_escape_string($dbConnect, $_POST["product_specifications"]);
        
        
        $filename = "uploades/" . $_FILES["fileToUpload"]["name"];
                    $sql = "INSERT INTO products (CatID, ProductName, Price, ProductDescription, Specifications, Images)
                    VALUES ('$category',  '$productName', '$productPrice', '$productDescription', '$productSpecifications', '$filename')";

            mysqli_query($dbConnect, $sql);


        echo "Uploaded!";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>