<?php 
    include_once 'header.php';
?>

<div class="container">
    <div class="loginContainer">
        <form action="includes/forgot-password-inc.php" method="post">
            <div class="registration">
                <p class='success'>Enter your email address.  If your email is registered, we will send you a link to reset your password.</p>                       
                <label for="email">email</label>
                <input class='registration' type="email" id="email" name="email" required/>                     
            </div>
            <?php 
                if(isset($_GET["error"])){
                    if ($_GET["error"] == "emailnotregistered"){
                        echo "<p class='errorMessage'>* Email address not registered</p>";
                    }
                    if ($_GET["error"] == "none"){
                        echo "<p class='success'>Email sent.  Check spam folder if not in main inbox.</p>";
                    }                               
                }
            ?>        
            <button id="submitEmail" type="submitEmail" class="submitBtn" name="submitEmail">SUBMIT</button>           
        </form>
    </div>          
</div>


<?php 
    include_once 'footer.php';
?>    