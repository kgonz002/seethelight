<?php 
    include_once 'header.php';
?>                               

    <div class="hero-image">
        <div class="hero-text">
            <h1>See</h1>
            <h1>the light.</h1>  
        </div>
        <div class="register-form"  style="padding-top: 10%;">
            <div class="hero-divider"></div>
            <?php
                if (isset($_SESSION["first_name"]) && $_SESSION['authenticated'] === true){
                    echo "<h3>Hi ". $_SESSION['first_name'] .",</h3>";
                    echo "<p>Welcome to See the Light!</p>";
                    echo "<div class='hero-divider'></div>";
                    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                    ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur.<br><br>Duis aute irure dolor in 
                    reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint 
                    occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
                }
                else{
                    echo "<h3>Lorem Ipsum</h3>";
                    echo "<div class='hero-divider'></div>";
                    echo "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                    ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
                    in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>";
                    echo "<button id='loginButton' type='button' class='registerBtn landingPageBtn' onclick=\"window.location.href='login.php'\">SIGN IN</button>";                               
                    echo "<button id='registerButton' type='button' class='registerBtn landingPageBtn' onclick=\"window.location.href='register.php'\">REGISTER</button";

                }
            ?>             
        </div> 
    </div>           
        

<?php 
    include_once 'footer.php';
?>    
       
