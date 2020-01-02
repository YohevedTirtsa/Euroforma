<?php
/**
 * Gestion de l'accueil
 *
 * PHP Version 7
 *

 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */


$estVisiteurConnecte= estVisiteurConnecte();
$estComptableConnecte= estComptableConnecte();

if ($estVisiteurConnecte) {
    include 'vues/v_accueilVisiteur.php';
} elseif ($estComptableConnecte){
    include 'vues/v_accueilComptable.php';
} else{
    include 'vues/v_connexion.php';
}