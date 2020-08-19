<?php

include("database.php");

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$input_name = $obj['name'];
$input_email = $obj['email'];
$input_password = $obj['password'];
$input_profession = $obj['profession'];
$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

if(is_null($input_email) OR is_null($input_password) OR is_null($input_name) OR is_null($input_profession)){
    http_response_code(400);
}else if(strlen($input_password) <8){
    $returnObject ->status = "passwordTooShort";
    $returnObject ->message = "Password must be over 8 characters";
}else if(strlen($input_name) >40){
    $returnObject ->status = "nameTooLong";
    $returnObject ->message = "Name must be under 40 characters";
}else{
    $sql=$bdd->prepare("SELECT COUNT(*) FROM Professional WHERE email=?");
    $sql->execute(array($input_email));
    $sql2=$bdd->prepare("SELECT COUNT(*) FROM Professions WHERE ID=?");
    $sql2->execute(array($input_profession));
    if($sql->fetchColumn() != 0){
        $returnObject ->status = "accountExists";
        $returnObject ->message = "An account is already linked to that e-mail";
    }else if($sql2->fetchColumn() != 1){
        $returnObject ->status = "invalidProfession";
        $returnObject ->message = "You entered an invalid profession";
    }else{
        $hashed_password = password_hash($input_password, PASSWORD_DEFAULT);
        $sql=$bdd->prepare("INSERT INTO Professional (name, email, password, professionID_ref) VALUES (?,?,?,?);");
        if($success){  
            $returnObject ->status = "success";
            $returnObject ->message = "User has been registered";
        }else{
            $returnObject ->status = "failure";
            $returnObject ->message = "A failure occured";
        }
    }       
}

echo json_encode($returnObject);
?>