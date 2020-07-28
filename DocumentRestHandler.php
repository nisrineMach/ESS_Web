<?php
require_once("SimpleRest.php");
require_once("Document_dao.php");
		
class DocumentRestHandler extends SimpleRest {

	function getDocuments() {	

		$document = new document();
		$rawData = $document->getDocument();

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
	function setRequestDocuments() {	

		$document = new document();
		$rawData = $document->setRequestDocument();

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