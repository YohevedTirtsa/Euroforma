<?php
/**
 * Vue entete
 *
 * PHP Version 7
 *
 * @category  Stages 2eme année
 * @package   Euroforma
 * @author    Yoheved Tirtsa Touati
 * @author    Beth Sefer
 */

?>
<!DOCTYPE html>
<html>
  <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta charset="UTF-8">
      <title>Euroforma</title>
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="./styles/bootstrap/bootstrap.css" rel="stylesheet">
      <link href="./styles/style.css" rel="stylesheet">
  </head>
  <body>
      <div class="container">
          <?php
          $uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);//Verifie le contenu de uc
          if ($estConnecte) {
              ?>
          <div class="header">
              <div class="row vertical-align">
                  <div class="col-md-4">
                      <h1>
                          <img src="./images/logo.jpg" class="img-responsive"
                               alt="Euroforma"
                               title="Euroforma">
                      </h1>
                  </div>
                  <div class="col-md-8">
                      <ul class="nav nav-pills pull-right" role="tablist">
                          <li <?php if (!$uc || $uc == 'accueil') { ?>class="active" <?php } ?>>
                              <a href="index.php">
                                  <span class="glyphicon glyphicon-home"></span>
                                  Accueil
                              </a>
                          </li>
                          <li <?php if ($uc == 'emargement') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=gererFrais&action=saisirFrais">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                  Emargement
                              </a>
                          </li>
                          <li <?php if ($uc == '') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=etatFrais&action=selectionnerMois">
                                  <span class="glyphicon glyphicon-list-alt"></span>
                                  Compte rendu
                              </a>
                          </li>
                          <li <?php if ($uc == '') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=etatFrais&action=selectionnerMois">
                                  <span class="glyphicon glyphicon-list-alt"></span>
                                  Facture OPCA
                              </a>
                          </li>
                          <li <?php if ($uc == '') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=etatFrais&action=selectionnerMois">
                                  <span class="glyphicon glyphicon-list-alt"></span>
                                  Formulaires administratifs
                              </a>
                          </li>
                          <li
                          <?php if ($uc == 'deconnexion') { ?>class="active"<?php } ?>>
                              <a href="index.php?uc=deconnexion&action=demandeDeconnexion">
                                  <span class="glyphicon glyphicon-log-out"></span>
                                  Déconnexion
                              </a>
                          </li>
                      </ul>
                  </div>
                    </div>
          </div>
 <?php
          } else {
              ?>  
              <h1>
                  <img src="./images/logo.jpg"
                       class="img-responsive center-block"
                       alt="Euroforma"
                       title="Euroforma">
              </h1>
<?php
          }
          ?>
