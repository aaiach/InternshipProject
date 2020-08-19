<?php
require __DIR__ . '/../vendor/autoload.php';
use \Firebase\JWT\JWT;

date_default_timezone_set('Europe/Paris');
// variables used for jwt
$key = "example_key";
$iss = "http://example.org";
$aud = "http://example.com";
$iat = 1356999524;
$nbf = 1357000000;

function validate_token($jwt, $key){
	if($jwt){
	    try {
	        $decoded = JWT::decode($jwt, $key, array('HS256'));
	        http_response_code(200);

	        return json_encode(array(
	            "isValid" => "true",
	            "data" => $decoded->data
	        ));
	 
	    }catch (Exception $e){
		 
		    http_response_code(401);
		    return json_encode(array(
		        "isValid" => "false",
		        "error" => $e->getMessage()
		    ));
		}
	}else{
		return json_encode(array(
		        "isValid" => "undefined",
		    ));
	} 
}

function checkHeader($key, $returnObject){
	if (null !== apache_request_headers()["Authorization"]) {
		list($type, $data) = explode(" ", apache_request_headers()["Authorization"], 2);
		if (strcasecmp($type, "Bearer") == 0) {
			$decode = json_decode(validate_token($data, $key));
			if($decode->isValid == "true"){
				return $decode;
			}else {
				http_response_code(401);
				$returnObject ->status = "Unauthorized";
				$returnObject ->message = "Invalid Token";
				return false;
			}
		} else {
			http_response_code(401);
			$returnObject ->status = "Unauthorized";
			$returnObject ->message = "Authorization is not Bearer";
			return false;
		}
	} else {
		http_response_code(401);
		$returnObject ->status = "Unauthorized";
		$returnObject ->message = "No Authorization Token Found in Header";
		return false;
	}
}

?>