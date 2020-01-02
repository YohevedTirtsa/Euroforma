<?php
/**
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
    return isset($_SESSION['idUtilisateur']);//isset: question: Est qu il y a un IdUtilisateur dans la SuperGlobable ?(vrai ou faux?)
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