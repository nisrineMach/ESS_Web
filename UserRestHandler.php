<?php
require_once("SimpleRest.php");
require_once("User_dao.php");

class UserRestHandler extends SimpleRest {

	function getChauffeurEleves() {	

		$user = new user();
		$rawData = $user->getChauffeurEleve();

		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = array('error' => 'No user  found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
		
	}
	
function getConnectedUser() {	

		$user = new user();
		$rawData = $user->authentification();
//echo $rawData;
		if(empty($rawData)) {
			$statusCode = 201;
			$rawData = array('error' => 'No gerances found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

        if($rawData['typeCompt']=='2'){
			$arrayClass=explode(',',$rawData['classe']);
			$arrayClassId=explode(',',$rawData['classId']);

			$countId=count($arrayClassId);
			//array_delete_value($rawData,"classe")
			unset($rawData['classe']);

			unset($rawData['classId']);

		
			$arrayClass_Id=array();
			for($i=0;$i<$countId;$i++){
				$arrayClass_Id[$i]=array($arrayClassId[$i],$arrayClass[$i]);
                }
			array_push($rawData,'IdsClasses');
			$rawData=array_flip($rawData);
			$rawData['IdsClasses']='IdsClasses';
			$rawData=array_flip($rawData);
			$rawData['IdsClasses']=$arrayClass_Id;
		}elseif($rawData['typeCompt']=='1'){

			$arrayCodeIns=explode(',',$rawData['code_ins']);
			$arrayCode=explode(',',$rawData['code']);
			$arrayCodeCl=explode(',',$rawData['code_cl']);
			$arrayNom=explode(',',$rawData['nomf']);
			$arrayPrenom=explode(',',$rawData['prenomf']);
			$arrayDateIns=explode(',',$rawData['date_ins']);

			$countId=count($arrayCodeIns);
			//array_delete_value($rawData,"classe")
			unset($rawData['code_ins']);
			unset($rawData['code']);
			unset($rawData['code_cl']);
			unset($rawData['nomf']);
			unset($rawData['prenomf']);
			unset($rawData['date_ins']);

		
			$arrayCodeEnfant=array();
			for($i=0;$i<$countId;$i++){
				$arrayEnfant_Id[$i]=array('nom'=>$arrayNom[$i],'prenom'=>$arrayPrenom[$i],'code'=>$arrayCode[$i],'code_ins'=>$arrayCodeIns[$i],'code_cl'=>$arrayCodeCl[$i],'date_ins'=>$arrayDateIns[$i]);
                }
			array_push($rawData,'IdsEnfants');
			$rawData=array_flip($rawData);
			$rawData['IdsEnfants']='IdsEnfants';
			$rawData=array_flip($rawData);
			$rawData['IdsEnfants']=$arrayEnfant_Id;

		}elseif($rawData['typeCompt']=='0'){
			$rawData='0';
		}
			$responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			print_r($responses);
		    // echo $response;
		
	}
		function setPasswords() {	

		$user = new user();
		$rawData = $user->setPassword();
//print_r($rawData);
		if($rawData) {
				$statusCode = 200;
			    $rawData ='Done';	
		} else {

			$statusCode = 201;
			$rawData = array('error' => 'No password  found!');	
		
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
        $responses=array("code_erreur" => $statusCode,"msg_error" => "succes","messages" =>$rawData);
			$response = $this->encodeJson($responses);
			echo $response;
			//print_r($response);
		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	


}
?>