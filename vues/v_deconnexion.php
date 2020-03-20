<?php
/**
 * Vue Déconnexion
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   GSB
 * @author    Tsipora Schvarcz
 */
deconnecter();
?>
<div class="alert alert-info" role="alert">
    <p>Vous avez bien été déconnecté ! <a href="index.php">Cliquez ici</a>
        pour revenir à la page de connexion.</p>
</div>
<?php
header("Refresh: 3;URL=index.php");
