
<?php

if(isset($_POST["updatePW"])){
    session_start();
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];
    $id = $_SESSION['id'];

    require_once 'config.php';
    require_once 'functions-inc.php';


    if(passwordMatch($password, $passwordConfirm)){
        header("location: ../dashboard.php?error=passwordsdontmatch");
        exit();
    }

    updatePassword($conn, $password, $id);
}
else {
    header("location: ../login.php");
    exit();
}