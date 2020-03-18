<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form method="post" role="form" action="index.php?uc=emargement&action=validerEmargement&idSeance=<?php echo $laSeance['id']?>">
    <div id="accueil" style="text-align: center">
    <h2>
        <?php
           echo 'Consulter Emargement :'. $laSeance['date'].' - '. $laSeance['matiere'].' - '.$laSeance['formateur']
        ?>    
    </h2>
    </div>
    <br>
    <fieldset>
    <div class="row">
    <div class="panel panel-info">
        <table class="table table-bordered table-responsive">
            <thead style="background-color: #f0f5eb">
            <tr>
                <th >Eleves</th>
                <th >Presence</th>  
                <th >Motif si absence</th>                  
            </tr>
            </thead>            
        <tbody>
        <?php
            foreach ($lesEmargements as $unEmargement) {
            $idEleve= htmlspecialchars($unEmargement['idEleve']);
            $prenom= $unEmargement['prenom'];
            $nom= $unEmargement['nom'];
            $presence = $unEmargement['presence'];
            $motif = $unEmargement['motif'];
        ?>
            
            <tr>
                <td><?php echo $prenom. ' '.$nom?></td>
                <td><?php echo $presence?></td>
                <td><?php echo $motif?></td> 
            </tr>
            <input type="hidden" name="idEleve[]" value="<?php echo $idEleve?>">       
         <?php
        }
        ?>
        </tbody> 
        </table>
    </div>
    </div>

    <br> 
    <?php
     foreach ($lesEmargements as $unEmargement) {
        $lien= $unEmargement['lienEmarge']."+";
        $leLien= explode('+', $lien);//explode separe la variable lorsqu il y a un +, et renvoie ainsi plusieurs tableaux 
    } 
    ?>
    <p style="float: right;width: 60px; ">
        <a href="<?php echo $leLien[0]?>" download="FicheEmargement"> 
            <img src="./images/pdf.png" class="img-responsive" alt="pdf" title="Telecharger la fiche d'émargement">
        </a>
    </p>
    <br><br>
    </fieldset>
</form>
