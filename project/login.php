<?php 
    include_once 'header.php';

?>

<div class="container">
    <div class="loginContainer">
        <form action="includes/login-inc.php" method="post">
            <div class="registration">                       
                <label for="email">email</label>
                <input class='registration' type="text" id="email" name="email" required/>
                <label for="password">password</label>
                <input class='registration' type="password" id="password" name="password" required/>                       
            </div>
            <?php 
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p class='errorMessage'>* Fill in all fields</p>";
                    }
                    if($_GET["error"] == "wrongpassword"){
                        echo "<p class='errorMessage'>* Incorrect password</p>";
                    }
                    if($_GET["error"] == "emailnotregistered"){
                        echo "<p class='errorMessage'>* Email not registered</p>";
                    }
                    if($_GET["error"] == "usernotapproved"){
                        echo "<p class='errorMessage'>* Your registration approval is still pending.</p>";
                    }
                    if($_GET["error"] == "emailnotverified"){
                        echo "<p class='errorMessage'>* Your email address has not been verified.</p>";
                    }  
                }
            ?>        
            <button id="submitLogin" type="submitLogin" class="submitBtn" name="submitLogin">SUBMIT</button>
            <a href="forgot-password.php" style="display: block;">Forgot your password?</a>
        </form> 
    </div>          
</div>


<?php 
    include_once 'footer.php';
?>    