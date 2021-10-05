<?php
    include_once 'header.php';
    require 'vendor/autoload.php'; 
?>   

<?php
    include_once 'GoogleAuthenticatorInterface.php';
    $secret = 'XVQ2UIGO75XRUKJO';
    $code = '846474';
    $qr = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('auth', $secret, 'seethelight');
?>

<div class='centered'>
    <h3>Scan the QR code and enter the provided numbers</h3>
    <?php
        echo "<img src=". $qr ."/>";
    ?>
    <p>Authentication requires use of the <b>Google Authenticator</b> App.</p>
    <div class="check-code">
        <form action='authenticate.php' method='post'>
            <button id='submitCode' class='search' type='submit' name='submitCode'>submit</button>
            <input id='qrcode' class='search' type='text' name='qrcode' required>                                       
        </form>
    </div>


 <?php
    if(isset($_POST["submitCode"])) {  
    
        $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator(); 
        $qrcode = $_POST['qrcode'];

        if ($g->checkCode($secret, $qrcode)) {        
            $_SESSION['authenticated'] = true;
            header("location: ./index.php");
            exit();
         } 
         else {
             header("location: ./authenticate.php?error=wrongcode");
             exit();
         }
         
    }

    if(isset($_GET["error"])){
        if($_GET["error"] == "wrongcode"){
            echo "<p class='errorMessage'>* Incorrect code</p>";
        }
    }
 ?>
 </div>




<?php
    include_once 'footer.php';
?>   