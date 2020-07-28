<?php
require_once("AbsenceRestHandler.php");
		
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
		$absenceRestHandler = new AbsenceRestHandler();
		$absenceRestHandler->setAbsenceClasses();
		break;
		
	case "single":
		// to handle REST Url /mobile/show/<id>/
		$absenceRestHandler = new AbsenceRestHandler();
		$absenceRestHandler->getAbsenceEtudiants();
		break;
	case "getAbsence":
		// to handle REST Url /mobile/show/<id>/
		$absenceRestHandler = new AbsenceRestHandler();
		$absenceRestHandler->getClassEtudiantAbsences();
		break;
	case "getAbsenceProf":
		// to handle REST Url /mobile/show/<id>/
		$absenceRestHandler = new AbsenceRestHandler();
		$absenceRestHandler->getAbsenceProfesseurs();
		break;


	case "" :
		//404 - not found;
		break;
}
?>