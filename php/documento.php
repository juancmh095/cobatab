<?php
require('../fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(300,10,'Motivo:'.$_POST['motivos'].$_POST['otro'],10,2);
$pdf->Cell(300,10,''.$_POST['desc'],10,2);

$pdf->Output();
?>