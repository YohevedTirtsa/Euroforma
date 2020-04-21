<?php
/**
 * Classe d'accès aux données
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Tsipora Schvarcz
 */

class PdoEuro
{
    private static $serveur = 'mysql:host=localhost';
    private static $bdd = 'dbname=euroforma';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoEuro = null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoEuro::$monPdo = new PDO(
            PdoEuro::$serveur . ';' . PdoEuro::$bdd,
            PdoEuro::$user,
            PdoEuro::$mdp
        );
        PdoEuro::$monPdo->query('SET CHARACTER SET utf8');
    }

    /**
     * Méthode destructeur appelée dès qu'il n'y a plus de référence sur un
     * objet donné, ou dans n'importe quel ordre pendant la séquence d'arrêt.
     */
    public function __destruct()
    {
        PdoEuro::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoEuro = PdoEuro::getPdoEuro();
     *
     * @return l'unique objet de la classe PdoEuro
     */
    public static function getPdoEuro()
    {
        if (PdoEuro::$monPdoEuro == null) {
            PdoEuro::$monPdoEuro = new PdoEuro();
        }
        return PdoEuro::$monPdoEuro;
    }
    
    /**
     * Retourne les informations d'un utilisateur
     *
     * @param String $login Login du utilisateur
     * @param String $mdp   Mot de passe du utilisateur
     *
     * @return le nom sous la forme d'un tableau associatif
     */
    public function getInfosUtilisateur($login, $mdp)
    {
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT utilisateur.nom AS nom '
            . 'FROM utilisateur '
            . 'WHERE utilisateur.login = :unLogin AND utilisateur.mdp = :unMdp'
        );
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }
    /**
     * Retourne la liste de tous les eleves.
     * @return array        la liste de tous les eleves sous forme de tableau associatif.
     */
    public function getLesEleves()
    {
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT *'
            . 'FROM eleve '
            . 'ORDER BY nom'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    /**
     * Retourne le nom et le prenom de l'eleve.
     * @param string $idEleve    id de l'élève
     * @return array        tableau contenant nom et prenom de l'eleve.    
     */
    public function getNomEleve($idEleve){
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT eleve.nom ,eleve.prenom '
            . 'FROM eleve '
            . 'WHERE eleve.idEleve=:unId '   
        );
        $requetePrepare->bindParam(':unId', $idEleve , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    } 
    /**
     * Retourne le nom et le prenom de l'employeur qui se charge de l'élève choisi.
     * @param string $idEleve    id de l'élève
     * @return array             tableau contenant nom et prenom de l'employeur.
     */
    public function getEmployeur($idEleve){
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT employeur.nom ,employeur.prenom '
            . 'FROM employeur join eleve using(idEmployeur)'
            . 'WHERE eleve.idEleve=:unId'    
        );
        $requetePrepare->bindParam(':unId', $idEleve , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }           
    /**
     * Retourne le pourcentage de présence de l'eleve choisi durant le mois passé.
     * @param type $eleve
     * @param type $mois
     */
     /*public function getPourcentagePresence($eleve,$mois){
        $requetePrepare = PdoEuro::$monPdo->prepare(
            '((select sum(durée) as reqTotal'
                .'from seance'
                .'where date=:unMois'
                .'UNION'
                .'select sum(durée)'
                .'from seance join emargement'
                .'where seance.idSeance=emargement.idSeance'
                .'and emargement.idEleve=:unEleve'
                .'and emargement.presence="oui"'
                .'and date=:unMois)*100)/reqTotal'
        );
        $requetePrepare->bindParam(':unEleve', $eleve, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }*/
    /**
     * Retourne la duree des seances ou l'eleve etait present
     * @param type $eleve
     * @param type $mois
     * @return type
     */
    public function getDureePresence($eleve,$mois){
        $requetePrepare = PdoEuro::$monPdo->prepare(
                "select sum(durée)"
                ."from seance join emargement using(idSeance)"
                ."where emargement.idEleve='$eleve'"
                ."and emargement.presence='oui'"
                ."and date LIKE CONCAT('%',:unMois)"
                );
        //$requetePrepare->bindParam(':unEleve', $eleve, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }
    /**
     * Retourne la somme de la durée des seances
     * @param type $mois       le mois actuel
     * @return type
     */
     public function getDureeSeancesTotal($mois){
        $requetePrepare = PdoEuro::$monPdo->prepare(
                'select sum(durée)'
                .'from seance '
                ."where date LIKE CONCAT('%','$mois')"
                );
        //$requetePrepare->bindParam(':unMois', $mois , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }
    /**
     * Retourne l'adresse mail de l'employeur en question.
     * @param type $idEleve
     * @return type
     */
    public function getEmailEmployeur($idEleve){
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT employeur.email '
            . 'FROM employeur join eleve using(idEmployeur)'
            . 'WHERE eleve.idEleve=:unId'    
        );
        $requetePrepare->bindParam(':unId', $idEleve , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch()[0];
    }           
    /**
     * Retourne le nombre d'absence de l'élève choisi durant le mois passé.
     * @param type $idEleve
     */
    public function getNbAbsences($idEleve,$mois){
        $requetePrepare = PdoEuro::$monPdo->prepare(
                'SELECT count(presence)'
                .'FROM emargement join seance using(idSeance)'
                .'WHERE presence="non"'
                ."AND idEleve='$idEleve'"
                .'AND date LIKE CONCAT("%",:unMois)'
        );
        //$requetePrepare->bindParam(':unEleve', $idEleve , PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }
    /**
     * Retourne le nombre de presence de l'élève choisi durant le mois passé.
     * @param type $idEleve
     */
    public function getNbPresence($idEleve,$mois){
        $requetePrepare = PdoEuro::$monPdo->prepare(
                'SELECT count(presence)'
                .'FROM emargement join seance using(idSeance)'
                .'WHERE presence="oui"'
                ."AND idEleve='$idEleve'"
                .'AND date LIKE CONCAT("%",:unMois)'
        );
        //$requetePrepare->bindParam(':unId', $idEleve , PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMois', $mois , PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }
          
}