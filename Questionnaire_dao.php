<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Message  {
  

	


		public function setResponse(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $idquestion=$request->idquestion;
            $idreponse=$request->idreponse;
           $email=$request->email;
           //$messageT="besoin de savoir les note de mon enfant";
           
 
        $stmt=$db->prepare('insert into reponse_Questionnaire (idquestion,idreponse,email,dateReponse) values(:idquestion,:idreponse,:email,Now())');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':idquestion', $telephone, PDO::PARAM_STR);
$stmt->bindParam(':idreponse', $email, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);



    $stmt->execute();
    $result = 'Done';
		return $result;
	}




		public function getQuestionnaire(){
		header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$email=$request->email;
//$email="abderazak.daray@essp.com";

	      $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

		
		
	
  
         $req_emploie2 ='select * from  message_app_mobile where Message_du="'.$email.'" or Message_a="'.$email.'"  order by Message_Text limit 10';


     

 $retour = $db->prepare($req_emploie2);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

		
}
?>