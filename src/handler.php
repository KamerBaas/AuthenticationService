<?php
date_default_timezone_set("Europe/Amsterdam");
require_once 'vendor/autoload.php';
header('Content-Type: application/json');
#echo json_encode($_REQUEST);

// echo '<pre>'; var_dump($_REQUEST); echo '</pre>';

// #echo '<pre>'; var_dump(file_get_contents('php://input')); echo '<pre>';

$data = json_decode(file_get_contents('php://input'));
//$jsonobjectje = json_decode($_POST);

//var_dump($data);

//print_r( json_encode($jsonobjectje));

// Get $id_token via HTTPS POST.
if(!is_null($data)) {
	$CLIENT_ID = "818816058543-u44dr7g6nvcum89npch966mhp5oi29q6.apps.googleusercontent.com";
	$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend

	// Configures the time that the token can be used (nbf claim)

	try{
		$payload = $client->verifyIdToken($data->idtoken);
		if ($payload) {
		  $userid = $payload['sub'];
		  // If request specified a G Suite domain:
		  $domain = $payload['hd'];
		  echo json_encode($payload);
		} else {
		  // Invalid ID token
			echo json_encode(['msg' => 'Error: Invalid token']);
		}
	} catch(UnexpectedValueException $e){
		echo json_encode(['msg' => 'Error: Given token syntax is invalid']);
	}
} else {
	echo json_encode(['msg' => 'Error: Json body was null']);
}

?>