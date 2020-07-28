<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Document  {
  

	
	
	public function getDocument(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
         
	
		// probleme authentifiacation cette requete qui return les attestation 
  
         /* $req_class1 ='SELECT * from attestation';


            $retour = $db->prepare($req_class1);
            $retour->execute();
              
                $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
                return $result; */
            }

	public function setRequestDocument(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $demande_de=$request->email;
           $code_eleve=$request->code;
           $attestation=$request->attestationLibelle;
           $commentaire=$request->commentaire;
           /*$demande_de='email';
           $code_eleve='code';
           $attestation='attestaionLibelle';
           $commentaire='commentaire';*/
            
           
 
        $stmt=$db->prepare('insert into demandeAttestation (demande_de,code_eleve,attestation,commentaire) values(:demandede,:codeeleve,:attestationn,:commentairee)');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':demandede', $demande_de, PDO::PARAM_STR);
$stmt->bindParam(':codeeleve', $code_eleve, PDO::PARAM_STR);
$stmt->bindParam(':attestationn', $attestation, PDO::PARAM_STR);
$stmt->bindParam(':commentairee', $commentaire, PDO::PARAM_STR);


    $stmt->execute();
   // $result = 'Done';
		return $result;
	}
	
}
?>