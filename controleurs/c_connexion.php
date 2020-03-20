<?php
/**
 * Gestion de la connexion
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Tsipora Schvarcz
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = 'demandeconnexion';
}

switch ($action) {
case 'demandeConnexion':
    include 'vues/v_connexion.php';
    break;
case 'valideConnexion':
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
    $utilisateur = $pdo->getInfosUtilisateur($login, $mdp);
 
    if (!is_array($utilisateur)){ //si il n y a a rien dans utilisateur
        ajouterErreur('Login ou mot de passe incorrect');
        include 'vues/v_erreurs.php';
        include 'vues/v_connexion.php';
     } else {
       if (is_array($utilisateur)){
       $nom = $utilisateur['nom'];
       }
           connecter($nom);
           header('Location: index.php');
       }
   break;
default:
    include 'vues/v_connexion.php';
    break;
}

