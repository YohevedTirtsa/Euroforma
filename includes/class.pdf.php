<?php
// Connexion à la BDD
/*$bddname = 'euroforma';
$hostname = 'localhost';
$username = 'root';
$password = ' ';
$db = mysqli_connect ($hostname, $username, $password, $bddname);*/
// Appel de la librairie FPDF
require("fpdf.php");
$buffer = ob_get_clean(); 
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Image('images/logo.jpg',8,2,80);
        //$mois->getMois(date('d/m/Y'));
        $pdf->Cell(40,50,'   Horaires du mois');//,$mois);
        $pdf->SetFont('Arial');
        $pdf->SetFontSize('10');
        $pdf->SetY(-26);
        $pdf->Cell(196,5,'149 rue St Maur, 75011 Paris - euroforma.contact@gmail.com - 06 32 05 83 34',0,0,'C');
        $nom="compte rendu";
        $pdf->Output($nom,'I');
 
/*$req1 = "SELECT * FROM employeur WHERE id=".$_GET['id'];
$rep1 = mysqli_query($db, $req1);
$row1 = mysqli_fetch_array($rep1);
$pdf->Text(8,38,'Bonjour '.$row1['nom'].$row1['prenom']); 

$req = "SELECT idEleve, nom, prenom FROM eleve WHERE id=".$_GET['id'];
$rep = mysqli_query($db, $req);
$row = mysqli_fetch_array($rep);
$pdf->Text(8,38,'Concernant les horaires du mois de: '.$row['nom'].$row['prenom']);  */     


