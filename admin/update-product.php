<?php
    session_start();

include("../inc/config.php");
if(!isset($_SESSION["user_role"]) || $_SESSION["user_role"] != "admin"){
    exit;
}
$id = $_GET["id"];
// $content = $_GET["content"];
$kind = $_GET["kind"];
$value = $_GET["value"];

$sqlUpdate = "UPDATE products SET $kind = '$value' WHERE ID = '$id'";
$sqlUpdateResult = mysqli_query($dbConnect, $sqlUpdate);
if(!$sqlUpdateResult){
    $message = "Unable to make changes";
    $showMessage = true;
} else{
    $sqlSelect = "SELECT * FROM products WHERE ID = '$id'";
    $sqlSelectResult = mysqli_query($dbConnect, $sqlSelect);
    $dataArray = array();
	while ($row = mysqli_fetch_assoc($sqlSelectResult))
	{
            $dataArray[] = $row;
    }
    
    foreach($dataArray as $data){
        echo $data[$kind];
    }
}


?>