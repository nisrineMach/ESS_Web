<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Message  {
  

	
	public function setSendMessage(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $code_user=$request->email;
           //$code_user="abderazak.daray@essp.com";
           $messageT=$request->message_text;
           //$messageT="besoin de savoir les note de mon enfant";
            
           
 
        $stmt=$db->prepare('insert into message_app_mobile (Message_du,Message_Text,Message_a) values(:code_user,:messageT,"les.ecoles.scientifiques@es.com")');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':code_user', $code_user, PDO::PARAM_STR);
$stmt->bindParam(':messageT', $messageT, PDO::PARAM_STR);


    $stmt->execute();
    $result = 'Done';
		return $result;
	}

		public function setSendMessagePublic(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $telephone=$request->telephone;
            $email=$request->email;
           $text_message=$request->message_text;
           //$messageT="besoin de savoir les note de mon enfant";
           
 
        $stmt=$db->prepare('insert into message_public_mobile (telephone,email,text_message) values(:telephone,:email,:text_message)');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':text_message', $text_message, PDO::PARAM_STR);



    $stmt->execute();
    $result = 'Done';
		return $result;
	}

		public function getTouteMatiere(){
		header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
//$codeProf=$request->code_user;

	      $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

		
		$codeProf=13;
	
  
         $req_emploie2 ='SELECT code_mat,abreviation FROM matiere  ';


     

 $retour = $db->prepare($req_emploie2);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}


		public function getMesMessage(){
		header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
//$email=$request->email;
$email="abderazak.daray@essp.com";

	      $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

        $class=['64','37'];
        $requete=' classe='.$class[0];
      
        if(count($class)>1){
        for($i=1;$i<count($class);$i++){
                $requete.= ' or classe = '.$class[$i];
               
        }	
}else{

}

	
  
         $req_emploie2 ='select idMessage,Message_du,Message_date,Message_Text,Message_a,cycle,classe,concat("localhost/ESS_V1/mobile_app/uploads/",image_message) as image_message,etatPub from  message_app_mobile where Message_du="'.$email.'" or Message_a="'.$email.'"  or '.$requete.' order by Message_Text limit 10';


     

 $retour = $db->prepare($req_emploie2);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
			print_r( $result);
		return $result;
	}

		public function setSuggestion(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
          $code_user=$request->email;
          // $code_user="abderazak.daray@essp.com";
           $messageT=$request->suggestion_text;
          //$messageT="besoin de savoir les note de mon enfant";
            
           
 
        $stmt=$db->prepare('insert into suggestion_app_mobile (email_user,suggestion) values(:code_user,:messageT)');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':code_user', $code_user, PDO::PARAM_STR);
$stmt->bindParam(':messageT', $messageT, PDO::PARAM_STR);


    $stmt->execute();
    $result = 'Done';
		return $result;
	}
}
?>