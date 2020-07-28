<?php

/* 
A domain Class to demonstrate RESTful web services

*/
require_once("connection_.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require  'vendor/autoload.php';
Class EmailNotification  {
  


	
	public function setSendEmail(){
		

				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
          /* $code_user=$request->email;
           $messageT=$request->message_text;
            $matiere=$request->code_mat;*/
            /*$email_user="abderazak.daray@essp.com";
            $code_enfant="5";
            $sujet_demande="rdv pr dicute les notes";
            $date_propose="2019-03-28 09:00:03";*/
             $email_user=$request->email;
            $code_enfant=$request->code;
            $sujet_demande=$request->motifDemande;
            $date_propose=$request->date;



            $mail = new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                           
//Provide username and password     
$mail->Username = "es.envoie.notif@gmail.com";                 
$mail->Password = "ES2019Notif";                           
//If SMTP requires TLS encryption then set it
//$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = "es.envoie.notif@gmail.com";
$mail->FromName = "Les Ecoles Scientifiques - Application mobile";
$mail->CharSet = 'UTF-8';
$mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);
 $body = '<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   
    </head>
    <body>
<p>Bonjour,</p>
<p>Ce message concerne l\'utilisateur '.$email_user.' Demandant un RDV . </p>
';

             $body .= '<p>Objectif de la demande:

   Code enfant concerné: '.$code_enfant.'<br/>
   Date proposé: '.$date_propose.'<br/>
   Sujet : '.$sujet_demande.' <br/>
<p> 
Cordialement,</body>
    </html>';
    $email="es.demande.rdv@gmail.com";

$mail->addAddress($email, "Recepient Name");

$mail->isHTML(true);

$mail->Subject = "Demande de RDV d'un parent";

$mail->Body = $body;
$mail->AltBody = strip_tags($body);

 if(!$mail->send())
        {
          $result="Données non enregistrées";  
        }
        else {
              $result= "Données Bien envoyées";
        }
  

           
 
       $stmt=$db->prepare('insert into demande_rdv_mobile (email,code,sujetdemande,datepropose) values(:email,:code,:sujetdemande,:datepropose)');
$stmt->bindParam(':email', $email_user, PDO::PARAM_STR);
$stmt->bindParam(':code', $code_enfant, PDO::PARAM_STR);
$stmt->bindParam(':sujetdemande', $sujet_demande, PDO::PARAM_STR);
$stmt->bindParam(':datepropose', $date_propose, PDO::PARAM_STR);


    $stmt->execute();
//$result= "Données Bien envoyées";

		return $result;
	}

			public function setSendEmailTransport(){
		

				header("Access-Control-Allow-Origin: *");
				header('Content-type:application/json');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


		  	$DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
		
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
         
            /*$email_user="abderazak.daray@essp.com";
            $code_enfant="5";*/
           
             $email_user=$request->email;
            $code_enfant=$request->code;


            $mail = new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                           
//Provide username and password     
$mail->Username = "es.envoie.notif@gmail.com";                 
$mail->Password = "ES2019Notif";                           
//If SMTP requires TLS encryption then set it
//$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = "es.envoie.notif@gmail.com";
$mail->FromName = "Les ecoles scientifiques - Application mobile";
$mail->CharSet = 'UTF-8';
$mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);
 $body = '<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   
    </head>
    <body>
<p>Bonjour,</p>
<p>Ce message concerne l\'utilisateur '.$email_user.' Demandant Inscription au service transport . </p>
';

             $body .= '<p>Objectif de la demande:

   Code enfant concerné: '.$code_enfant.'<br/>
   Sujet : Demande d\'inscription au transport <br/>
<p> 
Cordialement,</body>
    </html>';
    $email="es.inscription.transport@gmail.com";

$mail->addAddress($email, "Recepient Name");

$mail->isHTML(true);

$mail->Subject = "Inscription Transport";

$mail->Body = $body;
$mail->AltBody = strip_tags($body);

 if(!$mail->send())
        {
         $result="Données non enregistrées" ;
        }
        else {
            $result= "Données bien envoyées";
        }
  

           
 
       $stmt=$db->prepare('insert into demande_ins_transp_mobile (email,code) values(:email,:code)');
$stmt->bindParam(':email', $email_user, PDO::PARAM_STR);
$stmt->bindParam(':code', $code_enfant, PDO::PARAM_STR);

    $stmt->execute();


      

           
           // $result = 'Done';
 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
		return $result;
	}



      public function setSendEmailCantine(){
    

        header("Access-Control-Allow-Origin: *");
        header('Content-type:application/json');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


        $DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
    
           $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
         
           /* $email_user="abderazak.daray@essp.com";
            $code_enfant="5";
             $commentaire="mon enfant à une allergie aux carrotes";*/
           
           $email_user=$request->email;
           $code_enfant=$request->code;
           $commentaire=$request->commentaire;


            $mail = new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                           
//Provide username and password     
$mail->Username = "es.envoie.notif@gmail.com";                 
$mail->Password = "ES2019Notif";                           
//If SMTP requires TLS encryption then set it
//$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = "es.envoie.notif@gmail.com";
$mail->FromName = "Les ecoles Scientifiques - Application mobile";
$mail->CharSet = 'UTF-8';
$mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);
 $body = '<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   
    </head>
    <body>
<p>Bonjour,</p>
<p>Ce message concerne l\'utilisateur '.$email_user.' Demandant Inscription au service cantine . </p>
';

             $body .= '<p>Objectif de la demande:

   Code enfant concerné: '.$code_enfant.'<br/>
   Sujet : Demande d\'inscription à la cantine <br/>
   Remarque : <br/>
    '.$commentaire.'<br/>
<p> 
Cordialement,</body>
    </html>';
    $email="es.inscription.cantine@gmail.com";

$mail->addAddress($email, "Recepient Name");

$mail->isHTML(true);

$mail->Subject = "Inscription Cantine";

$mail->Body = $body;
$mail->AltBody = strip_tags($body);

 if(!$mail->send())
        {
         $result="Données non enregistrées" ;
        }
        else {
            $result= "Données bien envoyées";
        }
  

           
 
       $stmt=$db->prepare('insert into demande_ins_cantine_mobile (email,code,commentaire) values(:email,:code,:commentaire)');
$stmt->bindParam(':email', $email_user, PDO::PARAM_STR);
$stmt->bindParam(':code', $code_enfant, PDO::PARAM_STR);
$stmt->bindParam(':commentaire', $commentaire, PDO::PARAM_LOB);

    $stmt->execute();

    return $result;
  }

  public function setSendEmailPreinscription(){
    

        header("Access-Control-Allow-Origin: *");
        header('Content-type:application/json');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');


        $DBConnection = new DBConnection();
           $db = $DBConnection->DBConnection();
    
         $postdata = file_get_contents("php://input");
           $request = json_decode($postdata);
         
            /*$email_user="abderazak.daray@essp.com";
            $code_enfant="5";*/
           
           $nom_p=$request->nomparent;
            $prenom_p=$request->prenomparent;
            $adresse_p=$request->adresseparent;
            $telephone_p=$request->telephoneparent;
            $email_parent=$request->emailparent;
            $nom_e=$request->nomenfant;
            $prenom_e=$request->prenomenfant;
            $datenaissance_e=$request->datenaissance;
            $niveauactuel=$request->niveauactuel;
            $etablissementactuel=$request->etablissementactuel;
            $cantine=$request->cantine;
            $transport=$request->transport;

           /* $nom_p="MACHRAFI";
            $prenom_p="M'barek";
            $adresse_p="Sud ouest";
            $telephone_p="0615380769";
            $email_parent="nisrine.machrafi@gmail.com";
            $nom_e="MACHRAFI";
            $prenom_e="Nisrine";
            $datenaissance_e="1990-02-24";
            $niveauactuel="Tronc commun";
            $etablissementactuel="Lissan eddin";
            $cantine="0";
            $transport="1";*/


            $mail = new PHPMailer;

//Enable SMTP debugging. 
$mail->SMTPDebug = 0;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                           
//Provide username and password     
$mail->Username = "es.envoie.notif@gmail.com";                 
$mail->Password = "ES2019Notif";                           
//If SMTP requires TLS encryption then set it
//$mail->SMTPSecure = "tls";                           
//Set TCP port to connect to 
$mail->Port = 587;                                   

$mail->From = "es.envoie.notif@gmail.com";
$mail->FromName = "Les ecoles scientifiques - Application mobile";
$mail->CharSet = 'UTF-8';
$mail->smtpConnect(
    array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
        )
    )
);
 $body = '<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   
    </head>
    <body>
<p>Bonjour,</p>
<p>Ce message concerne l\'utilisateur '.$nom_p.' Demandant Inscription au service transport . </p>
';

             $body .= '<p>Objectif de la demande:

   Code enfant concerné: '.$prenom_e.'<br/>
   Sujet : Demande de preinscription <br/>
<p> 
Cordialement,</body>
    </html>';
    $email="es.demande.preinscription@gmail.com";

$mail->addAddress($email, "Recepient Name");

$mail->isHTML(true);

$mail->Subject = "Preinscription ";

$mail->Body = $body;
$mail->AltBody = strip_tags($body);

 if(!$mail->send())
        {
         $result="Données non enregistrées" ;
        }
        else {
            $result= "Données bien envoyées";
        }
  

           
 
       $stmt=$db->prepare('insert into demande_preinscription (nom_P,prenom_P,adresse_P,telephone_P,email_P,nom_E,prenom_E,dateNaissance_E,niveauActuel,etablissementActuel,Cantine,Transport) values(:nom_P,:prenom_P,:adresse_P,:telephone_P ,:email_P ,:nom_E ,:prenom_E ,:dateNaissance_E ,:niveauActuel,:etablissementActuel ,:Cantine ,:Transport  )');
$stmt->bindParam(':nom_P', $nom_p, PDO::PARAM_STR);
$stmt->bindParam(':prenom_P', $prenom_p, PDO::PARAM_STR);
$stmt->bindParam(':adresse_P', $adresse_p, PDO::PARAM_STR);
$stmt->bindParam(':telephone_P', $telephone_p, PDO::PARAM_STR);
$stmt->bindParam(':email_P', $email_parent, PDO::PARAM_STR);
$stmt->bindParam(':nom_E', $nom_e, PDO::PARAM_STR);
$stmt->bindParam(':prenom_E', $prenom_e, PDO::PARAM_STR);
$stmt->bindParam(':dateNaissance_E', $datenaissance_e, PDO::PARAM_STR);
$stmt->bindParam(':niveauActuel', $niveauactuel, PDO::PARAM_STR);
$stmt->bindParam(':etablissementActuel', $etablissementactuel, PDO::PARAM_STR);
$stmt->bindParam(':Cantine', $cantine, PDO::PARAM_STR);
$stmt->bindParam(':Transport', $transport, PDO::PARAM_STR);

    $stmt->execute();


      

           
           // $result = 'Done';
 //$gerance[] = array( "email"=>$result['email'],"nom"=>$result['nom'],"prenom"=>$result['prenom'],"tel"=>$result['tel'],"typeProf"=>$result['typeProf'],"typeCompt"=>$result['typeCompt'],"libelleCompt"=>$result['libelleCompt'],"classe"=>$result['classe'],"matiere"=>$result['matiere'],"cycle"=>$result['cycle'],"classId"=>$result['classId']);
    //echo $result;
    return $result;
  }

}
?>