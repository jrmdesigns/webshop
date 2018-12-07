<?php
    session_start();
    if(!isset($_SESSION["user_role"]) || $_SESSION["user_role"] != "admin"){
        exit;
    }
include("../../inc/database.class.php");
include("../../inc/query.class.php");
$color = $_GET["color"];
$id = $_GET["id"];
echo $color;
$query = new Query();
$query2 = new Query();

$select = $query->query("SELECT Colors FROM products WHERE ID = '$id'");
$colors = explode(", ", $select["Colors"]);
$index = array_search($color, $colors);
if($index !== false)
 unset($colors[$index]);



$colors = implode(", ", $colors);
echo $colors;
$update = $query2->query("UPDATE products SET Colors = '$colors' WHERE ID = '$id'");

?>