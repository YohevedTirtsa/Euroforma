<?php

/**
 * Vue seances
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */
?>

<form role="form" method="post" action="index.php?uc=emargement&action=faireEmargement">
<div class="row">
    <div class="panel panel-info">
        <div class="panel-heading">Séances</div>
        <table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th class="id">Id</th>
                    <th class="date">Date</th>  
                    <th class="formateur">Formateur</th>  
                    <th class="matiere">Matiere</th>
                    <th class="epreuve">Epreuve</th>
                    <th class="duree">Durée</th>
                    <th class="HeureDeb">Créneau</th> 
                    <th style="background-color: #f0f5eb" class="HeureDeb">Emargement</th>                    
                </tr>
            </thead>  
            <tbody>
            <?php 
            foreach ($seances as $uneSeance) {
                $id = htmlspecialchars($uneSeance['id']);
                $date = $uneSeance['date'];
                $formateur = $uneSeance['formateur'];
                $matiere = $uneSeance['matiere'];
                $epreuve = $uneSeance['epreuve'];
                $duree = $uneSeance['duree'];
                $heureDeb = $uneSeance['heureDeb'];
                $heureFin = $uneSeance['heureFin'];
                $emarge = $uneSeance['emarge'];
                ?>
                <tr>
                    <td><?php echo $id?></td>
                    <td><?php echo $date ?></td>
                    <td><?php echo $formateur ?></td>
                    <td><?php echo $matiere ?></td>
                    <td><?php echo $epreuve ?></td>
                    <td><?php echo $duree ?></td>
                    <td><?php echo $heureDeb ?> /
                    <?php echo $heureFin ?></td>
                    <?php if($emarge=="OUI"){ ?>
                             <td> <a href="index.php?uc=emargement&action=consulterEmargement&idSeance=<?php echo $id; ?>" 
                                     class="btn btn-success">Consulter</a></td>                                   
                    <?php
                    }else{ ?>
                         <td> <a href="index.php?uc=emargement&action=faireEmargement&idSeance=<?php echo $id; ?>" 
                                     class="btn btn-success">Faire</a></td> 
                    <?php
                    }
                    ?>                          
                    </tr>
                <?php
            }
            ?>
            </tbody>  
        </table>    
    </div>
</div>
</form>
