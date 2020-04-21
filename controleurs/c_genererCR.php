<?php
/**
 * Generation des comptes rendus
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Tsipora Schvarcz
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$uc) {
    $uc = 'genererCR';
}
switch ($action) {
    case 'choixEleve':
        $lesEleves=$pdo->getLesEleves();
        $lesCles1=array_keys($lesEleves);
        include 'vues/v_listeEleve.php';
        break;
    case 'genererCR':
        $idEleve = filter_input(INPUT_POST, 'lstEleves', FILTER_SANITIZE_STRING);
        $nomEleve= $pdo->getNomEleve($idEleve);
        $employeur=$pdo->getEmployeur($idEleve);
        $mois = getMois(date('d/m/Y'));
        $heuresFaites=$pdo->getDureePresence($idEleve,$mois);
        $heuresTotal=$pdo->getDureeSeancesTotal($mois); 
        $heuresAbsence=$heuresTotal[0]-$heuresFaites[0];
        $pourcentage=calculPourcentage($heuresFaites[0],$heuresTotal[0]);
       /* if($pourcentage=="100"){
            echo"Assiduité maximale!";
        }*/
 //       $nbPresences=$pdo->getNbPresence($idEleve,$mois);
 //       $nbAbsences=$pdo->getNbAbsences($idEleve,$mois);
        include 'vues/v_compteRendu.php';
        break;
    case 'telechargerPDF':
        $idEleve = filter_input(INPUT_POST, 'lstEleves', FILTER_SANITIZE_STRING);
        $nomEleve= $pdo->getNomEleve($idEleve);
        $employeur=$pdo->getEmployeur($idEleve);
        $mois = getMois(date('d/m/Y'));
        $heuresFaites=$pdo->getDureePresence($idEleve,$mois);
        $heuresTotal=$pdo->getDureeSeancesTotal($mois); 
        $heuresAbsence=$heuresTotal[0]-$heuresFaites[0];
        $pourcentage=calculPourcentage($heuresFaites[0],$heuresTotal[0]);
        include 'includes/class.pdf.php';
        break;
    case 'envoiPDF':
    //   require('PHPMailer-FE_v4.11/_lib/inc.sanitize.php');
    //    $eleve = filter_input(INPUT_POST, 'lstEleves', FILTER_SANITIZE_STRING);
    //    $emailEuroforma="tmaof55@gmail.com";//euroforma.contact@gmail.com";
    //    $emailEmployeur="tmaof55@gmail.com";//$pdo->getEmailEmployeur($eleve);
    //    $objet="compte rendu de tel eleve";
    //    $lienPDF="<a href='tests/pdf sauvegardé/compte rendu.pdf'></a>";
        // $body .= 'Content-Type: application/pdf; name="'.$lienPDF.'"'."n";
        //$body .= 'Content-Transfer-Encoding: base64'."n";
        //$body .= 'Content-Disposition: attachment; filename="'.$lienPDF.'"'."n";
    //    $corpsDuMessage="Voici le compte rendu de tel eleve".$lienPDF;//.$nomEleve[nom].$nomEleve[prenom]."pour ce mois.".$lienPDF;
       // $mois=getMois(date('d/m/Y'));
       // if($mois="25%"){
    //       mail($emailEmployeur,$objet,$corpsDuMessage,$emailEuroforma);
      //  }
    //    if(mail($emailEmployeur,$objet,$corpsDuMessage,$emailEuroforma)==true){  //Envoi du mail
    //        header('Euroforma/index.html'); //Redirection
    //    }else{
    //       echo "echec de l'envoi";
    //    }
    //    include 'includes/class.mail.php';
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $idEleve = filter_input(INPUT_POST, 'lstEleves', FILTER_SANITIZE_STRING);
        $nomEleve= $pdo->getNomEleve($idEleve);
        $mois = getMois(date('d/m/Y'));
        $from = "tmaof55@gmail.com";
        $to = $pdo->getEmailEmployeur($idEleve);
        $filename='/tests/pdf_sauvegardé/compte_rendu.pdf' ;
        //$lienPDF= "Content-Type: application/pdf; name=".$filename;
        $subject = "Compte rendu ".$nomEleve['nom']." ".$nomEleve['prenom'];
        $message = "Voici le compte rendu de ".$nomEleve['nom']." ".$nomEleve['prenom']. " au mois de ". $mois;
        $headers = "From:" . $from;
        $boundary = "_".md5 (uniqid (rand()));

  $attached_file = file_get_contents($filename); //file name ie: ./image.jpg
  $attached_file = chunk_split(base64_encode($attached_file));

  $attached = "\n\n". "--" .$boundary . "\nContent-Type: application; name=\"$filename\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$filename\"\r\n\n".$attached_file . "--" . $boundary . "--";

  $headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

  $body = "--". $boundary ."\nContent-Type: text/plain; charset=ISO-8859-1\r\n\n".$message . $attached;
        //$mail->AddAttachment($path, '', $encoding = 'base64', $type = 'application/pdf');-->ac phpMailer
        $envoi= mail($to,$subject,$body, $headers);
        if($envoi==true){
            echo "L'email a été envoyé.";
        }else{
            echo "echec de l'envoi";
        }
        break;
}
