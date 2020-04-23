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
        include 'includes/class.mail.php';
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
}
