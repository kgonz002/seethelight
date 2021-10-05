<?php

if(isset($_POST["submit"])) {
    
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];
    $status = "pending";
    // $vkey = ;
    $verify = 0;
    
    require_once 'config.php';
    require_once 'functions-inc.php';


    if(invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }

    if(passwordMatch($password, $passwordConfirm) !== false){
        header("location: ../register.php?error=passwordsdontmatch");
        exit();
    }

    if(emailExists($conn, $email) !== false){
        header("location: ../register.php?error=emailalreadyregistered");
        exit();
    }

    createUser($conn, $firstName, $lastName, $email, $password, $status, $vkey, $verify);
}
else {
    header("location: ../index.php?error=stuffhappened");
}