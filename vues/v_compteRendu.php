<?php
/**
 * Vue des comptes rendus
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Tsipora Schvarcz
 */
?>
<form method="post" 
              action="index.php?uc=genererCR&action=genererCR" 
              role="form">
<input name="lstEleves" type="hidden" id="lstEleves" class="form-control" value="<?php echo $idEleve ?>">
<h2>Horaires du mois <?php echo $mois ?> - <?php echo $nomEleve['nom']." ".$nomEleve['prenom'] ?></h2><br>
Bonjour Mr <?php echo $employeur['nom']." ".$employeur['prenom'] ?>,<br><br>
Concernant les horaires du mois de <?php echo $nomEleve['nom']." ".$nomEleve['prenom'] ?><br>
Je vous informe que ce mois de <?php echo $mois ?> l'élève a assisté à <?php echo $heuresFaites[0] ?> sur <?php echo $heuresTotal[0] ?> heures de formation prévues par le planning.<br> 
Soit un taux de présence de <?php echo $pourcentage ?>%.<br>
Donc <?php echo $heuresAbsence?> heures d’absence en formation et une assiduité maximale ! <br>
  
Que de bonne choses, <br><br>
</form>
<form method="post" 
              action="index.php?uc=genererCR&action=telechargerPDF" 
              role="form">
            <input name="lstEleves" type="hidden" id="lstEleves" class="form-control" value="<?php echo $idEleve ?>">
            <button class="btn btn-success" type="submit" link="">Telecharger PDF</button>
</form>
<!--<form method="post" 
              action="index.php?uc=genererCR&action=envoiPDF" 
              role="form">    
    <input name="lstEleves" type="hidden" id="lstEleves" class="form-control" value="<?php echo $idEleve ?>">
    <input class="btn btn-success" type="submit"value="Envoi du pdf"/>
</form>-->

 
 

