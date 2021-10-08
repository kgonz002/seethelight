<?php

if(isset($_GET["email"])){
    $email = $_GET["email"];
}

if(isset($_POST["submitPassword"])) {   
    
    $password = $_POST["password"];
   
    
    require_once 'config.php';
    require_once 'functions-inc.php';

    if(!passwordMatch($password, $passwordConfirm)){
        header("location: ../reset-password.php?error=passwordsdontmatch");
        exit();
    }

    forgotPassword($conn, $email, $password);
}
else {
    header("location: ../index.php?error=stuffhappened");
}