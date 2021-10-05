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



function createUser($conn, $firstName, $lastName, $email, $password, $status, $vkey, $verify){
    
    $sql = "INSERT INTO users (first_name, last_name, email, password, status, vkey, verify) VALUES (?, ?, ?, ?, ?, ?, ?);";    
    $stmt = mysqli_stmt_init($conn); //initialize a prepared statment, prevents code injection
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailedinsert");
        exit();
    }
    
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $email, $hashedPwd, $status, $vkey, $verify); //1 s for 1 string being passed
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
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

   if($uidExists['status'] === 'approved'){   
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
            $_SESSION["verify"] = $uidExists["verify"];
            
            
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
    else{        
        header("location: ../login.php?error=usernotapproved");
        exit();        
    }
}



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
 



