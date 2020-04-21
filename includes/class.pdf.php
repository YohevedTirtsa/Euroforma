<?php
// Appel de la librairie FPDF
require("fpdf.php");
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('images/logo.jpg',60,6,90);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    $this->SetLineWidth(0.3);
    // Line break
    $this->Ln(5); 
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial');
    $this->SetFontSize('10');
    // Page number
    $this->Cell(0,10,'149 rue St Maur, 75011 Paris - euroforma.contact@gmail.com - 06 32 05 83 34',0,0,'C');
}
}
$buffer = ob_get_clean(); 
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Header();
        $pdf->Cell(5,50,'   Horaires du mois '.$mois.'- '.$nomEleve['nom']." ".$nomEleve['prenom']);
        $pdf->SetFont('Arial');
        $pdf->SetFontSize('12');
        $pdf->Cell(0.1,70,'Bonjour Mr '.$employeur['nom']." ".$employeur['prenom'].",");
        $pdf->Cell(0.1,90,'Concernant les horaires du mois de '.$nomEleve['nom']." ".$nomEleve['prenom']);
        $pdf->Cell(0.1,110,'Je vous informe que ce mois de '.$mois.' l eleve a assiste a '.$heuresFaites[0].' sur '.$heuresTotal[0] .' heures de formation ');
        $pdf->Cell(0.1,130,'prevues par le planning.');
        $pdf->Cell(0.1,150,'Soit un taux de presence de '.$pourcentage.'%');
        $pdf->Cell(0.1,170,'Donc '.$heuresAbsence.' heures d absence en formation et une assiduite maximale !'); 
        $pdf->Cell(0.1,200,'Que de bonne choses,'); 
        $nom="compte_rendu";
        //$pdf->Output($nom,'I');
        for($i=1;$i<=2;$i++)
	{
	    if($i==1)
	    {
		//sortie du fichier
		$pdf->Output('C:\wamp64\www\Euroforma\tests\pdf_sauvegardé\ '.$nom.'.pdf','F');
	    }
	    else
	    {
		//sortie du fichier
		$pdf->output($nom,'I');
	    }

        }
