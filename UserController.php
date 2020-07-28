<?php
require_once("UserRestHandler.php");

$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "cn":
		// to handle REST Url /gerance/list/
		$userRestHandler = new UserRestHandler();
		$userRestHandler->getConnectedUser();
		break;
		
	case "single":
		// to handle REST Url /mobile/show/<id>/
		$userRestHandler = new UserRestHandler();
		$userRestHandler->getInfoUserConnected();
		break;

	case "chauffeur":
		// to handle REST Url /mobile/show/<id>/
		$userRestHandler = new UserRestHandler();
		$userRestHandler->getChauffeurEleves();
		break;
	case "password":
		// to handle REST Url /mobile/show/<id>/
		$userRestHandler = new UserRestHandler();
		$userRestHandler->setPasswords();
		break;

	case "" :
		//404 - not found;
		break;
}
?>