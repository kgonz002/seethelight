<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'phpadmin');
    define('DB_PASSWORD', 'Poophead2');
    define('DB_NAME', 'projectDB');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
