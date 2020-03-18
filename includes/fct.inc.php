<?php
/*
 * Fonctions pour l'application GSB
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */

/**
 * Teste si un quelconque utilisateur est connecté
 *
 * @return vrai ou faux
 */
function estConnecte()
{
    return isset($_SESSION['nom']);//isset: question: Est qu il y a un IdUtilisateur dans la SuperGlobable ?(vrai ou faux?)
}
/**
* Ajoute le libellé d'une erreur au tableau des erreurs
*
* @param String $msg Libellé de l'erreur
*
* @return null
*/
function ajouterErreur($msg)
{
   if (!isset($_REQUEST['erreurs'])) {
       $_REQUEST['erreurs'] = array();
   }
   $_REQUEST['erreurs'][] = $msg;
}
/**
* Enregistre dans une variable session les infos d'un utilisateur
*
* @param String $nom        Nom du utilisateur
*
* @return null
*/
function connecter($nom)
{
  $_SESSION['nom'] = $nom;
}
/**
 * Détruit la session active
 *
 * @return null
 */
function deconnecter()
{
    session_destroy();
}

/**
 * retourne oui si l'eleve est present (cas cochée),sinon non
 * @param type $presence
 * @param type $total
 * @return string
 */
function presence($presence,$total){
    $pres=array();
    //initialisation du tableau a NON
    for($i=0; $i<$total[0]; $i++ ){
      $pres[$i]='NON';  
    }
    // on remplace les eleves coches par OUI
    foreach ($presence as $value) { 
        $pres[$value-1]='OUI';
    }                  
    return $pres;
}
