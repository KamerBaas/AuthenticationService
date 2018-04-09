<?php
date_default_timezone_set("Europe/Amsterdam");
require_once 'vendor/autoload.php';

$data = json_decode(file_get_contents('php://input'), true);

// Get $id_token via HTTPS POST.
if(!is_null($data)) {
	$CLIENT_ID = "174042023883-m4tocm3ccalf5vjgu9i7j96vduug32bo.apps.googleusercontent.com";
	$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend

	// Configures the time that the token can be used (nbf claim)

	try{
		$payload = $client->verifyIdToken($data['idtoken']);
		if ($payload) {
		  $userid = $payload['sub'];
		  // If request specified a G Suite domain:
		  //$domain = $payload['hd'];
		  echo '<pre>';var_dump($payload);echo '</pre>';
		} else {
		  // Invalid ID token
			echo 'Error: Invalid token';
		}
	} catch(UnexpectedValueException $e){
		echo 'Error: Given token syntax is invalid';
	}
} else {
	echo 'Error: Json body was null';
}

?>