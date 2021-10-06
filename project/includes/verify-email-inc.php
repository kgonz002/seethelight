<?php

require_once 'config.php';
require_once 'functions-inc.php';

if(isset($_GET['vkey'])){
    $vkey = $_GET['vkey'];
    
    verifyEmail($conn, $vkey);

}

