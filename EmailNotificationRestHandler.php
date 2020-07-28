<?php
require_once("SimpleRest.php");
require_once("EmailNotification_dao.php");
		
class EmailNotificationRestHandler extends SimpleRest {

	function setSendEmails() {	

		$emailnotification = new emailnotification();
		$rawData = $emailnotification->setSendEmail();

		if(empty($rawData)) {
			$statusCode = 200;
			$rawData = array('error' => 'No email send found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}
	function setSendEmailTransports() {	

		$emailnotification = new emailnotification();
		$rawData = $emailnotification->setSendEmailTransport();

		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = array('error' => 'No email send!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}
	
		function setSendEmailCantines() {	

		$emailnotification = new emailnotification();
		$rawData = $emailnotification->setSendEmailCantine();

		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = array('error' => 'No email send!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}
	function setSendEmailPreinscriptions() {	

		$emailnotification = new emailnotification();
		$rawData = $emailnotification->setSendEmailPreinscription();

		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = array('error' => 'No email send!');		
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