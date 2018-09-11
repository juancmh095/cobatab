<?php
include '../php/conexion.php';
require('../pdfphp/fpdf/fpdf.php');
$folio=$_POST['folio'];

$gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT a.matricula, a.nombre, a.ap_paterno, a.ap_materno, g.grado, gr.grupo, r.motivo, r.des, r.folio_reporte, ad.nombreA, ad.ap_paternoA FROM alumnos AS a, reporte as r, admin as ad, grado as g, grupo as gr where r.folio_reporte='$folio' AND r.matricula_alumnos=a.matricula AND g.matricula_grado=a.matricula_grado AND gr.matricula_grupo=a.matricula_grupo and r.matricula_admin=ad.matricula_admin");
$sentencia->execute();
$fila = $sentencia->fetch();
$nombre=$fila['nombre'];
$ap1=$fila['ap_paterno'];
$ap2=$fila['ap_materno'];
$nomA=$fila['nombreA'];
$apA=$fila['ap_paternoA'];
$grado=$fila['grado'];
$grupo=$fila['grupo'];
$motivo=$fila['motivo'];
$des=$fila['des'];



class PDF extends FPDF

{
// Cabecera de página
function Header()
{
	// Logo
	$this->Image('../img/logo_pb.jpg',10,8,33,0);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Movernos a la derecha
	$this->Cell(90);
	// Título
	$this->Cell(30,10,'COLEGIO DE BACHILLERES DE TABASCO',0,0,'C');
	// Salto de línea
	$this->Ln(8);
	// Movernos a la derecha
	$this->Cell(90);
	// Título
	$this->Cell(30,10,'ORGANIZMO DESCENTRALIZADO DEL ESTADO',0,0,'C');
	$this->Ln(8);
	// Movernos a la derecha
	$this->Cell(90);
	// Título
	$this->SetFont('Arial','B',10);
	$this->Cell(10,8,'PLANTEL No.41',0,2,'C');
	$this->Cell(10,8,'REPORTE',0,0,'C');
	$this->Ln(1);
}

// Pie de página
function Footer()
{
	// Posición: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Número de página
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pdf->Cell(0,10,'No. '.$folio,0,1,'R');
$pdf->Cell(0,10,'ALUMNO(A): '.$nombre." ".$ap1." ".$ap2,0,1);
$pdf->Cell(0,10,'DEL SEMESTRE: '.$grado.'          '.'GRUPO: '.$grupo.'       ',0,1);

$pdf->Cell(0,10,'POR EL SIG. MOTIVO: '.$motivo,0,1);
$pdf->Cell(0,10,'DESCRIPCION: '.$des,0,1);
$pdf->Cell(0,10,'NOTA: EL ALUMNO QUE ACUMULE 3 REPORTES SE SUSPENDERA DEFINITIVAMENTE DE ESTE PLANTEL',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,''.$nomA.' '.$apA,0,1,'L');
$pdf->Cell(0,10,'NOMBRE DE QUIEN REPORTA',0,2,'L');
$pdf->Cell(0,10,''.$nombre.' '.$ap1.' '.$ap2,0,1,'R');
$pdf->Cell(0,10,'NOMBRE Y FIRMA DEL ALUMNO',0,2,'R');
$pdf->Cell(0,10,'____________________________________________________________________________________________________________',0,2);
$pdf->Output();
?>