<?php

if(isset($_POST["submit"])) {
    
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $cell_num = $_POST["cell_num"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];
    $status = "pending";

    require_once 'config.php';
    require_once 'functions-inc.php';

    if(emptyInputSignup($conn, $firstName, $lastName, $email, $cell_num, $password, $passwordConfirm) !== false) {
        header("location: ../register.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($email) !== false) {
        header("location: ../register.php?error=invalidemail");
        exit();
    }
    if(invalidCell($cell_num) !== false){
        header("location: ../register.php?error=invalidcell");
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

    createUser($conn, $firstName, $lastName, $email, $password, $status, $cell_num);
}
else {
    header("location: ../index.php?error=stuffhappened");
}