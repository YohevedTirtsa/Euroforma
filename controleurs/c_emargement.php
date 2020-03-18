<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

if (!$action) {
    $action = 'afficheSeances';
}

switch ($action) {
case 'afficheSeances':
    $seances = $pdo->getSeances();
    include 'vues/v_seances.php';
    break;
case 'faireEmargement':
    $idSeance= filter_input(INPUT_GET, 'idSeance', FILTER_SANITIZE_STRING);
    $laSeance = $pdo->getLaSeance($idSeance);
    $eleves = $pdo->getEleves();
    include 'vues/v_emargement.php';
    break;
case 'validerEmargement':
    $idSeance= filter_input(INPUT_GET, 'idSeance', FILTER_SANITIZE_STRING);
    $idEleve=filter_input(INPUT_POST, 'idEleve', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);
    $presence=filter_input(INPUT_POST, 'cocher', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);
    $total= $pdo->countEleves();
    $presAbs= presence($presence,$total);
    $motif =filter_input(INPUT_POST, 'motif', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY);

  
    // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
    if (isset($_FILES['file'])and $_FILES['file']['error'][0]==0)
    {
            // Testons si le fichier n'est pas trop gros
            if ($_FILES['file']['size'][0]<=1000000)
            {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['file']['name'][0]);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png','pdf','docx','doc');
                    if (in_array($extension_upload, $extensions_autorisees))
                    {
                            // On peut valider le fichier et le stocker définitivement
                            move_uploaded_file($_FILES['file']['tmp_name'][0], 'fichesEmargement/' . basename($_FILES['file']['name'][0]));
                            $lien= 'fichesEmargement/'. basename($_FILES['file']['name'][0]);                          
                    }
            }
    }
    
    $emargement=$pdo->remplirEmargement($idSeance,$idEleve,$presAbs,$motif,$lien);
    if(is_array($emargement)){
        ?>
        <div class="alert alert-info" role="alert">
            <p>L'émargement a bien été effectué! <a href="index.php">Cliquez ici</a>
        pour revenir à l'accueil.</p>
        </div>
        <?php
        header("Refresh: 3;URL=index.php");
        }
        ?>
        <?php
    break;
    
case 'consulterEmargement':
    $idSeance= filter_input(INPUT_GET, 'idSeance', FILTER_SANITIZE_STRING);
    $laSeance = $pdo->getLaSeance($idSeance);
    $eleves = $pdo->getEleves();
    $lesEmargements= $pdo->getEmargement($idSeance);
   
    include 'vues/v_consulterEmarg.php';
    break;
    
}