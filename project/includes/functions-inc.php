<?php


function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;

}


function passwordMatch($password, $passwordConfirm){
    if($password !== $passwordConfirm){
        return true;
    }
    return false;
}

function emailExists($conn, $email){
    $sql = "SELECT * from users WHERE email = ?;";
    $stmt = mysqli_stmt_init($conn); //initialize a prepared statment, prevents code injection
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailedemail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email); //1 s for 1 string being passed
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        return false;
    }

    mysqli_stmt_close($stmt);
}



function createUser($conn, $firstName, $lastName, $email, $password, $status, $vkey, $verified){
    
    $sql = "INSERT INTO users (first_name, last_name, email, password, status, vkey, verified) VALUES (?, ?, ?, ?, ?, ?, ?);";    
    $stmt = mysqli_stmt_init($conn); //initialize a prepared statment, prevents code injection
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailedinsert");
        exit();
    }
    
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $email, $hashedPwd, $status, $vkey, $verified); //1 s for 1 string being passed
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if($stmt){       

        $to = $email;
        $subject = "See the Light - Email Verification";
        $message = "<a href='http://localhost/cs518/seethelight/project/includes/verify-email-inc.php?vkey=$vkey'>Verify Email Address</a>";

        // It is mandatory to set the content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers. From is required, rest other headers are optional
        $headers .= 'From: <kimberlyreneegonzales@gmail.com>' . "\r\n";
        

        mail($to,$subject,$message,$headers);

        
    }

    header("location: ../register.php?error=none");
    exit();       
}



function emptyInputLogin($email, $password){
    $result = false;
    if(empty($email) || empty($password)){
       return true;
    }
    return false;
}



function loginUser($conn, $email, $password){

   $uidExists = emailExists($conn, $email);

   if(!$uidExists){
    header("location: ../login.php?error=emailnotregistered");
    exit();
   }

   
   if($uidExists['verified'] === '0') {
    header("location: ../login.php?error=emailnotverified");
    exit();  
   }
   elseif($uidExists['status'] === 'pending') {
    header("location: ../login.php?error=usernotapproved");
    exit();  
   }   
   else {   
        $pwdHashed = $uidExists["password"];
        $checkPwd = password_verify($password, $pwdHashed);
     
        if($checkPwd === false){
         header("location: ../login.php?error=wrongpassword");
         exit();
        }     
        else if ($checkPwd === true) {
            session_start(); 
            $_SESSION["id"] = $uidExists["id"];
            $_SESSION["first_name"] = $uidExists["first_name"];
            $_SESSION["last_name"] = $uidExists["last_name"];
            $_SESSION["email"] = $uidExists["email"];
            $_SESSION["cell_num"] = $uidExists["cell_num"];
            $_SESSION["vkey"] = $uidExists["vkey"];
            $_SESSION["verified"] = $uidExists["verified"];
            
            
            if($_SESSION["first_name"] == 'admin'){
                $_SESSION["authenticated"] = true;
                header("location: ../admin.php?error=adminlogin");
                exit();
            }
            else{
                $_SESSION["authenticated"] = false;
                header("location: ../authenticate.php");
                exit();
            }    
        }
    }
   
}


//update password from user dashboard
function updatePassword($conn, $password, $id){
    $sql = "UPDATE users SET password = ? WHERE id = ?;";    
    $stmt = mysqli_stmt_init($conn); //initialize a prepared statment, prevents code injection

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailedinsert");
        exit();
    }
    
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $id); //1 s for 1 string being passed
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../dashboard.php?error=none");
    exit();   


}


//reset password after receiving email (forgotten)
function forgotPassword($conn, $password, $email){
    $sql = "UPDATE users SET password = ? WHERE email = ?;";    
    $stmt = mysqli_stmt_init($conn); //initialize a prepared statment, prevents code injection

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailedinsert");
        exit();
    }
    
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $email); //1 s for 1 string being passed
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../reset-password.php?error=none");
    exit();   


}



function updateUserInfo($conn){
    #code....
}



function authenticateLogin($g, $qrcode, $secret){
    
    if ($g->checkCode($secret, $qrcode)) {        
       $_SESSION['authenticated'] = true;
       header("location: ./index.php");
       exit();
    } 
    else {
        header("location: ../authenticate.php?error=wrongcode");
        exit();
    }
}



function verifyEmail($conn, $vkey){

    $verified = 1;

    $sql = "UPDATE users SET verified = ? WHERE vkey = ?;";    
    $stmt = mysqli_stmt_init($conn); //initialize a prepared statment, prevents code injection

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailedinsert");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt, "ss", $verified, $vkey); //1 s for 1 string being passed
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../verify-email.php?error=none");
    exit();   

}



function emailResetPassword($conn, $email){

    $uidExists = emailExists($conn, $email);      
    
    if (!$uidExists){
        header("location: ../forgot-password.php?error=emailnotregistered");
        exit();
       }
    
   else {   

        $to = $email;
        $subject = "See the Light - Password Reset";
        $message = "<a href='http://localhost/cs518/seethelight/project/reset-password.php?email=$email'>Password Reset Link</a>";

        // It is mandatory to set the content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers. From is required, rest other headers are optional
        $headers .= 'From: <kimberlyreneegonzales@gmail.com>' . "\r\n";
        

        mail($to,$subject,$message,$headers);        
    }
   
    header("location: ../forgot-password.php?error=none");
    exit();
}
 



