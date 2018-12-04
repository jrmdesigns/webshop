<?php
require_once("inc/config.php");
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

    $totalPrice += $data["Price"];
    echo $output;
}

if(strpos($totalPrice, '.00') == false){
    $totalPrice = $totalPrice . ".00";
}

$endOutput  = '<li class="noborder"></li>';
$endOutput .= '<li id="total-message">Total:<span class="price">$' . $totalPrice . '</span></li>';
echo $endOutput;
?>