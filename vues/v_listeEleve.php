<?php
/**
 * Vue liste des eleves
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Tsipora Schvarcz
 */
?>
<h2>Compte rendu employeur</h2><br>
<div class="row">
    <div class="col-md-4">
        <form action="index.php?uc=genererCR&action=genererCR" 
              method="post" role="form">

            <?php//liste déroulante des élèves?>
            
            <div class="form-group" style="display: inline-block"> 
                <label for="lstEleves" accesskey="n">Sélectionner un élève : </label>
                <select id="lstEleves" name="lstEleves" class="form-control">
                    <?php
                    foreach ($lesEleves as $unEleve) {
                        $id = $unEleve['idEleve'];
                        $nom = $unEleve['nom'];
                        $prenom = $unEleve['prenom'];
                        if ($unEleve == $eleveASelectionner) {
                            ?>
                            <option selected value="<?php echo $id ?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $id?>">
                                <?php echo $nom . ' ' . $prenom ?> </option>
                            <?php
                        }
                    }
                    ?> 
            
                </select>
            </div>
            <input id="ok" type="submit" value="Generer le compte rendu mensuel" class="btn btn-success" 
                   role="button">
        </form>
    </div>
</div>
                    
