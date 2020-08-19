<?php

include("database.php");
include_once 'core.php';

$json = file_get_contents('php://input');
$obj = json_decode($json,true);

$id = $obj['id'];
$name = $obj['name'];
$price = $obj['price'];
$description = $obj['description'];
$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

if($token = checkHeader($key, $returnObject)){
	if(is_null($price) OR is_null($name) OR is_null($id) OR is_null($description)){
	    http_response_code(400);
	}else if($token->data->id != $id or $token->data->accountType != "pro"){
		http_response_code(401);
		$returnObject ->status = "Unauthorized";
		$returnObject ->message = "You do not have permission to perform this action";
	}else if(strlen($name) > 40 OR strlen($description) > 100 OR !is_numeric($price)){
	    $returnObject ->status = "wrongInput";
	    $returnObject ->message = "A supplied input is erroneous";
	}else{
	    $sql=$bdd->prepare("INSERT INTO Product(name, price, description, professionalID_ref) VALUES (?,?,?,?);");
	    $success = $sql->execute(array($name, $price, $description, $id)); 
	    if($success){  
		    $returnObject ->status = "success";
		    $returnObject ->message = "Product added";
		}else{
			$returnObject ->status = "failure";
		    $returnObject ->message = "A failure occured";
		}
	}
}

echo json_encode($returnObject);

?>