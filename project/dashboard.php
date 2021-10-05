<?php 
    include_once 'header.php';
?>


<div class='centered'>   
    <div class='element'style='box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 3px 10px 0 rgba(0, 0, 0, 0.19); border-radius: 5%;'>       
        <form action='includes/dashboard-inc.php' method='post'>
            <div class='registration'>
                <?php
                    echo "<label for='firstName'>first name</label>";
                    echo "<input class='registration' type='text' id='firstName' name='firstName' placeholder=". $_SESSION['first_name'] .">";
                    echo "<label for='lastName'>last name</label>";
                    echo "<input class='registration' type='text' id='lastName' name='lastName' placeholder=". $_SESSION["last_name"] .">";
                    echo "<label for='email'>email</label>";
                    echo "<input class='registration' type='email' id='email' name='email' autocomplete='new-password' placeholder=". $_SESSION['email'] .">";
                    echo "<button id='updateINFO' type='submit' class='submitBtn' name='updateINFO'>update my info</button>";
                    echo "<div class='dash-divider''></div>";
                    echo "<label for='password'>password</label>";
                    echo "<input class='registration' type='password' id='password' name='password' autocomplete='new-password' required/>";
                    echo "<label for='passwordConfirm'>re-enter password</label>";
                    echo "<input class='registration' type='password' id='passwordConfirm' name='passwordConfirm' required/>";
                    echo "<button id='updatePW' type='submit' class='submitBtn' name='updatePW'>update my password</button>";
                ?>
            </div>
        </form> 
        <?php
            if($_GET["error"] == "passwordsdontmatch"){
                echo "<p class='errorMessage'>* Passwords do not match</p>";
            }
            if($_GET["error"] == "none"){
                echo "<p class='success'>Password successfuly updated.</p>";
            }    
        ?>   
        
    </div>
    <div class='element'> 
        <h4>My Activity</h4>
        <div class='dash-divider' style="margin-top: -1%;"></div>;      
    </div>
</div>

<?php 
    include_once 'footer.php';
?>    
