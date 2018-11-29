<?php
	$database = "webshop";
	$dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "";

	$dbConnect = mysqli_connect($dbHost, $dbUser, $dbPass, $database);
	if(!$dbConnect){
		echo "Unable to connect with the database" . PHP_EOL;
	} else {
        $imagesPath = "images/";
		$categoriesSql = "SELECT * FROM categories";
		$categorieResult = mysqli_query($dbConnect, $categoriesSql);
		$categorieData = array();
		while ($row = mysqli_fetch_assoc($categorieResult))
		{
            $categorieData[] = $row;
		}
	}
?>