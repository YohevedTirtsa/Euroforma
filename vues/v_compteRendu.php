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
<input name="lstEleves" type="hidden" id="lstEleves" class="form-control" value="<?php echo $eleve ?>">
<h2>Horaires du mois <?php echo $mois ?> - </h2>
Bonjour _______<a><?php echo $employeur ?></a><br>
Concernant les horaires du mois de <a1><?php echo $nomEleve['nom'].$nomEleve['prenom'] ?></a1><br>
Je vous informe que ce mois de <?php echo $mois ?><br>
a assisté à <?php echo $nbPresences ?>_____heures de formation prévues par le planning. 
Soit un taux de présence de <?php echo $pourcentage ?>%. Donc ____ <?php echo $nbAbsences?> heures d’absence en formation et une assiduité maximale ! 
  
Que de bonne choses, <br><br>
</form>
<form method="post" 
              action="index.php?uc=genererCR&action=telechargerPDF" 
              role="form">
            <button class="btn btn-success" type="submit" link="">Telecharger PDF</button>
</form>
<form method="post" 
              action="index.php?uc=genererCR&action=envoiPDF" 
              role="form">    
            <input class="btn btn-success" type="hidden" value="Envoi du pdf"/>
</form>

 
 

