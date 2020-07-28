<?php
require_once("EmailNotificationRestHandler.php");
		
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
		$emailNotificationRestHandler = new EmailNotificationRestHandler();
		$emailNotificationRestHandler->setSendEmails();
		break;
		
	case "transport":
		// to handle REST Url /mobile/show/<id>/
		$emailNotificationRestHandler = new EmailNotificationRestHandler();
		$emailNotificationRestHandler->setSendEmailTransports();
		break;

	case "cantine":
		$emailNotificationRestHandler = new EmailNotificationRestHandler();
		$emailNotificationRestHandler->setSendEmailCantines();
		break;

	case "preinscription":
		$emailNotificationRestHandler = new EmailNotificationRestHandler();
		$emailNotificationRestHandler->setSendEmailPreinscriptions();
		break;
		
		

	case "" :
		//404 - not found;
		break;
}
?>