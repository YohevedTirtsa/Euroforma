<?php
/**
 * Index de l'application Euroforma
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */

require_once 'includes/fct.inc.php';//Besoin en préliminaire
require_once 'includes/class.pdoeuro.inc.php';//idem
session_start(); // Variable Super Globale
$pdo = PdoEuro::getPdoEuro();
$estConnecte = estConnecte();
require 'vues/v_entete.php';//requis

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);//on verifie le contenu de uc
if (empty($uc) && !$estConnecte) {
    $uc = 'connexion';
} else if ($estConnecte) {
    $uc = 'accueil';
}

switch ($uc) {
case 'connexion':
    include 'controleurs/c_connexion.php';
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
case 'emargement':
    include 'controleurs/c_emargement.php';
    break;
}
require 'vues/v_pied.php';
