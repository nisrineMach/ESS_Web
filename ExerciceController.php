<?php
require_once("ExerciceRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "insert":
		// to handle REST Url /gerance/list/
		$exerciceRestHandler = new ExerciceRestHandler();
		$exerciceRestHandler->setExercices();
		break;
	case "exercice":
		// to handle REST Url /mobile/show/<id>/
		$exerciceRestHandler = new ExerciceRestHandler();
		$exerciceRestHandler->getClassExercices();
		break;

	case "" :
		//404 - not found;
		break;

}

?>