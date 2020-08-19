<?php

include("database.php");

$input_id = $_GET['id'];
$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

if(is_null($_GET['id']) OR !is_numeric($_GET['id'])){
	http_response_code(400);
}else{
	http_response_code(200);
	$query = $bdd->prepare("SELECT ID, name, price, description FROM Product WHERE professionalID_ref=?");
    $query -> execute(array($input_id));
    
    $proData = array();
	while($row=$query->fetch(PDO::FETCH_ASSOC)) $proData[] = $row;

	$returnObject ->status = "success";
	$returnObject ->message = "Query returned succesfully";
	$returnObject ->data = $proData;
}

echo json_encode($returnObject);

?>