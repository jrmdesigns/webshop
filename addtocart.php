<?php
if(!isset($_GET["id"]) || !isset($_GET["amount"])){
    exit;
}
require_once("inc/config.php");
$id = $_GET["id"];
$amount = $_GET["amount"];

$selectProductSql = "SELECT * FROM products WHERE ID = '$id'";
$selectProductResult = mysqli_query($dbConnect, $selectProductSql);
$selectProductData = array();
while($row = mysqli_fetch_assoc($selectProductResult)){
    $selectProductData[] = $row;
}

foreach($selectProductData as $data){
    $price = $data["Price"] * $amount;
    $productName = $data["ProductName"];
    $updateSql = "INSERT INTO cart (ProductID, UserID, Color, Amount, Price, ProductName)
                  VALUES ('$id', 1, '" . (isset($_GET["color"]) && !empty($_GET["color"]) ? $_GET["color"] : "default") . "', '$amount', '$price', '$productName')";
    mysqli_query($dbConnect, $updateSql) or die(mysqli_error($dbConnect));
}

$selectCartSql = "SELECT * FROM cart WHERE UserID = 1";
$selectCartResult = mysqli_query($dbConnect, $selectCartSql);
$selectCartData = array();
while($row = mysqli_fetch_assoc($selectCartResult)){
    $selectCartData[] = $row;
}

$totalPrice = 0;
foreach($selectCartData as $data){
    $price = $data["Price"];
    $output  = "<li><a href='product.php?id=" . $data["ProductID"] . "'>";
    $output .= $data["ProductName"];
    $output .= "</a>";
    $output .= "<span> x" . $data["Amount"] . "</span>";
    $output .= "<span class='price'>"  . $price  . "</span>";
    $output .= "";
    $output .= "</li>";

    $totalPrice += $price;
    echo $output;
}

$endOutput  = '<li class="noborder"></li>';
$endOutput .= '<li id="total-message">Total:<span class="price">$' . $totalPrice . '</span></li>';
echo $endOutput;



?>