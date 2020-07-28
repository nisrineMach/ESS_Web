<?php
/* 
A domain Class to demonstrate RESTful web services
*/

require_once("connection_.php");
Class User {
	
		
  	public function authentification(){
header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

//print('OK');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
//print_r($request);
//$login=$request->pseudo;
//$password=md5($request->password);
$login="abderazak.daray@essp.com";
/*$login="aasimi.hafyan@es.com";*/
$password=md5("123456789");
                        
  	$DBConnection = new DBConnection();
    $db = $DBConnection->DBConnection();
   
           $reqAuth='select *,count(email) as compte  from users.compte_application_mobile where lower(email)=lower("'.$login.'") and password="'.$password.'"';
      
            $retour = $db->prepare($reqAuth);
             $retour->execute();
            $data=$retour->fetch();
            if($data['compte']==0){
$resulTF=array( "email"=>"0","typeComp"=>"0");
            }else{
                      if($data['type']=='1'){
          $req_user1 ='select compte.email,
compte.type as typeCompt,
type_compte_application.libelle as libelleCompt,
compte.code_user,
group_concat(inscription.code_ins)as code_ins,
group_concat(inscription.code) as code 
,group_concat(inscription.code_cl) as code_cl,
inscription.annee as annee,
group_concat(inscription.date_ins) as date_ins,
t_clien.tel_p , group_concat(t_clien.nom) as nomf,
group_concat(t_clien.prenom) as prenomf,
information.nomp as nom 
FROM 
type_compte_application,
compte_application_mobile compte ,
information,inscription,t_clien where information.id=compte.code_user  and t_clien.code=inscription.code  and compte.type=type_compte_application.id  
 and inscription.annee=(select max(annee) from inscription)
and replace(t_clien.tel_p," ","")=replace((SELECT t_clien.tel_p FROM compte_application_mobile compte,information,inscription,t_clien where information.id=compte.code_user  and t_clien.code=inscription.code and t_clien.code=inscription.code and information.code_ins=inscription.code_ins and compte.code_user="'.$data['code_user'].'" and compte.type=1)," ","")
and compte.code_user="'.$data['code_user'].'" and compte.type="1"';

         /* $retour = $db->prepare($req_user1);
          $retour->execute();
          $result = $retour->fetch(\PDO::FETCH_ASSOC);	*/
                      }else if($data['type']=='2'){
	      $req_user1 ='SELECT compte.email,compte.type as typeCompt,typeCompte.libelle   as libelleCompt,p.nom,p.prenom,p.tel,p.type as typeProf , GROUP_CONCAT(distinct(c.libelle))  as classe,m.libelle as matiere,cy.cycle as cycle, GROUP_CONCAT(distinct(em.code_cl)) as classId,compte.code_user FROM classe c, `emploi` em,emplois ems,heures h,matiere m, inscription i,temps t,professeur p,compte_application_mobile compte,type_compte_application typecompte,cycle cy  where compte.type=typeCompte.id and compte.code_user=ems.code_prof and ems.code_prof=p.code_prof and ems.code_prof="'.$data['code_user'].'" and em.id_emploi=ems.id_emploi and ems.id=h.id and ems.code_mat=m.code_mat and t.id_temps=h.id_temps and em.code_cl=i.code_cl and em.code_cl=c.code_cl and cy.id_cycle=c.id_cycle and compte.type="2" group by compte.email  order by h.id';
	  
	                   }else{
          $req_user1 ='SELECT *  FROM type_compte_application typecompte ,cycle cy,professeur p,classe c,matiere m,compte_application_mobile compte where p.id_cycle=c.id_cycle and p.id_cycle=cy.id_cycle and m.code_mat=p.code_mat  and p.code_prof=compte.code_user and compte.type=typeCompte.id  and p.code_prof="'.$data['code_user'].'"' ;
	}

	 
           $retour = $db->prepare($req_user1);
           $retour->execute();
           $result = $retour->fetch(\PDO::FETCH_ASSOC);
  if($result){
   $resulTF=$result;
  }else{
    
     $resulTF=array( "emaill"=>"0","typeComp"=>"0");
  }
  }
//echo json_encode($resulTF);
           //echo $result;
	        return $resulTF;

//print_r($_POST['pseudo']);
exit();
  	}
      public function getChauffeurEleve(){
    header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$code=$request->code;
$anneeScolaire=$request->anneeScolaire;
//$code=254545803;
//$anneeScolaire='2018/2019';
        $DBConnection = new DBConnection();
          $db = $DBConnection->DBConnection();

    
    //$codeProf=13;
  
  
         $req_emploie2 ='SELECT users.`t_clien`.code,opils.employee.firstname as prenom,opils.employee.lastname as nom,opils.employee.contact_info as contact,opils.bus.Matricule,opils.bus.id as numeroBus,concat("http://196.61.237.234/ESS_V1/",opils.employee.photo) as photo FROM users.`t_clien`  , opils.transport , opils.bus, opils.employee where users.`t_clien`.code =opils.transport.code and opils.transport.annee="'.$anneeScolaire.'" and opils.transport.code="'.$code.'" and opils.transport.nbus=opils.bus.id and opils.bus.Matricule=opils.employee.bus group by opils.employee.userid

';


     

 $retour = $db->prepare($req_emploie2);
 $retour->execute();
           
            $result = $retour->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
  public function setPassword(){

header("Access-Control-Allow-Origin: *");
header('Content-type:application/json');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$login=$request->pseudo;
$oldPassword=md5($request->oldPassword);
$newPassword=md5($request->newPassword);
//$code_user=$request->code_user;
//$login="abderazak.daray@essp.com";
/*$login="aasimmi.hafyan@es.com";*/
//$password=md5("1234546789");
/*$oldPassword=md5('12345678889');
$newPassword=md5('123456789');*/
                        
    $DBConnection = new DBConnection();
    $db = $DBConnection->DBConnection();
   
           $reqUpdate='update compte_application_mobile set password="'.$newPassword.'" where lower(email)=lower("'.$login.'") and password="'.$oldPassword.'"';
      
            $retour = $db->prepare($reqUpdate);
             $result=$retour->execute();
             return $result;
  }
  }
	
?>