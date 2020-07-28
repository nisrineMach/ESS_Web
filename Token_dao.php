<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Token  {
  

	
	


		public function setCompteToken(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
          $code_user=$request->email;
          // $code_user="abderazak.daray@essp.com";
           $device_token=$request->device_token;
          //$messageT="besoin de savoir les note de mon enfant";
           // $device_token='54gd25566251sd5f15df4';
           // $code_user='benbihi.nourddine@essp.com';
           
 
        $stmt=$db->prepare('update compte_application_mobile set device_token=:device_token where email=:code_user');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':code_user', $code_user, PDO::PARAM_STR);
$stmt->bindParam(':device_token', $device_token, PDO::PARAM_STR);


    $stmt->execute();
    $result = 'Done';
		return $result;
	}
}
?>