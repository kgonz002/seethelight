<?php 
    include_once 'header.php';
?>

<div class="container">
    <div class="registrationContainer">
        <form action="includes/register-inc.php" method="post">
            <div class="registration">
                <label for="firstName">first name</label>
                <input class='registration' type="text" id="firstName" name="firstName" required/>
                <label for="lastName">last name</label>
                <input class='registration' type="text" id="lastName" name="lastName" required/>
                <label for="email">email</label>
                <input class='registration' type="email" id="email" name="email" required/>
                <label for="cell_num">mobile number</label>
                <input class='registration' type="tel" id="cell_num" name="cell_num" required/>
                <label for="password">password</label>
                <input class='registration' type="password" id="password" name="password" required/>
                <label for="passwordConfirm">re-enter password</label>
                <input class='registration' type="password" id="passwordConfirm" name="passwordConfirm" required/>
            </div>
            <?php 
                if(isset($_GET["error"])){
                    if($_GET["error"] == "emptyinput"){
                        echo "<p class='errorMessage'>* Fill in all fields</p>";
                    }
                    if($_GET["error"] == "invalidemail"){
                        echo "<p class='errorMessage'>* Invalid email format</p>";
                    }
                    if($_GET["error"] == "invalidcell"){
                        echo "<p class='errorMessage'>* Mobile number is invalid</p>";
                    }
                    if($_GET["error"] == "passwordsdontmatch"){
                        echo "<p class='errorMessage'>* Passwords do not match</p>";
                    }
                    if($_GET["error"] == "emailalreadyregistered"){                
                        echo "<p class='errorMessage'>* Email is already registered</p>";
                    }
                    if($_GET["error"] == "none"){
                        echo "<p class='success'>Registration successful, an administrator will complete your request shortly.</p>";
                    }     
                                            
                }
                
            ?>            
            <button id="submitRegistration" type="submit" class="submitBtn" name="submit">SUBMIT</button>            
        </form>                    
    </div>
</div>

<?php 
    include_once 'footer.php';
?>    
