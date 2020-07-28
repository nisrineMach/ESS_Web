<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
Class Absence  {
  

	
	public function setAbsenceClasse(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $codeClasse=$request->code_cl;
           $id_temps=$request->id_temps;
           

	
		$absents=$request->absences;
         
		$date = date('Y-m-d');
	    $code_prof=$request->code_user;
	
 
        $stmt=$db->prepare('insert into absence (dates,code,id_temps,code_cl) values("'.$date.'",:absent,:temps,:classe)');

        // $stmt->bind_param($date, $value, $id_temps,$codeClasse);  
//$stmt->bindParam(':date', $date, PDO::PARAM_INT);
$stmt->bindParam(':temps', $id_temps, PDO::PARAM_INT);
$stmt->bindParam(':classe', $codeClasse, PDO::PARAM_STR);

foreach ($absents as $absent) {
  $stmt->bindParam(':absent', $absent, PDO::PARAM_STR);
    $stmt->execute();
}

       
        $stmtT=$db->prepare('insert into absence_prof_app_mobile (code_prof,code_seance,code_cl) values(:code_prof,:tempsP,:classeP)');
        $stmtT->bindParam(':tempsP', $id_temps, PDO::PARAM_INT);
        $stmtT->bindParam(':classeP', $codeClasse, PDO::PARAM_STR);
        $stmtT->bindParam(':code_prof', $code_prof, PDO::PARAM_STR);
            $stmtT->execute();
            $result = 'Done';

 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
		return $result;
	}
	public function getAbsenceEtudiant(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
           $code=$request->code;
		//$annee=$request->anneeScolaire;
		/*$code=101;
		$annee="2018/2019";*/
	
		
  
         $req_class1 ='SELECT absence.*,temps.temps,emplois.code_prof,emplois.code_mat,emplois.id_emploi,emploi.*,matiere.abreviation FROM `absence` ,matiere, temps,emploi,emplois where matiere.code_mat=emplois.code_mat and absence.code="'.$code.'" and temps.id_temps=absence.id_temps and emploi.code_cl=absence.code_cl and emploi.id_emploi=emplois.id_emploi and absence.etatPub=1 group by absence.id';


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
		return $result;
	}
	public function getClassEtudiantAbsence(){

				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
            $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);

          $code_prof=$request->code_user;
		  $annee="2018/2019";
		 // $code_prof=348;
		
	       $req_emploie2 ='SELECT h.heur,t.* ,em.code_cl
		   FROM `emploi` em,
		   emplois ems,heures h,matiere m, inscription i,temps t,classe c 
		   where ems.code_prof="'.$code_prof.'" 
		   and em.id_emploi=ems.id_emploi 
		   and ems.id=h.id 
		   and ems.code_mat=m.code_mat
		   and t.id_temps=h.id_temps 
		   and em.code_cl=i.code_cl and em.code_cl=c.code_cl and    em.annee="'.$annee.'"  group by heur order by h.id ';


     

 $retourR = $db->prepare($req_emploie2);
 $retourR->execute();
               $req_class1 ='SELECT code_ins,i.code,nom,prenom,date_ins FROM inscription  i  
INNER JOIN ( SELECT MAX(annee) AS maxAnnee FROM inscription where code_cl=:codeClasse ) groupel ON  i.annee = "'.$annee.'" and i.code_cl=:codeClasse  
INNER JOIN ( SELECT nom,prenom,code FROM t_clien  ) groupe2 ON  i.code = groupe2.code';

          $resultT = $retourR->fetchAll(\PDO::FETCH_ASSOC);
		  date_default_timezone_set('Africa/Casablanca');
			$dateFormatA =date("l");
			
			setlocale (LC_TIME, 'fr_FR.utf8','fra');
			$heureFormat =date("H:i");
			$date = strtotime($dateFormatA);
			//echo $heureFormat;
			
			$jour=strftime("%A",$date);
			$journee;
			
			
			
if($jour=='mercredi'){
	$journee='mr';
}else{
	$journee=substr($jour,0,1);
}
$temps=array();
			foreach( $resultT as $rows){
				//echo $rows['temps'].'<br>';

				$res=preg_replace('/[^a-z]/','',$rows['heur']);
				$Dee=explode('-',$rows['temps']);
				
				if($journee==$res){
				array_push($temps,$Dee[0]);
				array_push($temps,$Dee[1]);
				$temps=array_unique($temps);
					if(current($temps)<$heureFormat && end($temps)>$heureFormat){
					$code_cl=$rows['code_cl'];	
				$retour = $db->prepare($req_class1);
				$retour->execute(array(':codeClasse'=>$code_cl));
				
				
				
			$seance=$rows['temps'];
			$idseance=$rows['id_temps'];
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
			
					}else{
						//echo 'Liste pas encore dispo heure not ok'.current($temps).'<br>';
						$seance="";
						$result =array();
						$code_cl="";
						$idseance="";
					}
				}else{
					   $seance="";
						$result =array();
						$code_cl="";
						$idseance="";
				}
				$temps=array();
			}
			//echo $queryResult;
			$queryResult=array('code_cl'=>$code_cl,'seance'=>$seance,'id_temps'=>$idseance,'etudiant'=>$result);
			return $queryResult;

 
	}

public function getAbsenceProfesseur(){
				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
         $postdata = file_get_contents("php://input");
          $request = json_decode($postdata);
           $code_prof=$request->code_user;
		   $code_cl=$request->code_cl;
		/*$code=101;
		$annee="2018/2019";*/
	
		
  
         $req_class1 ='SELECT u1.code_cl,p2.id_cycle, u1.code_prof,p2.nom,p2.prenom,group_concat(u2.code_seance) AS seance ,GROUP_CONCAT(t2.temps) as seance , group_concat(DATE_FORMAT(u1.date, "%d-%m-%Y")) as dates , week(u1.date) as semaine,group_concat(weekday(u1.date)) as day
FROM absence_prof_app_mobile u1
 JOIN absence_prof_app_mobile u2 on u1.id_Absence_Prof=u2.id_Absence_Prof  
  JOIN professeur p2 on u1.code_prof=p2.code_prof  and u1.code_prof="'.$code_prof.'"
   JOIN temps t2 on u1.code_seance=t2.id_temps 
JOIN  (SELECT count(distinct(h.id)) as nbrSeance ,ems.code_prof ,h.id,c.libelle FROM emploi em,emplois ems,heures h,matiere m, inscription i,classe c where  em.id_emploi=ems.id_emploi and ems.id=h.id and ems.code_mat=m.code_mat and em.code_cl=i.code_cl and em.code_cl=c.code_cl   and em.code_cl="'.$code_cl.'" group by ems.code_prof) empl on empl.code_prof=p2.code_prof  
   where   week(u1.date)=week(u2.date)
 group by u1.code_prof,week(u1.date)';


 $retour = $db->prepare($req_class1);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
           // echo json_encode($result);
            foreach($result  as $rows22 ){
   $resultAbsence[]=
array('code_cl'=>$rows22['code_cl'],'id_cycle'=>$rows22['id_cycle'],'semaine'=>$rows22['semaine'],'day'=>explode(',',$rows22['day']),'seance'=>explode(',',$rows22['seance']),'dates'=>explode(',',$rows22['dates']));
}

		return $resultAbsence;
	}
}
?>