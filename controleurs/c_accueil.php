<?php
/**
 * Gestion de l'accueil
 *
 * PHP Version 7
 *

 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Tsipora Schvarcz
 */

$estConnecte= estConnecte();

if ($estConnecte) {
    include 'vues/v_accueil.php';
} else{
    include 'vues/v_connexion.php';
}

