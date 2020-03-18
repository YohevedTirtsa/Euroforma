<?php

/**
 * Vue emargement
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */
?>
<form method="post" role="form" enctype="multipart/form-data" action="index.php?uc=emargement&action=validerEmargement&idSeance=<?php echo $laSeance['id']?>">
    <div id="accueil" style="text-align: center">
    <h2>
        <?php
           echo 'Emargement :'. $laSeance['date'].' - '. $laSeance['matiere'].' - '.$laSeance['formateur']
        ?>
    </h2>
    </div>
    <fieldset>
    <div class="row">
    <div class="panel1">
        <table class="table table-bordered table-responsive">
            <thead>
            <tr>
                <th >Eleves</th>
                <th >Presence</th>  
                <th >Motif si absence</th>                  
            </tr>
            </thead>            
        <tbody>
        <?php
            foreach ($eleves as $unEleve) {
            $idEleve= htmlspecialchars($unEleve['idEleve']);
            $prenom = $unEleve['prenom'];
            $nom = $unEleve['nom'];
        ?>
            
            <tr>
                <td><label for="cocher"><?php echo $prenom. ' '.$nom?></label></td>
                <td><input checked="checked" type="checkbox" name="cocher[]" value="<?php echo $idEleve?>"></td>
                <td><input class="form-control"  name="motif[]" type="text" size="38 px"></td>               
            </tr>
            <input type="hidden" name="idEleve[]" value="<?php echo $idEleve?>">
         <?php
        }
        ?>
           </tbody> 
            </form>
        </table>
    </div>
    </div>

    <br>    
    <h4  style="float: right; color:#88253C">Joindre la fiche d émargement </h4><br><br>
    <div><input style="float: right;" type="file" name="file[]" role="button"></div><br><br>
    <div><input style="float: right" class="btn btn-success" value="Valider" type="submit" role="button"></div><br>
    </fieldset>
</form>
