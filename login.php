<?php include("inc/header.php");
$showError = false;
$showCorrect = false;
$errorMessage;
$correctMessage;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_real_escape_string($dbConnect, $_POST["email_input"]);
    $password = mysqli_real_escape_string($dbConnect, $_POST["password_input"]);

    $sqlSelect = "SELECT * FROM users WHERE UserEmail = '$email' AND UserPassword = '$password'";
    $selectResult = mysqli_query($dbConnect, $sqlSelect);
    if(mysqli_num_rows($selectResult) > 0){
        $userArray = array();
        while ($row = mysqli_fetch_assoc($selectResult))
		{
            $userArray[] = $row;
        }

        $id;
        foreach($userArray as $user){
            $id = $user["ID"];
            $role = $user["UserRole"];
        }
        echo $id;
        $showCorrect = true;
        $correctMessage = "You're logged in";
        $_SESSION["logged_in"] = "true"; 
        $_SESSION["user_id"] = $id;
        $_SESSION["user_role"] = $role;

        header( "refresh:2;url=index.php" );
    } else{
        $showError = true;
        $errorMessage = "Wrong username / password";
    }

}
?>
<section id="register-wrapper">
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" autocomplete="off" id="sign-up-form">
         <section class="form-group">
            <label for="input">Email:</label>
            <input type="text"  name="email_input" id="email_input">
        </section>
        <section class="form-group">
            <label for="input">Password:</label>
            <input type="password"  name="password_input" id="password_input">
        </section>

        <input type="submit" value="login" id="login_button">
        <?php if($showError == true){
                echo '<ul class="error">';
                echo "<li class='errorMessage'>" . $errorMessage . "</li>";
                echo '</ul>';
            }

            if($showCorrect == true){
                echo '<ul class="check">';
                echo '<li class="correctMessage">'. $correctMessage.'</li>';
                echo '</ul>';
            }

            ?>
        <a href="register.php" style="text-align: center;">Forgot your password?</a>
    </form>

        <section id="information">
        <h1>Why should you sign-up?</h1>
        <ul class="check">
            <li>Keep your information saved</li>
            <li>You can change your information</li>
            <li>You can see all your orders</li>
        </ul>
        <a href="register.php">Not signed up? Register here</a><br/>
    </section>
</section>


<?php include("inc/footer.php"); ?>