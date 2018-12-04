<?php include("inc/header.php");
$errorMessage = false;
$succesMessage = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_real_escape_string($dbConnect, $_POST["email_input"]);
    $password = mysqli_real_escape_string($dbConnect, $_POST["password_input"]);
    $address = mysqli_real_escape_string($dbConnect, $_POST["address_input"]);
    $postalcode = mysqli_real_escape_string($dbConnect, $_POST["postalcode_input"]);
    $city = mysqli_real_escape_string($dbConnect, $_POST["city_input"]);

    $sqlSelect = "SELECT * FROM users WHERE UserEmail = '$email'";
    $selectResult = mysqli_query($dbConnect, $sqlSelect);
    if(mysqli_num_rows($selectResult) > 0){
        $errorMessage = true;
    } else{
        $sqlInsert = "INSERT INTO users (UserEmail, UserPassword, UserAddress, UserPostalcode, UserCity) VALUES ('$email', '$password', '$address', '$postalcode', '$city')";
        $sqlInsertResult = mysqli_query($dbConnect, $sqlInsert);
        if(!$sqlInsertResult){
            echo "error";
        } else{
            $succesMessage = true;
            header( "refresh:2;url=login.php" );
        }
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
        <section class="form-group">
            <label for="input">Confirm password:</label>
            <input type="password"  name="password-confirm_input" id="password-confirm_input">
        </section>
        <section class="form-group">
            <label for="input">Address:</label>
            <input type="text"  name="address_input" id="address_input">
        </section>
        <section class="form-group">
            <label for="input">Postalcode:</label>
            <input type="text"  name="postalcode_input" id="postalcode_input">
        </section>
        <section class="form-group">
            <label for="input">City:</label>
            <input type="text"  name="city_input" id="city_input">
        </section>

        

        <input type="submit" value="register" id="register_button">

            <ul class="error" id="error_list">
            <?php
            if($errorMessage)
            {
                echo "<li class='errorMessage'>Account already exists</li>";
            }
            ?>

            </ul>


        <ul class="check">
            <?php if($succesMessage)
            {   
                echo '<ul class="check">';
                echo '<li class="correctMessage"><a href="#">Account created, you can now loggin</a></li>';
                echo '</ul>';
            }
            ?>
        </ul>
    </form>

    <section id="information">
        <h1>Why should you sign-up?</h1>
        <ul class="check">
            <li>Keep your information saved</li>
            <li>You can change your information</li>
            <li>You can see all your orders</li>
        </ul>
        <a href="login.php">Do you have an exists account?</a>
    </section>
</section>
<script>

function checkRegex(inputToCheck, expression){
  console.log("checkRegex called");
  var input = inputToCheck;
  console.log(input);
  var regex = new RegExp(expression);
  if(!regex.test(input))
    {
        return false;
    } else{
        return true;
    }
}


    $("#sign-up-form").submit(function(event){

        emailInput = "";
        password = "";
        passwordConfirm = "";
        address = "";
        postalcode = "";
        city = "";

        emailInput = $("#email_input").val();
        password = $("#password_input").val();
        passwordConfirm = $("#password-confirm_input").val();
        address = $("#address_input").val();
        postalcode = $("#postalcode_input").val();
        city = $("#city_input").val();
        error = false;
        errorList = [];

        console.log("test");

        if(emailInput == ""){
            error = true;
            errorList.push("Please enter mail!");
            console.log("email empty");
        } else if(!checkRegex(emailInput, '^([\\w-]+(?:\\.[\\w-]+)*)@((?:[\\w-]+\\.)*\\w[\\w-]{0,66})\\.([a-z]{2,6}(?:\\.[a-z]{2})?)$')){
            error = true;
            errorList.push("Please enter a correct email!");
        }
        
        if(password == ""|| passwordConfirm == ""){
            error = true;
            errorList.push("Please enter a password");
            console.log("PSSW");
        } else if(password != passwordConfirm){
            error = true;
            errorList.push("Password doesn't match");
        }

        if(address == ""){
            error= true;
            errorList.push("Address can't be empty");
        }

        if(postalcode == ""){
            error= true;
            errorList.push("Postalcode can't be empty");
        }

        if(city == ""){
            error= true;
            errorList.push("City can't be empty ");
        }

        if(error == true){
            errorListElement = document.getElementById("error_list");
            errorListElement.innerHTML = "";
            for(i = 0; i < errorList.length; i++){
                errorText = document.createTextNode(errorList[i]);
                li = document.createElement("li");
                li.classList.add("errorMessage");
                li.appendChild(errorText);
                errorListElement.appendChild(li);
            }
           return false;
        } else{
            return true;
        }

    });
</script>
<?php include("inc/footer.php"); ?>