<?php
include_once 'core.php';
require __DIR__ . '/../vendor/autoload.php';
use \Firebase\JWT\JWT;

$data = json_decode(file_get_contents("php://input"));
$jwt=isset($data->jwt) ? $data->jwt : "";
echo validate_token($jwt, $key);

?>