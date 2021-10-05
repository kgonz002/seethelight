
<?php

if(isset($_POST["submitCode"])) {  
   

    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator(); 
    $qrcode = $_POST['qrcode'];
    $secret = 'XVQ2UIGO75XRUKJO'; 

    require_once 'config.php';
    require_once 'functions-inc.php';

    authenticateLogin($g, $qrcode, $secret);   
    
}
else {
    header("location: ../index.php?error=stuffhappened");
    exit();
}

