<?php

include("database.php");
include_once 'core.php';

$input_id = $_GET['id'];
$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

if($token = checkHeader($key, $returnObject)){
	if(is_null($_GET['id']) OR !is_numeric($_GET['id'])){
		http_response_code(400);
	}else if($token->data->id != $_GET['id'] or $token->data->accountType != "pro"){
		http_response_code(401);
		$returnObject ->status = "Unauthorized";
		$returnObject ->message = "You do not have permission to view this information";
	}else{

		$query = $bdd->prepare("SELECT * FROM Professional WHERE id=?");
	    $query -> execute(array($input_id));
	    $p = $query -> fetch();

		$returnObject ->status = "success";
		$returnObject ->message = "Query returned succesfully";
		$returnObject ->tokenData = $token;
		$returnObject ->data = new \stdClass();
		$returnObject ->data->name = $p["name"];
		$returnObject ->data->profilepic = $p["profilePicture"];
	}
}

echo json_encode($returnObject);


?>