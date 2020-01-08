<?php
/**
 * Vue accueil
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */
?>
<div id="accueil" style="text-align: center">
    <h2>
        Accueil<small> - Bonjour
            <?php 
            echo  $_SESSION['nom'].'!' 
            ?></small>
    </h2>
</div>
<div class="row">
    <div class="col-md-12">        
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12" style="text-align: center">
                        <a href="index.php?uc=emargement&action=afficheSeance"
                           class="btn btn-success btn-lg" role="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <br>Emargement</a>
                        <a href="index.php?uc=etatFrais&action=selectionnerMois"
                           class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <br>Compte-Rendu</a>
                        <a href="index.php?uc=gererFrais&action=saisirFrais"
                           class="btn btn-success btn-lg" role="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                            <br>Factures OPCA</a>
                        <a href="index.php?uc=etatFrais&action=selectionnerMois"
                           class="btn btn-primary btn-lg" role="button">
                            <span class="glyphicon glyphicon-list-alt"></span>
                            <br>Formulaires administratifs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>