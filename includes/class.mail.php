<?php

ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $idEleve = filter_input(INPUT_POST, 'lstEleves', FILTER_SANITIZE_STRING);
        $nomEleve= $pdo->getNomEleve($idEleve);
        $mois = getMois(date('d/m/Y'));
        $from = "tmaof55@gmail.com";
        $to = $pdo->getEmailEmployeur($idEleve);
        $filename= "compte_rendu.pdf";
        $fichier='C:\wamp64\www\Euroforma\tests\pdf_sauvegardé\ '.$filename;
        $subject = "Compte rendu ".$nomEleve['nom']." ".$nomEleve['prenom'];
        $message = "Voici le compte rendu de ".$nomEleve['nom']." ".$nomEleve['prenom']. " au mois de ". $mois;
        $headers = "From:" . $from;
        $boundary = "_".md5 (uniqid (rand()));
        $contenu = file_get_contents($fichier); //file name ie: ./image.jpg
        $attached_file = chunk_split(base64_encode($contenu));
        $attached = "\n\n". "--" .$boundary . "\nContent-Type: application; "
                . "name=\"$fichier\"\r\nContent-Transfer-Encoding: base64\r\n"
                . "Content-Disposition: attachment; filename=\"$fichier\"\r\n\n".
                $attached_file . "--" . $boundary . "--";
        $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
        $body = "--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\n".$message . $attached;
        //$mail->AddAttachment($path, '', $encoding = 'base64', $type = 'application/pdf');-->ac phpMailer
        $date= getDateAc(date('d/m/Y'));
        $envoi=false;
        if(substr($date, 0, 2)=='30'){
            $envoi= mail($to,$subject,$body, $headers);
        }else{
            if(substr($date, 0, 5)=='28/02'){
                $envoi= mail($to,$subject,$body, $headers);
            }
        }
        if($envoi==true){
            echo "L'email a été envoyé.";
        }else{
            echo "echec de l'envoi";
        }
 
?>