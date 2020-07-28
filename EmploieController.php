<?php
require_once("EmploieRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "classe":
		// to handle REST Url /prof/class/
		$emploieRestHandler = new EmploieRestHandler();
		$emploieRestHandler->getEmploieClassProfs();
		break;
		
	case "semaine":
		// to handle REST Url /prof/semaine/
		$emploieRestHandler = new EmploieRestHandler();
		$emploieRestHandler->getEmploieProfSemaines();
		break;

	case "eleve":
		// to handle REST Url /prof/semaine/
		$emploieRestHandler = new EmploieRestHandler();
		$emploieRestHandler->getEmploieEleveSemaines();
		break;

	case "programme":
		// to handle REST Url /prof/semaine/
		$emploieRestHandler = new EmploieRestHandler();
		$emploieRestHandler->getProgrammeClassProfs();
		break;

	case "setprogramme":
		// to handle REST Url /prof/semaine/
		$emploieRestHandler = new EmploieRestHandler();
		$emploieRestHandler->setProgrammeClassProfs();
		break;

	case "" :
		//404 - not found;
		break;
}
?>