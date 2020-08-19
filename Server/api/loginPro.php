<?php

include("database.php");
include_once 'core.php';
require __DIR__ . '/../vendor/autoload.php';
use \Firebase\JWT\JWT;

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$input_email = $obj['email'];
$input_password = $obj['password'];
$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

if(is_null($input_email) OR is_null($input_password)){
	http_response_code(400);
}else{
	http_response_code(200);
	$count=$bdd->prepare("SELECT COUNT(*) FROM Professional WHERE email=?");
	$count->execute(array($input_email));
	  
	if($count->fetchColumn() == 1){

	    $hashed_query = $bdd->prepare("SELECT * FROM Professional WHERE email=?");
	    $hashed_query -> execute(array($input_email));

	    $p = $hashed_query -> fetch();
	    $id = $p['ID']; 
	    
	    if(password_verify($input_password, $p['password'])){

	    	$token = array(
		       "iss" => $iss,
		       "aud" => $aud,
		       "iat" => $iat,
		       "nbf" => $nbf,
		       "data" => array(
		           "id" => $id,
		           "accountType" => "pro"
		       )
		    );

		    $jwt = JWT::encode($token, $key);

	    	$returnObject ->status = "success";
			$returnObject ->message = "Login was Succesful";
			$returnObject ->jwt = $jwt;
			$returnObject ->id = $id;

	    } 
	    else{
	    	$returnObject ->status = "wrongPassword";
			$returnObject ->message = "Invalid Password";
	 	}

	}else{
	 	$returnObject ->status = "noAccount";
		$returnObject ->message = "No account is linked to that e-mail";
	}    
}
echo json_encode($returnObject);

?>