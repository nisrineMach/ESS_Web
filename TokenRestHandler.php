<?php
require_once("SimpleRest.php");
require_once("Token_dao.php");
		
class TokenRestHandler extends SimpleRest {



	function setCompteTokens() {	

		$token = new token();
		$rawData = $token->setCompteToken();

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