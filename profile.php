<?php include("inc/header.php");

$showMessage = false;
$message;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $address = mysqli_real_escape_string($dbConnect, $_POST["address"]);
    $postalcode = mysqli_real_escape_string($dbConnect, $_POST["postalcode"]);
    $city = mysqli_real_escape_string($dbConnect, $_POST["city"]);
    $id = $_SESSION["user_id"];


    $sqlUpdate = "UPDATE users SET UserAddress = '$address', UserPostalcode = '$postalcode', UserCity = '$city' WHERE ID = '$id'";
    $sqlUpdateResult = mysqli_query($dbConnect, $sqlUpdate);
    if(!$sqlUpdateResult){
        $message = "Unable to make changes";
        $showMessage = true;
    } else{
        $message = "changes are successful";
        $showMessage = true;
    }   

}

?>

<section id="register-wrapper">
    <?php
    if(!isset($_SESSION["user_id"])){
        header("location:login.php" );
    } else{
        $id = $_SESSION["user_id"];
        $sqlSelect = "SELECT * FROM users WHERE ID = '$id'";
        $selectResult = mysqli_query($dbConnect, $sqlSelect);
        $userData = array();
        while($row = mysqli_fetch_assoc($selectResult)){
            $userData[] = $row;
        }

        foreach($userData as $data){
            $output  = "<form method='post' action='" . $_SERVER["PHP_SELF"] . "'>";
            $output .= "<section class='form-group'>";
            $output .= "<label for='input'>Address:</label>";
            $output .= "<input type='text' name='address' value='" . $data["UserAddress"] . "'/>";
            $output .= "</section>";
            $output .= "<section class='form-group'>";
            $output .= "<label for='input'>Postalcode:</label>";
            $output .= "<input type='text' name='postalcode' value='" . $data["UserPostalcode"] . "'/>";
            $output .= "</section>";
            $output .= "<section class='form-group'>";
            $output .= "<label for='input'>City:</label>";
            $output .= "<input type='text' name='city' value='" . $data["UserCity"] . "'/>";
            $output .= "</section>";
            $output .= "<input type='submit' value='edit'/>";
            if($showMessage){
                $output .= "<ul class='check'>";
                $output .= "<li class='correctMessage'>" . $message . "</li>";
            }
            $output .= "</form>";
            echo $output;
        }
    }
    ?>
</section>


<?php include("inc/footer.php"); ?>