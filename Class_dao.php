<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Classe  {
  

	
	public function getClassEtudiant(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $codeClasse=$request->code_cl;
		$annee=$request->anneeScolaire;
		//$codeClasse=57;
		//$annee="2018/2019";
	
		
  
         $req_class1 ='SELECT code_ins,i.code,nom,prenom,code_cl,annee,date_ins FROM inscription  i  
INNER JOIN ( SELECT MAX(annee) AS maxAnnee FROM inscription where code_cl="'.$codeClasse.'" ) groupel ON  i.annee = "'.$annee.'" and i.code_cl="'.$codeClasse.'" 
INNER JOIN ( SELECT nom,prenom,code FROM t_clien  ) groupe2 ON  i.code = groupe2.code';


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
		return $result;
	}

	public function getClassNote(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
        $code=$request->code;
		$annee=$request->anneeScolaire;
		$code='55252966';
		$annee="2018/2019";
	
		 $req_class1 ='SELECT b.code_mat,m.abreviation,b.semistre,b.examen,b.dater,b.notes,b.etatAppMob FROM `buletin` b , inscription i,t_clien c,classe cl,matiere m where b.code_cl=cl.code_cl and c.code="'.$code.'" and b.code_ins=i.code_ins and b.code_mat=m.code_mat and c.code=i.code and annee="'.$annee.'" and etatAppMob="OUI"';
  
        // $req_class1 ='SELECT c.code,b.code_ins,c.nom,c.prenom,b.code_cl,cl.libelle,b.code_mat,m.abreviation,b.semistre,b.examen,b.dater,b.notes,b.etatAppMob,i.annee FROM `buletin` b , inscription i,t_clien c,classe cl,matiere m where b.code_cl=cl.code_cl and c.code="'.$code.'" and b.code_ins=i.code_ins and b.code_mat=m.code_mat and c.code=i.code and annee="'.$annee.'" and etatAppMob="OUI"';


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
		return $result;
	}


	public function getClassExamen(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
        $code_cl=$request->code_cl;
		//$annee=$request->anneeScolaire;
		//$code_cl='76';
		/*$annee="2018/2019";*/
	
		 $req_class1 ='SELECT examen.*,matiere.abreviation FROM `examen`  , matiere  where examen.code_classe="'.$code_cl.'"  and examen.code_matiere=matiere.code_mat  and  etatPub="1"';
  


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}
}
?>