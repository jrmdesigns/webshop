<?php
include("inc/header.php");
session_destroy();
echo "You are logged out!";
header( "refresh:1;url=index.php" );
include("inc/footer.php")
?>