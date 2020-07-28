<?php
require_once("SimpleRest.php");
require_once("Message_dao.php");
		
class MessageRestHandler extends SimpleRest {

	function setSendMessages() {	

		$message = new message();
		$rawData = $message->setSendMessage();

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

		function setSendMessagesPublic() {	

		$message = new message();
		$rawData = $message->setSendMessagePublic();

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
	function getTouteMatieres() {	

		$message = new message();
		$rawData = $message->getTouteMatiere();

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

	function getMesMessages() {	

		$message = new message();
		$rawData = $message->getMesMessage();

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
	function setSuggestions() {	

		$message = new message();
		$rawData = $message->setSuggestion();

		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = array('error' => 'No suggestion found!');		
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