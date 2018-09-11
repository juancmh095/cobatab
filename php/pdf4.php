<?php
include 'conexion.php';
require('../pdfphp/fpdf/fpdf.php');
$folio=$_GET['folio'];

$gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT j.*, a.nombre, a.ap_paterno, a.ap_materno ,g.grado, gr.grupo, ad.nombreA, ad.ap_paternoA FROM justificante as j, alumnos as a, admin as ad, grado as g, grupo as gr WHERE j.folio_justificante='$folio' AND j.matricula_alumnos=a.matricula AND j.matricula_admin=ad.matricula_admin AND a.matricula_grado=g.matricula_grado AND a.matricula_grupo=gr.matricula_grupo;");
$sentencia->execute();
$fila = $sentencia->fetch();
$nombre=$fila['nombre'];
$ap1=$fila['ap_paterno'];
$ap2=$fila['ap_materno'];
$nomA=$fila['nombreA'];
$apA=$fila['ap_paternoA'];
$grado=$fila['grado'];
$grupo=$fila['grupo'];
$fecha1=$fila['fecha'];
$motivos=$fila['motivos'];
$fecha2=$fila['fecha_jus'];
$hora=$fila['hora_inicio'];
$materias=$fila['materias'];

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
		$this->Cell(13,8,'JUSTIFICANTE',0,0,'C');
	$this->Ln(5);
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
$pdf->SetFont('Times','',12);
$pdf->Cell(0,8,'H.CARDENAS, TAB. A: '.$fecha1,0,1,'R');
$pdf->Cell(0,8,'NOMBRE DEL ALUMNO: '.$nombre." ".$ap1." ".$ap2,0,1);
$pdf->Cell(0,8,'DEL SEMESTRE: '.$grado.'          '.'GRUPO: '.$grupo.'       ',0,1);
$pdf->Cell(0,8,'EL DIA: '.$fecha2.'          '.'APARTIR DE : '.$hora,0,1);
$pdf->Cell(0,8,'MOTIVOS: '.$motivos,0,1);
$pdf->MultiCell(0,5,'PARA LAS MATERIAS : ',0,1);
$pdf->MultiCell(0,5,$materias,0,1);

$pdf->Cell(0,8,'AUTORIZA '.'                                                                                                         '.'ELABORA',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'LIC.CRISTINA OVANDO ZAPATA '.'                                                            '.$nomA." ".$apA,0,1);
$pdf->Cell(0,0,'SUBDIRECTORA',0,2);
$pdf->Output();
?>