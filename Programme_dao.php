<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Programme  {
  

	
	
	public function getProgramme(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
         
	
		
  
         $req_class1 ='SELECT * from planing';


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
	}

	public function setRequestProgramme(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $codeProf=$request->code_user;
           $code_cl=$request->code_cl;
           /*$demande_de='email';
           $code_eleve='code';
           $attestation='attestaionLibelle';
           $commentaire='commentaire';*/
            
           
 
        $stmt=$db->prepare('insert into suivi_mod (demande_de,code_eleve,attestation,commentaire) values(:demandede,:codeeleve,:attestationn,:commentairee)');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':demandede', $codeProf, PDO::PARAM_STR);
$stmt->bindParam(':codeeleve', $code_cl, PDO::PARAM_STR);


    $stmt->execute();
    $result = 'Done';
		return $result;
	}
	
}
?>