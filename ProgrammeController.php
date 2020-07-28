<?php
require_once("ProgrammeRestHandler.php");
		
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
		$programmeRestHandler = new ProgrammeRestHandler();
		$programmeRestHandler->getProgrammes();
		break;
	case "single":
		// to handle REST Url /gerance/list/
		$programmeRestHandler = new ProgrammeRestHandler();
		$programmeRestHandler->setRequestProgrammes();
		break;
		
	


	case "" :
		//404 - not found;
		break;
}
?>