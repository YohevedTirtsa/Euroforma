<?php

//Recuperation des données


/*error_reporting(E_ALL); 
ini_set("display_errors", 1); //Affichage des erreurs
 
//Eviter les insertions de scripts dans le cas d'un e-mail HTML
$nom = "Tsipora";
$email_from = "tmaof55@gmail.com"; 
$message = "Voici le compte rendu de tel eleve";
 
//Verifie si le fournisseur prend en charge les r
if(preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $email_from)){
    $passage_ligne = "\n";
}else{
    $passage_ligne = "\r\n";
}
 
$email_to = "tmaof55@gmail.com"; //Destinataire
$email_subject = "compte rendu de tel eleve";; //Sujet du mail
$boundary = md5(rand()); // clé aléatoire de limite
 
//Nettoyer le message

function clean_string($string) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    return str_replace($bad,"",$string);
}

//Création du mail

$headers = "From: ".".$nom."."<".$email_from.">" . $passage_ligne; //Emetteur
$headers.= "Reply-to: ".".$nom."." <".$email_from.">" . $passage_ligne; //Recepteur
$headers.= "MIME-Version: 1.0" . $passage_ligne; //Version de MIME
$headers.= 'Content-Type: multipart/mixed; boundary='.$boundary .' '. $passage_ligne; //Contenu du message (alternative pour deux versions ex:text/plain et text/html
 
//Contenu du message

$email_message = '--' . $boundary . $passage_ligne; //Séparateur d'ouverture
$email_message .= "Content-Type: text/plain; charset='utf-8'" . $passage_ligne; //Type du contenu
$email_message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne; //Encodage
$email_message .= $passage_ligne .clean_string($message). $passage_ligne; //Contenu du message

//Ajout de la pièce jointe

//Pièce jointe
        $nom_fichier = "compte rendu";
        $source = 'tests/pdf sauvegardé/compte rendu.pdf';
      //  $type_fichier = $_FILES['fichier']['type'];
      //  $taille_fichier = $_FILES['fichier']['size'];
                    
        if($nom_fichier != ".htaccess"){ //Vérifie que ce n'est pas un .htaccess
		//	 if($type_fichier == "image/jpeg" 
               // || $type_fichier == "image/pjpeg" 
               // || $type_fichier == "application/pdf"){ //Soit un jpeg soit un pdf
                 
               // if ($taille_fichier <= 2097152) { //Taille supérieure à Mo (en octets)
                    $tabRemplacement = array("é"=>"e", "è"=>"e", "à"=>"a"); //Remplacement des caractères spéciaux
                    
                    $handle = fopen($source, 'r'); //Ouverture du fichier
                    $content = fread($handle); //Lecture du fichier
                    $encoded_content = chunk_split(base64_encode($content)); //Encodage
                    $f = fclose($handle); //Fermeture du fichier
                                
                    $email_message .= $passage_ligne . "--" . $boundary . $passage_ligne; //Deuxième séparateur d'ouverture
                    $email_message .= 'Content-type:'.$type_fichier.';name="'.$nom_fichier.'"'."n"; //Type de contenu (application/pdf ou image/jpeg)
                    $email_message .='Content-Disposition: attachment; filename="'.$nom_fichier.'"'."n"; //Précision de pièce jointe
                    $email_message .= 'Content-transfer-encoding:base64'."n"; //Encodage
                    $email_message .= "n"; //Ligne blanche. IMPORTANT !
                    $email_message .= $encoded_content."n"; //Pièce jointe
        }else{
			//Message d'erreur
            $email_message .= $passage_ligne ."L'utilisateur a tenté de vous envoyer une pièce jointe .htaccess.". $passage_ligne;
        }
$email_message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne; //Séparateur de fermeture

//Envoi du mail

if(mail($email_to,$email_subject, $email_message, $headers)==true){  //Envoi du mail
    header('Euroforma/index.html'); //Redirection
}else{
    echo "echec de l'envoi";
}
*/



/*$mail_to = "xxx@xxx.fr"; //Destinataire
$from_mail = "xxx@yyy.com"; //Expediteur
$from_name = "Nom"; //Votre nom, ou nom du site
$reply_to = "xxx@yyy.com"; //Adresse de réponse
$subject = "Objet du mail";    
$file_name = "piece_jointe.pdf";
$path = $_SERVER['DOCUMENT_ROOT']."/fichiers";
$typepiecejointe = filetype($path.$file_name);
$data = chunk_split( base64_encode(file_get_contents($path.$file_name)) );
//Génération du séparateur
$boundary = md5(uniqid(time()));
$entete = "From: $from_mail \n";
$entete .= "Reply-to: $from_mail \n";
$entete .= "X-Priority: 1 \n";
$entete .= "MIME-Version: 1.0 \n";
$entete .= "Content-Type: multipart/mixed; boundary=\"$boundary\" \n";
$entete .= " \n";
$message  = "--$boundary \n";
$message .= "Content-Type: text/html; charset=\"iso-8859-1\" \n";
$message .= "Content-Transfer-Encoding:8bit \n";
$message .= "\n";
$message .= "Bonjour,<br />Veuillez trouver ci-joint le bon de commande<br/>Cordialement";
$message .= "\n";
$message .= "--$boundary \n";
$message .= "Content-Type: $typepiecejointe; name=\"$file_name\" \n";
$message .= "Content-Transfer-Encoding: base64 \n";
$message .= "Content-Disposition: attachment; filename=\"$file_name\" \n";
$message .= "\n";
$message .= $data."\n";
$message .= "\n";
$message .= "--".$boundary."--";
mail($mail_to, $subject, $message, $entete);*/


/*	require "class.phpmailer.php";
	$mail = new PHPmailer();
	$mail->IsHTML(true); //si votre email contient du HTML
	$mail->From='tmaof55@gmail.com';
	$mail->AddAddress('tmaof55@gmail.com');//destinataire
	$mail->AddReplyTo('tmaof55@gmail.com');	
	$mail->Subject='Compte rendu de tel eleve';
	$mail->Body='Voici le compte rendu de tel eleve';
	$mail->AddAttachment('tests/pdf_sauvegardé/compte_rendu.pdf');
        $mail->Send();
 
	if(!$mail->Send()){
	  echo "echec de lenvoi"; 
	}
	else{	  
	  echo "Mail envoyé";
	}
 
	unset($mail);*/
ini_set( 'display_errors', 1 );
     error_reporting( E_ALL );
    $from = "tmaof55@gmail.com";
    $to = "tmaof55@gmail.com";
    $subject = "Vérification PHP mail";
    $message = "PHP mail marche";
    $headers = "From:" . $from;
    $envoi= mail($to,$subject,$message, $headers);
    if($envoi==true){
        echo "L'email a été envoyé.";
    }else{
        echo "echec de l'envoi";
    }
 
?>