<?php

/* 
A domain Class to demonstrate RESTful web services
*/
require_once("connection_.php");
Class Emploie {
  
	
	public function getEmploieClassProf(){
		$codeClasse=$_POST['codeClasse'];
		$codeProf=$_POST['codeProf'];
		//$codeClasse=74;
		//$codeProf=13;
	  	$DBConnection = new DBConnection();
    $db = $DBConnection->DBConnection();
	
  
         $req_class1 ='SELECT * FROM emploi em,emplois ems,heures h,matiere m, inscription i where ems.code_prof="'.$codeProf.'" and em.id_emploi=ems.id_emploi and ems.id=h.id and ems.code_mat=m.code_mat and em.code_cl=i.code_cl and em.code_cl="'.$codeClasse.'" group by heur';


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
          
	}


	public function getEmploieProfSemaine(){
		header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$codeProf=$request->code_user;

	      $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

		
		//$codeProf=13;
	
  
         $req_emploie2 ='SELECT em.id_emploi,em.code_cl,em.annee,ems.code_prof,h.heur,t.*,m.*,c.libelle FROM `emploi` em,emplois ems,heures h,matiere m, inscription i,temps t,classe c where ems.code_prof="'.$codeProf.'" and em.id_emploi=ems.id_emploi and ems.id=h.id and ems.code_mat=m.code_mat and t.id_temps=h.id_temps and em.code_cl=i.code_cl and em.code_cl=c.code_cl  group by heur order by h.id ';


     

 $retour = $db->prepare($req_emploie2);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}


	public function getEmploieEleveSemaine(){
		header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$codeeleve=$request->codeeleve;
//$codeeleve=55252966;

	      $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

		
		//$codeProf=13;
          $annee='2018/2019';
	
  
         $req_emploie2 ='select groupe5.heur,groupe6.temps,groupe7.abreviation,groupe8.nom,groupe8.prenom from inscription i 
         INNER JOIN (SELECT MAX(annee) as maxAnnee from inscription where code="'.$codeeleve.'" ) groupe1 ON i.annee="'.$annee.'" 
         INNER JOIN (SELECT nom,prenom,code from t_clien where code='.$codeeleve.') groupe2 ON i.code=groupe2.code
         INNER JOIN (SELECT id_emploi,dates,code_cl,annee from emploi ) groupe3 ON i.code_cl=groupe3.code_cl
         INNER JOIN (SELECT id,code_prof,code_mat,id_emploi from emplois ) groupe4 ON groupe3.id_emploi=groupe4.id_emploi
         INNER JOIN (SELECT id,heur,id_temps from heures ) groupe5 ON groupe4.id=groupe5.id 
         INNER JOIN (SELECT id_temps,temps from temps ) groupe6 ON groupe5.id_temps=groupe6.id_temps
         INNER JOIN (SELECT code_mat,abreviation from matiere ) groupe7 ON groupe4.code_mat=groupe7.code_mat 
         INNER JOIN (SELECT code_prof,nom,prenom from professeur ) groupe8 ON groupe4.code_prof=groupe8.code_prof ';


     

 $retour = $db->prepare($req_emploie2);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
	}

	public function getProgrammeClassProf(){
	header("Access-Control-Allow-Origin: *");
	header('Content-type:application/json');
	header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$codeProf=$request->code_user;
$code_cl=$request->code_cl;

/*$codeProf='155';
$code_cl='1';*/


	      $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

	
  
         $req_emploie2 ='SELECT idCP,code_cl,code_prof,annee,volumeHorairePrin as volume,volumeHoraireAvn as fait from classe_prof where code_cl="'.$code_cl.'" and code_prof="'.$codeProf.'" ';


     

 $retour = $db->prepare($req_emploie2);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
		return $result;
}
	public function setProgrammeClassProf(){
				header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$codeProf=$request->code_user;
$code_cl=$request->code_cl;
////$heureFait=$request->nbrHeurFai;
//$codeProf=$_POST['code_user'];
//$code_cl=$_POST['code_cl'];
/*$codeProf='/*348';
$code_cl='54';*/
/*$heureFait='2';*/


	      $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

	
  
         $req_emploie23 ='update  classe_prof  set volumeHoraireAvn=volumeHoraireAvn+1 where code_cl='.$code_cl.' and code_prof='.$codeProf;


     

 $retour = $db->prepare($req_emploie23);
 $retour->execute();

		return 'Done';
}
}
?>