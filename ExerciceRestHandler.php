<?php
require_once("SimpleRest.php");
require_once("Exercice_dao.php");
		
class ExerciceRestHandler extends SimpleRest {

	function setExercices() {	

		$exercice = new Exercice();
		$rawData = $exercice->setExercice();

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



	function getClassExercices() {	

		$exercice = new exercice();
		$rawData = $exercice->getClassExercice();

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