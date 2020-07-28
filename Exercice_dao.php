<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Exercice  {
  

	

	public function setExercice(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $demande_de=$request->codeUser;
           $code_cl=$request->code;
           $exercice=$request->exercice;
           $demanderle=$request->demanderle;
         
            
           
 
        $stmt=$db->prepare('insert into exercice (code_user,code_cl,exercice,date_rendu) values(:demandede,:codeclasse,:exercices,:daterendu)');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':demandede', $demande_de, PDO::PARAM_STR);
$stmt->bindParam(':codeclasse', $code_cl, PDO::PARAM_STR);
$stmt->bindParam(':exercices', $exercice, PDO::PARAM_STR);
$stmt->bindParam(':daterendu', $demanderle, PDO::PARAM_STR);



    $stmt->execute();
    $result = 'Done';
		return $result;
	}

  public function getClassExercice(){
        header("Access-Control-Allow-Origin: *");
        header('Content-type:application/json');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


        $DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
    
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
        $code=$request->code;
        $arendre=$request->pourle;
    //$annee=$request->anneeScolaire;
    //$code='55252966';
    $annee="2018/2019";
  
     //$req_class1 ='SELECT b.code_mat,m.abreviation,b.semistre,b.examen,b.dater,b.notes,b.etatAppMob FROM `buletin` b , inscription i,t_clien c,classe cl,matiere m where b.code_cl=cl.code_cl and c.code="'.$code.'" and b.code_ins=i.code_ins and b.code_mat=m.code_mat and c.code=i.code and annee="'.$annee.'" and etatAppMob="OUI"';
     
  
 $req_class1 ='SELECT exercice.*,matiere.abreviation FROM `inscription`,t_clien,exercice, professeur,matiere where t_clien.code=inscription.code and inscription.code_cl=exercice.code_cl and  t_clien.code="'.$code.'" and professeur.code_prof=exercice.code_user and matiere.code_mat=professeur.code_mat and inscription.annee="'.$annee.'" and exercice.date_rendu="'.$arendre.'"';


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
    return $result;
  }

 
  
	
}
?>