<?php
require_once("SimpleRest.php");
require_once("Absence_dao.php");
		
class AbsenceRestHandler extends SimpleRest {

	function setAbsenceClasses() {	

		$absence = new absence();
		$rawData = $absence->setAbsenceClasse();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = 0;		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;

		
	}
	function getAbsenceEtudiants() {	

		$absence = new absence();
		$rawData = $absence->getAbsenceEtudiant();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = 0;		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;

		
	}

	function getClassEtudiantAbsences() {	

		$absence = new absence();
		$rawData = $absence->getClassEtudiantAbsence();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = 0;		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;

		
	}

	function getAbsenceProfesseurs() {	

		$absence = new absence();
		$rawData = $absence->getAbsenceProfesseur();

		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = 0;		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;

		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData,JSON_UNESCAPED_UNICODE);
		return $jsonResponse;		
	}
	

}
?>