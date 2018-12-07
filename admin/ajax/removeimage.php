<?php
    session_start();
    if(!isset($_SESSION["user_role"]) || $_SESSION["user_role"] != "admin"){
        exit;
    }
include("../../inc/database.class.php");
include("../../inc/query.class.php");
$image = $_GET["image"];
$id = $_GET["id"];

$query = new Query();
$query2 = new Query();

$select = $query->query("SELECT Images FROM products WHERE ID = '$id'");
$images = explode(", ", $select["Images"]);
$index = array_search($image, $images);
if($index !== false)
 unset($images[$index]);



$images = implode(", ", $images);
echo $images;
$update = $query2->query("UPDATE products SET Images = '$images' WHERE ID = '$id'");

?>