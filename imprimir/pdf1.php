<?php
include '../php/conexion.php';
require('../pdfphp/fpdf/fpdf.php');
$folio=$_POST['folio'];

$gbd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$gbd->beginTransaction();
$sentencia = $gbd->prepare("SELECT a.nombre, a.ap_paterno, a.ap_materno, p.hora_salida, p.fecha_exp_pases, p.motivos_pases,ad.nombreA,ad.ap_paternoA, g.grado, gr.grupo FROM pases as p, grado as g, grupo as gr, alumnos as a, admin as ad WHERE p.folio_pases='$folio' AND p.matricula_alumnos=a.matricula AND a.matricula_grado=g.matricula_grado AND a.matricula_grupo=gr.matricula_grupo AND p.matricula_admin= ad.matricula_admin");
$sentencia->execute();
$fila = $sentencia->fetch();
$nombre=$fila['nombre'];
$ap1=$fila['ap_paterno'];
$ap2=$fila['ap_materno'];
$hora=$fila['hora_salida'];
$fecha=$fila['fecha_exp_pases'];
$motivo=$fila['motivos_pases'];
$nomA=$fila['nombreA'];
$apA=$fila['ap_paternoA'];
$grado=$fila['grado'];
$grupo=$fila['grupo'];


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
	
	$this->Cell(10,8,'PASE DE SALIDA',0,0,'C');
	$this->Ln(25);
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
$pdf->SetFont('Times','',13);
$pdf->Cell(0,10,'NOMBRE DEL ALUMNO: '.$nombre." ".$ap1." ".$ap2,0,1);

$pdf->Cell(0,10,'DEL SEMESTRE: '.$grado.'          '.'GRUPO: '.$grupo.'       ',0,1);
$pdf->Cell(0,10,'HORA DE SALIDA: '.$hora,0,1);
$pdf->Cell(0,10,'MOTIVOS: '.$motivo,0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'AUTORIZA '.'                                                                                                         '.'ELABORA',0,1);
$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,10,'LIC.CRISTINA OVANDO ZAPATA '.'                                                            '.$nomA." ".$apA,0,1);
$pdf->Cell(0,10,'SUBDIRECTORA',0,2);
$pdf->Output();
?>