<?php
require_once("MessageRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "send":
		// to handle REST Url /gerance/list/
		$messageRestHandler = new MessageRestHandler();
		$messageRestHandler->setSendMessages();
		break;
		
	case "matiere":
		// to handle REST Url /mobile/show/<id>/
	// to handle REST Url /gerance/list/
		$messageRestHandler = new MessageRestHandler();
		$messageRestHandler->getTouteMatieres();
		break;

	case "message":
		// to handle REST Url /mobile/show/<id>/
	// to handle REST Url /gerance/list/
		$messageRestHandler = new MessageRestHandler();
		$messageRestHandler->getMesMessages();
		break;
		case "messagepub":
		// to handle REST Url /mobile/show/<id>/
	// to handle REST Url /gerance/list/
		$messageRestHandler = new MessageRestHandler();
		$messageRestHandler->setSendMessagesPublic();
		break;
	case "suggestion":
		$messageRestHandler = new MessageRestHandler();
		$messageRestHandler->setSuggestions();
		break;

	case "" :
		//404 - not found;
		break;
}
?>