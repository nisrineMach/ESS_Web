<?php
require_once("SimpleRest.php");
require_once("Programme_dao.php");
		
class ProgrammeRestHandler extends SimpleRest {

	function getProgrammes() {	

		$programme = new programme();
		$rawData = $programme->getProgramme();

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
	function setRequestProgrammes() {	

		$Programme = new programme();
		$rawData = $programme->setRequestProgramme();

		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = array('error' => 'No message found!');		
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