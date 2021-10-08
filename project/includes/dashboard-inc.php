
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

elseif(isset($_POST["updateINFO"])){
    session_start(); 

    require_once 'config.php';
    require_once 'functions-inc.php'; 
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];   
    $id = $_SESSION['id'];    
      
    updateName($conn, $first_name, $last_name, $id);  

}
else {
    header("location: ../dashboard.php?error=notset");
    exit();
}
