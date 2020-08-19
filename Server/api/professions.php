<?php

include("database.php");
include_once 'core.php';

$returnObject = new \stdClass();
$returnObject ->status = "badRequest";
$returnObject ->message = "Bad request";

$query = $bdd->prepare("SELECT * FROM Professions");
$query -> execute();
$proData = array();
while($row=$query->fetch(PDO::FETCH_ASSOC)) $proData[] = $row;

$returnObject ->status = "success";
$returnObject ->message = "Query returned succesfully";
$returnObject ->data = $proData;

echo json_encode($returnObject);

?>