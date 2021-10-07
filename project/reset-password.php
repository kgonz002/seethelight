<?php 
    include_once 'header.php';
?>

<div class="container">
    <div class="loginContainer">
        <form action="includes/reset-password-inc.php" method="post">
            <div class="registration">                       
                <label for="password">password</label>
                <input class='registration' type="password" id="password" name="password" required/>
                <label for="password">confirm password</label>
                <input class='registration' type="password" id="passwordConfirm" name="passwordConfirm" required/>                       
            </div>
            <?php 
                if(isset($_GET["error"])){
                    if ($_GET["error"] == "passwordsdontmatch"){
                        echo "<p class='errorMessage'>* Passwords do not match</p>";
                    } 
                    if ($_GET["error"] == "none"){
                        echo "<p class='success'>Password reset successfuly!</p>";
                    }                  
                }
            ?>        
            <button id="submitPassword" type="submitPassword" class="submitBtn" name="submitPassword">SUBMIT</button>           
        </form>
    </div>          
</div>


<?php 
    include_once 'footer.php';
?>    