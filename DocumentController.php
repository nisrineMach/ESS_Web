<?php
require_once("DocumentRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":
		// to handle REST Url /gerance/list/
		$documentRestHandler = new DocumentRestHandler();
		$documentRestHandler->getDocuments();
		break;
	case "single":
		// to handle REST Url /gerance/list/
		$documentRestHandler = new DocumentRestHandler();
		$documentRestHandler->setRequestDocuments();
		break;
		
	


	case "" :
		//404 - not found;
		break;
}
?>