<?php
/**
 * Classe d'accès aux données
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
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
     *  retourne les informations d'une séance
     * @return type
     */
    public function getSeances()
    {
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT * '
            . 'FROM seance '
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
        
    }
    /**
     * Retourne les informations de la séance passée en parametre
     * @param type $idSeance
     * @return type
     */
    public function getLaSeance($idSeance)
    {
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT * '
            . 'FROM seance '
            . 'WHERE seance.id= :idSeance'
        );
        $requetePrepare->bindParam(':idSeance', $idSeance, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
        
    }
    /**
     * Retourne la liste des éleves
     * @return type
     */
    public function getEleves()
            {
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT * '
            . 'FROM eleve'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    /**
     * Retourne le nombre d'éleves
     * @return type
     */
    public function countEleves()
            {
        $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT count(*) '
            . 'FROM eleve'
        );
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }
    
    /**
     * insere dans la table emargement la liste des eleves presents et absents (motif si nécessaire) pour une séance donnée
     * @param type $idSeance
     * @param type $idEleve
     * @param type $presence
     * @param type $motif
     */
    public function remplirEmargement($idSeance,$idEleve,$presence,$motif,$lien){

        for ($i = 0; $i < count($idEleve); $i++) {
            $element=$idEleve[$i];
            $unMotif=$motif[$i];
            $unePresence=$presence[$i];
            $idEmargement= $idSeance."-".($i+1);
            $requetePrepare = PdoEuro::$monPdo->prepare(
                'INSERT INTO emargement '
                . 'VALUES (:unIdEmargement,:unIdSeance, :unIdEleve,:unePresence, :unMotif, :unLien) '
            ); 
            $requetePrepare->bindParam(':unIdEmargement', $idEmargement, PDO::PARAM_STR);
            $requetePrepare->bindParam(':unIdSeance', $idSeance, PDO::PARAM_STR);
            $requetePrepare->bindParam(':unIdEleve', $element, PDO::PARAM_STR); 
            $requetePrepare->bindParam(':unePresence', $unePresence, PDO::PARAM_STR);  
            $requetePrepare->bindParam(':unMotif', $unMotif, PDO::PARAM_STR);  
            $requetePrepare->bindParam(':unLien', $lien, PDO::PARAM_STR);
            $requetePrepare->execute();  
               
        }
            //une fois l'emargement effectué, la colonne emarge est remplie a OUI
            $requetePrepare2 = PdoEuro::$monPdo->prepare(
                    'UPDATE seance '
                    . 'SET emarge = "OUI" '
                    . 'WHERE seance.id = :uneSeance '
                );
            $requetePrepare2->bindParam(':uneSeance', $idSeance, PDO::PARAM_STR);                      
            $requetePrepare2->execute();
                
        return $requetePrepare->fetchAll();
    }
    /**
     * recupere la table emargement (presence, motif...)
     * @return type
     */
    public function getEmargement($idSeance)
        {
       $requetePrepare = PdoEuro::$monPdo->prepare(
            'SELECT emargement.idSeance,emargement.idEleve,emargement.lienEmarge,presence,motif,prenom,nom '
            . 'FROM emargement join eleve using(idEleve) '
            . 'WHERE emargement.idSeance = :uneSeance'
        );
        $requetePrepare->bindParam(':uneSeance', $idSeance, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetchAll();
    }
    

}