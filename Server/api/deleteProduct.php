<?php

include("database.php");
include_once 'core.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$id = $obj['id'];
$productID = $obj['productID'];
$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

if($token = checkHeader($key, $returnObject)){
	if(is_null($id) OR is_null($productID)){
	    http_response_code(400);
	}else if($token->data->id != $id or $token->data->accountType != "pro"){
		http_response_code(401);
		$returnObject ->status = "Unauthorized";
		$returnObject ->message = "You do not have permission to view this information";
	}else if(!is_numeric($productID)){
	    $returnObject ->status = "wrongInput";
	    $returnObject ->message = "A supplied input is erroneous";
	}else{
	    $sql=$bdd->prepare("DELETE FROM Product WHERE ID = ?;");
	    $success = $sql->execute(array($productID)); 
	    if($success){  
		    $returnObject ->status = "success";
		    $returnObject ->message = "Product deleted";
		}else{
			$returnObject ->status = "failure";
		    $returnObject ->message = "A failure occured";
		}
	}
}

echo json_encode($returnObject);

?>