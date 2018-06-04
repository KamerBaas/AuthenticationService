<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
//header('Access-Control-Allow-Origin: http://192.168.99.100:8080');
header('Access-Control-Allow-Methods: POST');
//header("Access-Control-Allow-Headers: X-Requested-With");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

date_default_timezone_set("Europe/Amsterdam");
require_once 'vendor/autoload.php';
#echo json_encode($_REQUEST);

//Setting up Firebase for PHP
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


#var_dump(file_exists(__DIR__.'/firebase_credentials.json'));die;
//$serviceAccount = Firebase::fromServiceAccount(__DIR__.'/firebase_credentials.json');
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/kamerbaas-nots-firebase.json');
// echo '<pre>'; var_dump($serviceAccount); echo '</pre>';
// die;
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

// echo '<pre>'; var_dump($_REQUEST); echo '</pre>';

// #echo '<pre>'; var_dump(file_get_contents('php://input')); echo '<pre>';
//die;
$data = json_decode(file_get_contents('php://input'));

//$jsonobjectje = json_decode($_POST);

//print_r( json_encode($jsonobjectje));
//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

// Get $id_token via HTTPS POST.
if(!is_null($data)) {
	//$CLIENT_ID = "818816058543-u44dr7g6nvcum89npch966mhp5oi29q6.apps.googleusercontent.com";
	//$client = new Google_Client(['client_id' => $CLIENT_ID]);  // Specify the CLIENT_ID of the app that accesses the backend
	// Configures the time that the token can be used (nbf claim)
	//echo json_encode($data);
	//var_dump($data);
	try{
		$payload = $firebase->getAuth()->verifyIdToken($data);
		//$payload = $client->verifyIdToken($data->idtoken);
		//response()->json(['success'=>true]); 
		// echo json_encode($payload);
		//echo $payload;
		if ($payload) {
		  //$userid = $payload['sub'];
		  // If request specified a G Suite domain:
		  //$domain = $payload['hd'];
		  //echo json_encode($payload);
		  
		  	$uid = $payload->getClaim('sub');
			$user = $firebase->getAuth()->getUser($uid);
			http_response_code(200);
		  	echo json_encode($user);
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