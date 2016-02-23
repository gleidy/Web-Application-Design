<?php
session_start ();

require_once "../Slim/Slim.php";
Slim\Slim::registerAutoloader();
$app = new \Slim\Slim(); // slim run-time object
require_once "conf/config.inc.php"; // include configuration file

if (empty ( $_SESSION ["localUserList"] ))
	$_SESSION ["localUserList"] = array (); // initialitation of users container

$app->map ( "/users(/:id)", function ($elementID = null) use($app) {
	$body = $app->request->getBody (); // get the body of the HTTP request (from client)
	$decBody = json_decode ( $body, true ); // this transform the string into an associative array
	$httpMethod = $app->request->getMethod ();
	
	// initialisations
	$responseBody = null;
	$responseCode = null;
	
	switch ($httpMethod) {
		case "GET" :
			// set response body and response code
			if($elementID != null)
				$responseBody = $_SESSION ["localUserList"][$elementID];
			else 
				$responseBody = $_SESSION["localUserList"];
				
			$respondeCode = HTTPSTATUS_OK;
			
			break;
		case "POST" :
			
			if($decBody["name"] != NULL){
				$newAlhanumericalID = "i" . rand(0,100);
				$_SESSION ["localUserList"][$newAlhanumericalID] = $decBody["name"];
			
				$responseBody = $_SESSION ["localUserList"][$newAlhanumericalID];
				$respondeCode = HTTPSTATUS_CREATED;
				}
				else
					$respondeCode = HTTPSTATUS_BADREQUEST;
				
			break;
		case "PUT" :
			if($elementID != NULL){
				$_SESSION ["localUserList"][$elementID] = $decBody["name"];
				$responseBody = $_SESSION ["localUserList"][$elementID];
				$respondeCode = HTTPSTATUS_OK;
			}
			else $respondeCode = HTTPSTATUS_BADREQUEST;
			break;
		case "DELETE" :
			if($elementID != null){
				//unset($_SESSION ["localUserList"][$elementID]);
				$_SESSION ["localUserList"][$elementID] = NULL;
				$responseBody = $_SESSION ["localUserList"][$elementID];
				$respondeCode = HTTPSTATUS_OK;
			}
			else $respondeCode = HTTPSTATUS_BADREQUEST;
			
			break;
	}
	
	// return response to client (as a json string)
	if ($responseBody != null)
		$app->response->write ( json_encode ( $responseBody ) ); // this is the body of the response
			                                                         
	// TODO:we need to write also the response codes in the headers to send back to the client
	$app->response->status ( $respondeCode );
} )->via ( "GET", "POST", "PUT", "DELETE" );

$app->run ();
?>