<?php
require_once("TokenRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "update":
		// to handle REST Url /gerance/list/
		$tokenRestHandler = new TokenRestHandler();
		$tokenRestHandler->setCompteTokens();
		break;
		

	case "" :
		//404 - not found;
		break;
}
?>