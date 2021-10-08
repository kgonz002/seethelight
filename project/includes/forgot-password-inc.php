<?php

if(isset($_POST["submitEmail"])) {  
   

    $email = $_POST["email"];    

    require_once 'config.php';
    require_once 'functions-inc.php';

    emailResetPassword($conn, $email);   
    
}
else {
    header("location: ../index.php?error=stuffhappened");
    exit();
}
