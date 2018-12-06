<?php
include("../../inc/database.class.php");
include("../../inc/query.class.php");
$color = $_GET["color"];
$id = $_GET["id"];
$query = new Query();
$query2 = new Query();

$select = $query->query("SELECT Colors FROM products WHERE ID = '$id'");
$colors = explode(", ", $select["Colors"]);
array_push($colors, $color);
$colors = implode(", ", $colors);
$colors = str_replace("Array", "", $colors);
$update = $query2->query("UPDATE products SET Colors = '$colors' WHERE ID = '$id'");

echo $color . " added";
?>

<script>
    
</script>