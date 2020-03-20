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
        echo $idEleve;
        $nomEleve= $pdo->getNomEleve($idEleve);
        var_dump($nomEleve);
        $employeur=$pdo->getEmployeur('2');
        var_dump( $employeur);//['nom'],$employeur['prenom'];
        $mois = getMois(date('d/m/Y'));
        echo $mois;
        $nbPresences=$pdo->getNbPresence($idEleve);
        $heuresFaites=$pdo->getDureePresence($idEleve,$mois);
        $heuresTotal=$pdo->getDureeSeancesTotal($mois);        
        $pourcentage=calculPourcentage($heuresFaites,$heuresTotal);
       /* if($pourcentage=="100"){
            echo"Assiduité maximale!";
        }*/
        $nbAbsences=$pdo->getNbAbsences($idEleve);
        var_dump($nbAbsences);
        include 'vues/v_compteRendu.php';
        break;
    case 'telechargerPDF':
        //require('fpdf.php');
        include 'includes/class.pdf.php';
        break;
    case 'envoiPDF':
        $eleve = filter_input(INPUT_POST, 'lstEleves', FILTER_SANITIZE_STRING);
        $emailEuroforma="euroforma.contact@gmail.com";
        $emailEmployeur=$pdo->getEmailEmployeur($eleve);
        $objet="compte rendu de tel eleve";
        $lienPDF='<a href="http://localhost/Euroforma/index.php?uc=genererCR&action=telechargerPDF"></a>';
        $corpsDuMessage="Voici le compte rendu de".$eleve[nom].$eleve[prenom]."pour ce mois.".$lienPDF;
        getMois(date('d/m/Y'));
        if(date('30/m/Y')||date('31/m/Y')){
            mail($emailEmployeur,$objet,$corpsDuMessage,$emailEuroforma);
        }
        break;
}
