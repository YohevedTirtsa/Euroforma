<?php

/**
 * Controleur Valider Frais
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */

$mois = getMois(date('d/m/Y'));
$moisPrecedent= getmoisPrecedent($mois);
$Cloture = $pdo->clotureFiche($moisPrecedent);

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
case 'selectionnerVetM':
    $lesVisiteurs= $pdo->getLesVisiteurs();
    $lesCles1=array_keys($lesVisiteurs);
    $leVisiteurASelectionner= $lesCles1[0];
    $lesMois= getLesMois($mois);
    $lesCles = array_keys($lesMois);
    $moisASelectionner = $lesCles[0];
    include  'vues/v_listesVisiteurEtMois.php';
    break;
case 'afficheFrais':
    $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
    $lesVisiteurs= $pdo->getLesVisiteurs();
    $leVisiteurASelectionner= $idVisiteur;
    $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
    $lesMois= getLesMois($mois);
    $moisASelectionner= $leMois;
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois); 
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois); 
    include 'vues/v_afficheFrais.php';

    
    break;
}


