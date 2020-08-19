<?php

include("database.php");
include_once 'core.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$id = $obj['id'];
$url = $obj['url'];
$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

if($token = checkHeader($key, $returnObject)){
	if(is_null($id) OR is_null($url)){
	    http_response_code(400);
	}else if($token->data->id != $id or $token->data->accountType != "pro"){
		http_response_code(401);
		$returnObject ->status = "Unauthorized";
		$returnObject ->message = "You do not have permission to perform this action";
	}else if(strlen($url) > 255 OR (filter_var($url, FILTER_VALIDATE_URL) === false)){
	    $returnObject ->status = "wrongInput";
	    $returnObject ->message = "A supplied input is erroneous";
	}else{
	    $sql=$bdd->prepare("UPDATE Professional SET profilePicture = ? WHERE ID = ?;");
	    $success = $sql->execute(array($url, $id)); 
	    if($success){  
		    $returnObject ->status = "success";
		    $returnObject ->message = "Profile Picture modified";
		}else{
			$returnObject ->status = "failure";
		    $returnObject ->message = "A failure occured";
		}
	}
}

echo json_encode($returnObject);

?>