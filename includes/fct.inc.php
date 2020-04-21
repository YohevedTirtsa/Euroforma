<?php
/**
 * Fonctions pour l'application Euroforma
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Tsipora Schvarcz
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
 * Retourne le mois au format aaaamm selon le jour dans le mois
 *
 * @param String $date au format  jj/mm/aaaa
 *
 * @return String Mois au format aaaamm
 */
function getMois($date)
{
    @list($jour, $mois, $annee) = explode('/', $date);
    unset($jour);//retire la variable jour pour obtenir le mois et l'année.
    if (strlen($mois) == 1) {//strlen=verifie le nombre de caractères. Ex:si mois=6, on va mettre 06.
        $mois = '0' . $mois;
    }
    return $mois."/".$annee;
}
function calculPourcentage($nombre,$total)
    { 
      $pourcentage = ($nombre*100)/$total;
      return $pourcentage;
    } 
