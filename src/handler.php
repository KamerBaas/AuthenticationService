<?php
date_default_timezone_set("Europe/Amsterdam");
require_once 'vendor/autoload.php';

// Get $id_token via HTTPS POST.
if(sizeof($_POST) > 0) {
	$CLIENT_ID = "174042023883-m4tocm3ccalf5vjgu9i7j96vduug32bo.apps.googleusercontent.com";
	$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend

	// Configures the time that the token can be used (nbf claim)

	$payload = $client->verifyIdToken($_POST['idtoken']);
	if ($payload) {
	  $userid = $payload['sub'];
	  // If request specified a G Suite domain:
	  //$domain = $payload['hd'];
	  echo '<pre>';var_dump($payload);echo '</pre>';
	} else {
	  // Invalid ID token
		echo 'Invalid token';
	}
}

?>