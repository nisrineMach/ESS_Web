<?php
require_once("SimpleRest.php");
require_once("Emploie_dao.php");
		
class EmploieRestHandler extends SimpleRest {

	function getEmploieClassProfs() {	

		$emploie = new emploie();
		$rawData = $emploie->getEmploieClassProf();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No gerances found!');		
		} else {
			$statusCode = 201;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}
	function getEmploieProfSemaines() {	

		$emploie = new emploie();
		$rawData = $emploie->getEmploieProfSemaine();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No schedule found!');		
		} else {
			$statusCode = 201;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}

	function getEmploieEleveSemaines() {	

		$emploie = new emploie();
		$rawData = $emploie->getEmploieEleveSemaine();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No schedule found!');		
		} else {
			$statusCode = 201;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}

	function getProgrammeClassProfs() {	

		$emploie = new emploie();
		$rawData = $emploie->getProgrammeClassProf();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No program found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}

	function setProgrammeClassProfs() {	

		$emploie = new emploie();
		$rawData = $emploie->setProgrammeClassProf();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No program found!');		
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
		$jsonResponse = json_encode($responseData, JSON_UNESCAPED_UNICODE );
		return $jsonResponse;		
	}
	


	
}
?>