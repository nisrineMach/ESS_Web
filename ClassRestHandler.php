<?php
require_once("SimpleRest.php");
require_once("Class_dao.php");
		
class ClassRestHandler extends SimpleRest {

	function getAllEtudiants() {	

		$classe = new classe();
		$rawData = $classe->getClassEtudiant();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No student found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;

		
	}

	function getClassNotes() {	

		$note = new classe();
		$rawData = $note->getClassNote();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No note found!');		
		} else {
			$statusCode = 200;
		}


		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		$responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);

			$response = $this->encodeJson($responses);
			
			echo $response;

		
	}
	function getClassExamens() {	

		$note = new classe();
		$rawData = $note->getClassExamen();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No note found!');		
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