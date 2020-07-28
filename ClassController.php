<?php
require_once("ClassRestHandler.php");
		
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
		$classRestHandler = new ClassRestHandler();
		$classRestHandler->getAllEtudiants();
		break;
		
	case "notes":
		// to handle REST Url /mobile/show/<id>/
		$classRestHandler = new ClassRestHandler();
		$classRestHandler->getClassNotes();
		break;
		case "examen":
		// to handle REST Url /mobile/show/<id>/
		$classRestHandler = new ClassRestHandler();
		$classRestHandler->getClassExamens();
		break;

	case "" :
		//404 - not found;
		break;
}
?>